<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SchoolRating extends Model {
	protected $fillable = ['user', 'school_id', 'overall_rating', 'location','facility', 'opportunity',
							'social', 'comment', 'address_ip'];
	protected $table = 'school_ratings';

	public static function getAllRatings($id) {

		return DB::select("SELECT r.id, r.school_id,r.overall_rating, r.location, r.facility, r.opportunity, r.social, r.comment, r.created_at, 
            SUM(CASE WHEN v.value > 0 THEN v.value ELSE 0 END) AS upvote,
            SUM(CASE WHEN v.value < 0 THEN 1 ELSE 0 END) AS downvote
                FROM school_ratings r 
                LEFT OUTER JOIN ratings_votes v 
                ON r.id=v.rating_id 
                WHERE r.school_id = ? AND r.validated = 1
                GROUP BY r.id, r.school_id, r.overall_rating, r.location, r.facility, r.opportunity, r.social, r.comment, r.created_at
                ORDER BY r.id DESC", [$id]);
	}
}

?>