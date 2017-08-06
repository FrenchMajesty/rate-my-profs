<?php

namespace App;

use App\School;
use Illuminate\Database\Eloquent\Model;


class School extends Model {
	protected $fillable = ['name', 'nickname', 'location', 'website']; 
}

?>