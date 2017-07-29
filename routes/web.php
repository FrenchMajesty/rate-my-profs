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