<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

	public function loadAll() {
		return Department::all();
	}
}



?>