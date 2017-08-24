<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correction extends Model {
	protected $fillable = ['prof_is', 'school_id', 'problem', 'user']; 

	public static function findComplete() {

		return self::select('corrections.id','corrections.problem','corrections.user','corrections.prof_id',
				'corrections.school_id','corrections.created_at','schools.name as school','schools.id as schoolID',
				'professors.name as prof_first', 'professors.lastname as prof_last','professors.id as profID')
				->leftJoin('schools','corrections.school_id','=','schools.id')
				->leftJoin('professors','corrections.prof_id','=','professors.id');
	}
}

?>