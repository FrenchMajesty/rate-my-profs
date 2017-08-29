<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Professor extends Model {
	protected $fillable = ['name', 'lastname', 'school_id', 'department_id'];

	public static function loadTopAtSchool($id) {

		return DB::select("SELECT p.id, p.name, p.lastname,
             AVG(CASE WHEN r.validated = 1 THEN r.overall_rating ELSE NULL END) AS average,
              COUNT(CASE WHEN r.validated = 1 THEN r.overall_rating ELSE NULL END) AS reviews_count
            FROM professors p 
            LEFT OUTER JOIN prof_ratings r 
            ON p.id=r.prof_id 
            WHERE p.school_id = ? AND p.approved = 1
            GROUP BY p.id, p.name, p.lastname
            ORDER BY average DESC
            LIMIT 3", [$id]);
	}

      public static function findComplete() {

            return self::select('professors.id','professors.name','professors.lastname',
                  'professors.school_id','professors.department_id','professors.directory_url',
                  'professors.created_at','schools.id as schoolID','schools.name as school',
                  'school_departments.id as deptID', 'school_departments.name as department')
                  ->leftJoin('schools','professors.school_id','=','schools.id')
                  ->leftJoin('school_departments','professors.department_id','=','school_departments.id');
      }
}

?>