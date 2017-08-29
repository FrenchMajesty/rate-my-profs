<?php

namespace App\Http\Controllers;

use App\School;
use App\Professor;
use App\Correction;
use App\SchoolRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{

    public function create(Request $request) {

        $school = new School;
        $name = $request->name;
        $nickname = $request->nickname;
        $state = $request->state;
        $city = $request->city;
        $website = $request->website;
        $email = $request->email;
        $errors = [];

        $this->validate($request, [
            'name' => 'required|string|unique:schools',
            'nickname' => 'required|alpha',
            'city' => 'required|string',
            'state' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|url'
        ]);

        return School::create([
            'name' => $name,
            'nickname' => $nickname,
            'location' => $city . ',' . $state,
            'website' => $website
        ]);
    }

    public function submitCorrection(Request $request) {

        $this->validate($request, [
            'problem' => 'required|string|min:10',
            'email' => 'required|email',
            'school_id' => 'required|exists:schools,id'
        ]);


        return Correction::create([
            'school_id' => $request->school_id,
            'problem' => $request->problem,
            'user' => $request->email
        ]);
    }

    public function load($id) {
        $school = School::where('id', $id)->where('approved', 1)->first();
        if(!$school) abort(404);

        $top = Professor::loadTopAtSchool($id);

        $ratings2 = SchoolRating::where('school_id', $school->id)->where('validated','1')->get();
        $ratings = SchoolRating::getAllRatings($school->id);

        if($ratings2->count() > 0) {
            $total['overall'] = $ratings2->avg('overall_rating');
            $total['location'] = $ratings2->avg('location');
            $total['facility'] = $ratings2->avg('facility');
            $total['opportunity'] = $ratings2->avg('opportunity');
            $total['social'] = $ratings2->avg('social');
        }else {
            $total = null;
        }

        return view('pages.school', [
            'school' => $school,
            'ratings' => $ratings,
            'top' => $top,
            'total' => $total
        ]);
    }

    public function loadAll() {
        return School::all();
    }
}

?>