<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfRating extends Model {
	protected $fillable = ['user', 'prof_id', 'overall_rating', 'difficulty_rating','class_details',
					'comment', 'address_ip'];
	protected $table = 'prof_ratings';

	public static function getAllRatings($id) {

		return DB::select("SELECT r.id, r.prof_id,r.overall_rating, r.difficulty_rating, 
            r.class_details, r.comment, r.created_at, 
            SUM(CASE WHEN v.value > 0 THEN v.value ELSE 0 END) AS upvote,
            SUM(CASE WHEN v.value < 0 THEN 1 ELSE 0 END) AS downvote
            FROM prof_ratings r 
            LEFT OUTER JOIN ratings_votes v 
            ON r.id=v.rating_id 
            WHERE r.prof_id = ? AND r.validated = 1
            GROUP BY r.id, r.prof_id, r.overall_rating, r.difficulty_rating, r.class_details, r.comment, r.created_at
            ORDER BY r.id DESC", [$id]);
	}
}

?>