<?php

// add token in login password reset 

Route::get('/', function () {
    return view('index');
})->name('index');


Route::get('/prof', function () {
    return view('pages.professor');
});

Route::get('/school', function () {
    return view('pages.school');
});

Route::get('/signup', function () {
    return view('account.signup');
});

Route::get('/signin', function () {
    return view('account.login');
});

Route::get('/account', function () {
    return view('account.profile');
});

Route::get('/add/prof', function () {
    return view('add.prof');
});

Route::get('/add/school', function () {
    return view('add.school');
});

Route::get('/search', function () {
    return view('pages.search');
});


Route::post('/add/prof', 'ProfessorController@create')->name('prof');

Route::post('/add/school', 'SchoolController@create')->name('add.school');	

Route::group(['prefix' => '/admin', 'as' => 'admin', 'middleware' => '\App\Http\Middleware\IsAdmin'], function() {

	Route::get('/', function () {
	    return view('admin.index');
	});

	Route::get('/prof', function () {
	    return view('admin.profs');
	});

	Route::get('/school', function () {
	    return view('admin.schools');
	});

	Route::get('/users', function () {
	    return view('admin.users');
	});

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
