<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function create($request) {

    	$prof = new Professor;
    	$first = $request->first;
    	$middle = $request->middle?: '';
    	$last = $request->last;
    	$department = $request->department;
    	$school-id = $request->school-id;

    	$prof->name = $first . ' ' . $middle . ' ' . $last;
    	$prof->department = $department;
    	$prof->school-id = $school-id;
    	$prof->save();
    }
}
