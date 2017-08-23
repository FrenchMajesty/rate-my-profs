<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function profile(Request $request) {

		return view('pages.profile');
	}

	public function updatePassword(Request $request) {

		$this->validate($request, [
			'id' => 'required|numeric|exists:users',
			'password' => 'required|min:6|confirmed'
		]);

		User::where('id', $request->id)->update(['password' => bcrypt($request->password)]);
	}

	public function updateAccount(Request $request) {

		$this->validate($request, [
			'id' => 'required|numeric|exists:users',
			'email' => 'required|string|email|max:255',
			'firstname' => 'required|string|min:2|max:25',
			'lastname' => 'required|string|min:2|max:25'
		]);

		$user = User::find($request->id);
		$prof = Professor::find($user->prof_id);

		if($prof) {
			$prof->name = $request->firstname;
			$prof->lastname = $request->lastname;
			$prof->save();
		}

		$user->email = $request->email;
		$user->name = $request->firstname . ' ' . $request->lastname;
		$user->save();
	}
}


?>