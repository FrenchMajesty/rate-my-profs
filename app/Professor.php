<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model {
	protected $fillable = ['name', 'school_id', 'department_id'];
}

?>