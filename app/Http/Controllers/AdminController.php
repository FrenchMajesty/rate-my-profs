<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use App\Correction;
use App\SchoolRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{

	public function home() {

		$unverified['prof'] = Professor::findComplete()->whereNull('professors.approved')->get();
		$unverified['school'] = School::whereNull('approved')->get();
		$corrections = Correction::findComplete()->where('corrections.id','>','0')->get();

		return view('admin.index', compact('unverified','corrections'));
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

	public function rejectProf(Request $request) {
		// .
	}

}

?>