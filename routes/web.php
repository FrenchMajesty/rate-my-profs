<?php

// - Page for TOS, privacy policy
// - standardize first 3 module on custom.js and use common for side module js
// - work on mobile version
// - Consider space for ads
// - test relative deletes for schools and prof
// - use query builder on School ORM, SchoolRating ORM,
// -  add captcha and TOS on sign up, ratings, corrections, report
// - 'are you :professor'? link
// - re organize search results order
// - change links color 
// - USER PROFILE: test update on professor join account
// - Placeholders on inputs
// - report anomality to admin in professor controller

Auth::routes();

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

	Route::get('/', 'AdminController@home')->name('admin.index');

	Route::get('/prof', 'AdminController@profs')->name('admin.profs');

	Route::get('/schools', 'AdminController@schools')->name('admin.schools');

	Route::get('/users', 'AdminController@users')->name('admin.users');

	Route::post('/prof/approve', 'AdminController@approveProf')->name('admin.profs.approve');

	Route::post('/school/approve', 'AdminController@approveSchool')->name('admin.schools.approve');

	Route::post('/prof/rating/approve', 'AdminController@approveProfRating')
			->name('admin.profs.ratings.approve');

	Route::post('/school/rating/approve', 'AdminController@approveSchoolRating')
			->name('admin.schools.ratings.approve');

	Route::post('/school/approve/update', 'AdminController@approveSchoolViaUpdate')
			->name('admin.schools.approve.update');

	Route::post('/prof/approve/update', 'AdminController@approveProfViaUpdate')
			->name('admin.profs.approve.update');

	Route::post('/prof/correction/update', 'AdminController@updateViaCorrection')
			->name('admin.corrections.update');

	Route::post('/prof/update', 'AdminController@updateProf')->name('admin.profs.update');

	Route::post('/school/update', 'AdminController@updateSchool')->name('admin.schools.update');

	Route::post('/prof/delete', 'AdminController@deleteProf')->name('admin.profs.delete');

	Route::post('/school/delete', 'AdminController@deleteSchool')->name('admin.schools.delete');

	Route::post('/corrections/delete', 'AdminController@deleteCorrection')->name('admin.corrections.delete');

	Route::post('/reports/dismiss', 'AdminController@dismissReport')->name('admin.reports.dismiss');
});
