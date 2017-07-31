<?php

Route::get('/', function () {
    return view('index');
});


Route::get('/prof', function () {
    return view('pages.professor');
});

Route::get('/school', function () {
    return view('pages.school');
});

Route::get('/signup', function () {
    return view('account.signup');
});

Route::get('/login', function () {
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
    return view('search');
});

