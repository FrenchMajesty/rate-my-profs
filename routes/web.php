<?php

// - report anomality to admin in professor controller
// - submit correction popup
// - 'are you :professor'? link
// -  add captcha and TOS on sign up, ratings, corrections, report
// - Page for TOS, privacy policy
// - Consider space for ads
// - add search query on pages links

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/prof/{id?}', ['as' => 'prof.view', 'uses' => 'ProfessorController@load']);

Route::get('/school/{id?}',['as' => 'school.view', 'uses' => 'SchoolController@load']);

Route::post('/prof/{id?}', ['as' => 'prof.rate', 'uses' => 'ProfessorController@rate']);

Route::post('/report/correction/prof', ['as' => 'prof.correction', 'uses' => 'ProfessorController@submitCorrection']);

Route::post('/prof/rating/rate', ['as' => 'prof.rateRating', 'uses' => 'RatingController@rateProfReview']);

Route::post('/prof/rating/report', ['as' =>'prof.reportRating', 'uses' => 'RatingController@reportRating']);

//Route::post('/school/rate', ['as' => 'rate.review.school', 'uses' => 'RatingController@rateSchoolReview']);

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

Route::get('/fetch/schools', 'SchoolController@loadAll')->name('fetch.schools');

Route::get('/fetch/departments', 'DepartmentController@loadAll')->name('fetch.departments');

Route::get('/fetch/profs', 'ProfessorController@loadAll')->name('fetch.profs');

Route::post('/add/prof', 'ProfessorController@create')->name('add.prof');

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
