<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Department;
use App\School;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function create(Request $request) {

    	$prof = new Professor;
    	$first = $request->first;
    	$middle = $request->middle?: '';
    	$last = $request->last;
        $directory = $request->directory;
        $department = $request->department;
    	$dept_id = $request->department_id;
    	$school_id = $request->school_id;

        $this->validate($request, [
            'first' => 'required|alpha_dash',
            'middle' => 'nullable|alpha_dash',
            'last' => 'required|alpha_dash',
            'school' => 'required|string|exists:schools,name',
            'directory' => 'nullable|string|url',
            'department' => 'required|string|exists:school_departments,name'
        ]);

    	return Professor::create([
            'name' => $first . ' ' . $middle,
            'lastname' => $last,
            'department_id' =>  $dept_id,
        	'directory_url' =>  $directory,
        	'school_id' =>  $school_id
    	]);
    }

    public function load($id) {
        $prof = Professor::where('id', $id)->where('approved', 1)->first();
        if(!$prof) abort(404);

        $school = School::find($prof->school_id);
        if(!$school) {
           abort(404);
           // report to admin
        }

        $department = Department::find($prof->department_id)->name;

        return view('pages.professor', [
            'professor' => $prof,
            'department' => $department,
            'school' => $school
        ]);
    }

    public function loadAll() {
        return Professor::all();
    }
}
