<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model {
	protected $fillable = ['issue','rating_id','type'];

	public static function findComplete($type) {

		if($type == 'prof') {
			return self::select('reports.id','reports.type', 'reports.issue','reports.rating_id',
				'prof_ratings.user as posted_by','prof_ratings.comment as rating','prof_ratings.id as ratingID',
				'professors.name','professors.lastname')
				->join('prof_ratings','reports.rating_id','=','prof_ratings.id')
				->join('professors','prof_ratings.prof_id','=','professors.id')
				->where('reports.type',$type);
		}
		
		return self::select('reports.id','reports.issue','reports.rating_id','school_ratings.user as posted_by',
				'school_ratings.comment as rating','school_ratings.id as ratingID', 'schools.name')
				->join('school_ratings','reports.rating_id','=','school_ratings.id')
				->join('schools','school_ratings.school_id','=','schools.id')
				->where('reports.type', $type);
	}
}

?>