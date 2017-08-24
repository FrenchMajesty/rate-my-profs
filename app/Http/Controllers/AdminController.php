<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use App\User;
use App\Correction;
use App\Department;
use App\SchoolRating;
use App\ProfRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{

	public function home() {

		$unverified['prof'] = Professor::findComplete()->whereNull('professors.approved')->get();
		$unverified['school'] = School::whereNull('approved')->get();
		$corrections = Correction::findComplete()->where('corrections.id','>','0')->get();
		$ratings = SchoolRating::count() + ProfRating::count();
		$users = User::count();

		$data = School::where('approved','1')->get();
		$profs = Professor::findComplete()->where('professors.approved','1')->get();
		$departments = Department::select('id as departmentID','name')->get();

		$profs->each(function($item) use ($data) {
			$data->push($item); 
		});
		$departments->each(function($item) use ($data) {
			$data->push($item);
		});

		return view('admin.index', compact('unverified','corrections', 'ratings', 'users', 'data'));
	}

	public function profs() {

		return view('admin.profs');
	}

	public function schools() {

		return view('admin.schools');
	}

	public function users() {

		return view('admin.users');
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

	public function updateViaCorrection(Request $request) {

		$this->updateProf($request);

		$this->validate($request, [
			'corrections_id' => 'required|numeric|exists:corrections,id'
		]);

		Correction::destroy($request->corrections_id);
	}	

	public function deleteCorrection(Request $request) {
		
		$this->validate($request, [
			'id' => 'required|numeric|exists:corrections'
		]);

		Correction::destroy($request->id);
	}

}

?>