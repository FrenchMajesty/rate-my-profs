<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function create(Request $request) {

        $school = new School;
        $name = $request->name;
        $nickname = $request->nickname;
        $state = $request->state;
        $city = $request->city;
        $website = $request->website;
        $email = $request->email;
        $errors = [];

        $this->validate($request, [
            'name' => 'required|string|unique:schools',
            'nickname' => 'required|alpha',
            'city' => 'required|string',
            'state' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|url'
        ]);

        return School::create([
            'name' => $name,
            'nickname' => $nickname,
            'location' => $state . ',' . $city,
            'website' => $website
        ]);
    }

    public function loadAll() {
        return School::all();
    }
}

?>