<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Department extends Model {
	protected $table = 'school_departments';
	protected $fillable = ['name'];
}

?>