<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correction extends Model {
	protected $fillable = ['prof_is', 'school_id', 'problem', 'user']; 
}

?>