<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use App\User;
use App\Correction;
use App\Department;
use App\SchoolRating;
use App\ProfRating;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{

	public function home() {

		$unverified['prof'] = Professor::findComplete()->whereNull('professors.approved')->get();
		$unverified['school'] = School::whereNull('approved')->get();
		$corrections = Correction::findComplete()->where('corrections.id','>','0')->get();
		$dateSince = (new \DateTime(date('Y-m-d')))->sub(new \DateInterval('P1M'));
		$ratings = SchoolRating::where('created_at','>',$dateSince->format('Y-m-d'))->count() + 
					ProfRating::whereDate('created_at','>',$dateSince->format('Y-m-d'))->count();
		$data = $this->loadAllData();
		$usersCount = User::count();
		$profReports = Report::findComplete('prof')->get();
		$schoolReports = Report::findComplete('school')->get();
		$profRatings = ProfRating::whereNull('validated')->get();
		$schoolRatings = SchoolRating::whereNull('validated')->get();

		return view('admin.index', compact('unverified','corrections', 'ratings', 'usersCount', 'data',
			'profReports','schoolReports','dateSince','profRatings','schoolRatings'));
	}

	public function profs() {

		$data = $this->loadAllData();
		$profs = Professor::findComplete()->where('professors.approved','1')->get();
		return view('admin.profs', compact('profs', 'data'));
	}

	public function schools() {

		$data = $this->loadAllData();
		$schools = School::where('schools.approved','1')->get();
		return view('admin.schools', compact('schools', 'data'));
	}

	public function users() {

		$data = $this->loadAllData();
		$users = User::findComplete()->get();

		return view('admin.users', compact('data','users'));
	}

	public function approveProf(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:professors',
			'action' => 'required|string|min:5|max:10'
		]);

		$approve = $request->action == 'approve' ? true : false;

		$prof = Professor::find($request->id);
		$prof->approved = $approve;
		$prof->save();
	}

	public function approveRatingRating(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:prof_ratings',
			'action' => 'required|string|min:5|max:10'
		]);

		$approve = $request->action == 'approve' ? true : false;

		$school = ProfRating::find($request->id);
		$school->validated = $approve;
		$school->save();
	}

	public function approveProfViaUpdate(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:professors',
			'firstname' => 'required|string',
			'lastname' => 'required|string',
			'directory' => 'nullable|url',
			'sID' => 'required|numeric|exists:schools,id',
			'dID' => 'required|numeric|exists:school_departments,id'
		]);

		$prof = Professor::find($request->id);
		$prof->name = $request->firstname;
		$prof->lastname = $request->lastname;
		$prof->directory_url = $request->directory;
		$prof->school_id = $request->sID;
		$prof->department_id = $request->dID;
		$prof->approved = true;
		$prof->save();
	}

	public function updateProf(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:professors',
			'firstname' => 'required|string|max:100',
			'lastname' => 'required|string|max:100',
			'directory' => 'nullable|url',
			'sID' => 'required|numeric|exists:schools,id',
			'dID' => 'required|numeric|exists:school_departments,id'
		]);

		$prof = Professor::find($request->id);
		$prof->name = $request->firstname;
		$prof->lastname = $request->lastname;
		$prof->directory_url = $request->directory;
		$prof->department_id = $request->dID;
		$prof->school_id = $request->sID;
		$prof->save();
	}

	public function deleteProf(Request $request) {
		$this->validate($request, [
			'id' => 'required|numeric|exists:professors'
		]);

		DB::table('ratings_votes')->where('prof_id', $request->id)->delete();
		$rating = ProfRating::where('prof_id',$request->id);
		Report::deleteInvalid();
		Correction::where('prof_id',$request->id)->delete();
		Professor::destroy($request->id);
	}

	public function approveSchool(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:schools',
			'action' => 'required|string|min:5|max:10'
		]);

		$approve = $request->action == 'approve' ? true : false;

		$school = School::find($request->id);
		$school->approved = $approve;
		$school->save();
	}

	public function approveSchoolRating(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:school_ratings',
			'action' => 'required|string|min:5|max:10'
		]);

		$approve = $request->action == 'approve' ? true : false;

		$school = SchoolRating::find($request->id);
		$school->validated = $approve;
		$school->save();
	}

	public function approveSchoolViaUpdate(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:schools',
			'name' => 'required|string|max:180',
			'nickname' => 'required|string|max:10',
			'location' => 'required|string|max:100',
			'website' => 'required|url|max:150'
		]);

		$school = School::find($request->id);
		$school->name = $request->name;
		$school->nickname = $request->nickname;
		$school->location = $request->location;
		$school->website = $request->website;
		$school->approved = true;
		$school->save();
	}

	public function updateSchool(Request $request) {

		$this->validate($request,[
			'id' => 'required|numeric|exists:schools',
			'name' => 'required|string|max:180',
			'nickname' => 'required|string|max:10',
			'location' => 'required|string|max:200',
			'website' => 'required|url|max:100',
		]);

		$school = School::find($request->id);
		$school->name = $request->name;
		$school->nickname = $request->nickname;
		$school->location = $request->location;
		$school->website = $request->website;
		$school->save();
	}

	public function deleteSchool(Request $request) {
		$this->validate($request, [
			'id' => 'required|numeric|exists:schools'
		]);

		DB::table('ratings_votes')->where('school_id', $request->id)->delete();
		$rating = SchoolRating::where('school_id',$request->id);
		Correction::where('school_id',$request->id)->delete();
		Professor::where('school_id', $request->id)->delete();
		School::destroy($request->id);
		Report::deleteInvalid();
	}

	public function updateViaCorrection(Request $request) {

		$this->validate($request, [
			'corrections_id' => 'required|numeric|exists:corrections,id',
			'type' => 'required|string'
		]);

		if($request->type == 'prof')
			$this->updateProf($request);
		else
			$this->updateSchool($request);

		Correction::destroy($request->corrections_id);
	}	

	public function deleteCorrection(Request $request) {
		
		$this->validate($request, [
			'id' => 'required|numeric|exists:corrections'
		]);

		Correction::destroy($request->id);
	}

	public function dismissReport(Request $request) {
		return 'true';
		$this->validate($request, [
			'id' => 'required|numeric',
			'reports_id' => 'required|numeric|exists:reports,id',
			'action' => 'required|string|max:10',
			'type' => 'required|string|max:10'
		]);

		if($request->action == 'remove' && $request->type == 'prof') {
			$this->validate($request, ['id' => 'exists:prof_ratings']);
			ProfRating::destroy($request->id);
		}else if($request->action == 'remove' && $request->type == 'school') {
			$this->validate($request, ['id' => 'exists:school_ratings']);
			SchoolRating::destroy($request->id);
		}

		DB::table('reports')->where('id', $request->reports_id)->delete();
	}

	private function loadAllData() {
		$data = School::all();
		$profs = Professor::findComplete()->get();
		$departments = Department::select('id as departmentID','name')->get();

		// Merge collections
		$profs->each(function($item) use ($data) {
			$data->push($item); 
		});
		$departments->each(function($item) use ($data) {
			$data->push($item);
		});

		return $data;
	}

}

?>