<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Professor extends Model {
	protected $fillable = ['name', 'lastname', 'school_id', 'department_id'];

	public static function loadTopAtSchool($id) {

		return DB::select("SELECT p.id, p.name, p.lastname, AVG(r.overall_rating) AS average, COUNT(r.overall_rating) AS reviews_count
            FROM professors p 
            LEFT OUTER JOIN prof_ratings r 
            ON p.id=r.prof_id 
            WHERE p.school_id = ? AND p.approved = 1
            GROUP BY p.id, p.name, p.lastname
            ORDER BY average DESC
            LIMIT 3", [$id]);
	}
}

?>