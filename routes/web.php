<?php

// - report anomality to admin in professor controller
// - 'are you :professor'? link
// -  add captcha and TOS on sign up, ratings, corrections, report
// - Page for TOS, privacy policy
// - Consider space for ads
// - work on mobile version
// - use query builder on School ORM, SchoolRating ORM, 
// - fix animation on side module
// - standardize first 3 module on custom.js
// - change links color 
// - re organize search results order
// - connect index component
// - ENTIRE ADMIN PANEL
// - USER PROFILE: test update on professor join account

Route::get('/', 'HomeController@index')->name('index');

Route::group(['middleware' => 'auth'], function() {

	Route::get('/profile','UserController@profile')->name('profile');

	Route::post('/profile/password','UserController@updatePassword')->name('profile.password');

	Route::post('/profile/details','UserController@updateAccount')->name('profile.details');
});

Route::get('/prof/{id?}', ['as' => 'prof.view', 'uses' => 'ProfessorController@load']);

Route::get('/school/{id?}',['as' => 'school.view', 'uses' => 'SchoolController@load']);

Route::post('/prof/{id?}', ['as' => 'prof.rate', 'uses' => 'RatingController@rateProf']);

Route::post('/school/{id?}', ['as' => 'school.rate', 'uses' => 'RatingController@rateSchool']);

Route::post('/report/correction/prof', ['as' => 'prof.correction', 
			'uses' => 'ProfessorController@submitCorrection']);

Route::post('/report/correction/school', ['as' => 'school.correction', 
			'uses' => 'SchoolController@submitCorrection']);

Route::post('/prof/rating/rate', ['as' => 'prof.rateRating', 'uses' => 'RatingController@rateProfReview']);

Route::post('/prof/rating/report', ['as' =>'prof.reportRating', 'uses' => 'RatingController@reportRating']);

Route::post('/school/rating/rate', ['as' => 'school.rateRating', 'uses' => 'RatingController@rateSchoolReview']);

Route::post('/school/rating/report', ['as' =>'school.reportRating', 'uses' => 'RatingController@reportRating']);

Route::get('/account', function () {
    return view('account.profile');
});

Route::get('/add/prof', function () {
    return view('add.prof');
});

Route::get('/add/school', function () {
    return view('add.school');
});

Route::get('/search', 'HomeController@search')->name('pages.search');

Route::get('/fetch/all', 'HomeController@fetchAll')->name('fetch.all');

Route::get('/fetch/schools', 'SchoolController@loadAll')->name('fetch.schools');

Route::get('/fetch/departments', 'DepartmentController@loadAll')->name('fetch.departments');

Route::get('/fetch/profs', 'ProfessorController@loadAll')->name('fetch.profs');

Route::post('/add/prof', 'ProfessorController@create')->name('add.prof');

Route::post('/add/school', 'SchoolController@create')->name('add.school');	

Route::group(['prefix' => '/admin', 'middleware' => '\App\Http\Middleware\IsAdmin'], function() {

	Route::get('/', function () {
	    return view('admin.index');
	})->name('admin.index');

	Route::get('/prof', function () {
	    return view('admin.profs');
	})->name('admin.profs');

	Route::get('/school', function () {
	    return view('admin.schools');
	})->name('admin.schools');

	Route::get('/users', function () {
	    return view('admin.users');
	})->name('admin.users');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
