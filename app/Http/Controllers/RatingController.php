<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
			return DB::table('ratings_votes')->insertgetId([
				'prof_id' => $request->prof_id,
				'rating_id' => $request->rating_id,
				'value' => $request->value,
				'address_ip' => $ip
			]);
		}
	}
}



?>