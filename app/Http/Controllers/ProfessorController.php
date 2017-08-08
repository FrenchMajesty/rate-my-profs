<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Department;
use App\School;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{   
    private $ratingsTable = 'prof_ratings';

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

    public function rate(Request $request) {

        $user = Auth::check() ? $request->user()->email : NULL;
        $ip = $request->ip();
        $classInfo = [
            'code' => $request->class_code,
            'grade' => $request->class_grade,
            'textbook' => $request->textbook || NULL,
            'retake' => $request->retake || NULL
        ];
        $this->validate($request, [
            'class_code' => 'required|string',
            'class_grade' => 'required|string|max:5',
            'overall' => 'required|numeric',
            'difficulty' => 'required|numeric',
            'prof_id' => 'required|exists:professors,id|unique:prof_ratings,prof_id,NULL,NULL,address_ip,'.$ip,
            'comment' => 'required|string|min:15|max:350'
        ]);

        return DB::table($this->ratingsTable)->insertGetId([
            'user' => $user,
            'prof_id' => $request->prof_id,
            'overall_rating' => $request->overall,
            'difficulty_rating' => $request->difficulty,
            'class_details' => json_encode($classInfo),
            'comment' => $request->comment,
            'address_ip' => $ip
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

        $ratings2 = DB::table($this->ratingsTable)->where('prof_id', $prof->id);
        $ratings = DB::select('SELECT r.id, r.prof_id,r.overall_rating, r.difficulty_rating, 
            r.class_details, r.comment, r.created_at, SUM(CASE WHEN v.value > 0 THEN v.value ELSE 0 END) AS upvote,
            SUM(CASE WHEN v.value < 0 THEN 1 ELSE 0 END) AS downvote
                FROM prof_ratings r 
                LEFT OUTER JOIN ratings_votes v 
                ON r.id=v.rating_id 
                WHERE r.prof_id = 2
                GROUP BY r.id, r.prof_id, r.overall_rating, r.difficulty_rating, r.class_details, r.comment, r.created_at
                ORDER BY r.id DESC', [$id]);

        if($ratings2->count() > 0) {
            $total['overall'] = $ratings2->avg('overall_rating');
            $total['difficulty'] = $ratings2->avg('difficulty_rating');
        }else {
            $total = null;
        }

        $department = Department::find($prof->department_id)->name;

        return view('pages.professor', [
            'professor' => $prof,
            'department' => $department,
            'school' => $school,
            'ratings' => $ratings,
            'total' => $total
        ]);
    }

    public function submitCorrection(Request $request) {

        $this->validate($request, [
            'problem' => 'required|string|min:10',
            'email' => 'required|email',
            'prof_id' => 'required|exists:professors,id'
        ]);


        return DB::table('corrections')->insertGetId([
            'prof_id' => $request->prof_id,
            'problem' => $request->problem,
            'user' => $request->email
        ]);
    }

    public function loadAll() {
        return Professor::all();
    }
}
