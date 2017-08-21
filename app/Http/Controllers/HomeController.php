<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request) {

        $schoolID = $request->input('sID');
        $dept = $request->input('dept');
        $location = $request->input('location');
        $search = $request->input('search');

        $query = (new Professor())->select([
            'professors.id','professors.name','professors.lastname','professors.school_id',
            'schools.id as schoolID','schools.name as school','school_departments.name as department',
        ])->where('professors.approved','1')
        ->leftJoin('schools','professors.school_id','=','schools.id')
        ->leftJoin('school_departments','professors.department_id','=','school_departments.id');
        $qry = new School;

        if($search) {
            $query = $query->where('professors.name','like','%'. $search .'%')->orWhere('professors.lastname','like','%'. $search .'%');
            $qry = $qry->where('name','like','%'. $search .'%')->orWhere('nickname','like','%'. $search .'%')
                        ->orWhere('location','like','%'. $search .'%');
        }

        if($schoolID){
            $query = $query->where('professors.school_id', $schoolID);
            $qry = $qry->where('id', $schoolID);
        }

        if($dept)
            $query = $query->where('professors.department_id', $dept);

        if($location)
            $qry = $qry->where('location', $location);

        return view('pages.search', [
            'profs' => $query->get(),
            'schools' => $qry->get()
        ]);
    }

    public function fetchAll() {

        $schools = School::where('approved','1')->get();
        $profs = Professor::where('approved','1')->get();

        return $schools->merge($profs);
    }
}
