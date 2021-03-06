<?php

namespace App\Http\Controllers;

use App\ProfRating;
use App\SchoolRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
	public function rateProfReview(Request $request) {
		
		$ip = $request->ip();
		$this->validate($request, [
			'prof_id' => 'required|exists:professors,id',
			'rating_id' => 'required',
			'value' => 'required|numeric'
		]);

		$data = DB::table('ratings_votes')->where('rating_id', $request->rating_id)->where('address_ip', $ip);

		if($data->get()) {
			return $data->update(['value' => $request->value]);
		}else {
			return DB::table('ratings_votes')->insertGetId([
				'prof_id' => $request->prof_id,
				'rating_id' => $request->rating_id,
				'value' => $request->value,
				'address_ip' => $ip
			]);
		}
	}

	public function rateSchoolReview(Request $request) {
		
		$ip = $request->ip();
		$this->validate($request, [
			'school_id' => 'required|exists:schools,id',
			'rating_id' => 'required',
			'value' => 'required|numeric'
		]);

		$data = DB::table('ratings_votes')->where('rating_id', $request->rating_id)
		->where('school_id',$request->school_id)->where('address_ip', $ip);

		if(count($data->get()) > 0) {
			return $data->update(['value' => $request->value]);
		}else {
			return DB::table('ratings_votes')->insertGetId([
				'school_id' => $request->school_id,
				'rating_id' => $request->rating_id,
				'value' => $request->value,
				'address_ip' => $ip
			]);
		}
	}

	public function rateProf(Request $request) {

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

        return ProfRating::create([
            'user' => $user,
            'prof_id' => $request->prof_id,
            'overall_rating' => $request->overall,
            'difficulty_rating' => $request->difficulty,
            'class_details' => json_encode($classInfo),
            'comment' => $request->comment,
            'address_ip' => $ip
        ]);
    }

    public function rateSchool(Request $request) {

        $user = Auth::check() ? $request->user()->email : NULL;
        $ip = $request->ip();

        $this->validate($request, [
            'overall' => 'required|numeric',
            'location' => 'required|numeric',
            'facilities' => 'required|numeric',
            'opportunity' => 'required|numeric',
            'social' => 'required|numeric',
            'school_id' => 'required|exists:schools,id|unique:school_ratings,school_id,NULL,NULL,address_ip,'.$ip,
            'comment' => 'required|string|min:15|max:350'
        ]);

        return SchoolRating::create([
            'user' => $user,
            'school_id' => $request->school_id,
            'overall_rating' => $request->overall,
            'location' => $request->location,
            'facility' => $request->facilities,
            'social' => $request->social,
            'opportunity' => $request->opportunity,
            'comment' => $request->comment,
            'address_ip' => $ip
        ]);
    }

	public function reportRating(Request $request) {

		$this->validate($request, [
			'type' => 'required|string',
			'rating_id' => 'required',
			'issue' => 'required|min:10'
		]);

		return DB::table('reports')->insertGetId([
			'type' => $request->type,
			'rating_id' => $request->rating_id,
			'issue' =>  $request->issue
		]);
	}
}



?>