<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Department;
use App\School;
use App\ProfRating;
use App\Correction;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{   
    private $ratingsTable = 'prof_ratings';

    public function create(Request $request) {

    	$first = $request->first;
    	$middle = $request->middle?: '';
    	$lastname = $request->lastname;
        $directory = $request->directory;
        $department = $request->department;
    	$dept_id = $request->department_id;
    	$school_id = $request->school_id;

        $this->validate($request, [
            'first' => 'required|alpha_dash',
            'middle' => 'nullable|alpha_dash',
            'lastname' => 'required|alpha_dash',
            'school' => 'required|string|exists:schools,name',
            'directory' => 'nullable|string|url',
            'department' => 'required|string|exists:school_departments,name'
        ]);

    	return Professor::create([
            'name' => $first . ' ' . $middle,
            'lastname' => $lastname,
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

        $query = Professor::where('school_id', $prof->school_id);
        $count['school'] = $query->count() -1;
        $count['dept'] = $query->where('department_id', $prof->department_id)->count() -1;

        $ratings2 = ProfRating::where('prof_id', $prof->id)->where('validated','1');
        $ratings = ProfRating::getAllRatings($prof->id);

        if($ratings2->count() > 0) {
            $total['overall'] = $ratings2->avg('overall_rating');
            $total['difficulty'] = $ratings2->avg('difficulty_rating');
        }else {
            $total = null;
        }

        $suggestions = (new Professor ())->selectRaw('professors.id, professors.name, professors.lastname,
            AVG(prof_ratings.overall_rating) as rating, COUNT(prof_ratings.overall_rating) as ratings_count')
                        ->leftJoin('prof_ratings','professors.id','=','prof_ratings.prof_id')
                        ->groupBy('professors.id','professors.name','professors.lastname')
                        ->where('school_id', $prof->school_id)
                        ->where('department_id', $prof->department_id)
                        ->whereNotIn('professors.id',[$prof->id])->get();


        $department = Department::find($prof->department_id)->name;

        return view('pages.professor', [
            'professor' => $prof,
            'department' => $department,
            'school' => $school,
            'ratings' => $ratings,
            'similar' => $count,
            'total' => $total,
            'suggestions' => $suggestions
        ]);
    }

    public function submitCorrection(Request $request) {

        $this->validate($request, [
            'problem' => 'required|string|min:10',
            'email' => 'required|email',
            'prof_id' => 'required|exists:professors,id'
        ]);


        return Correction::create([
            'prof_id' => $request->prof_id,
            'problem' => $request->problem,
            'user' => $request->email
        ]);
    }

    public function loadAll() {
        return Professor::all();
    }
}
