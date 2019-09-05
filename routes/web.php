<?php

//Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Users
Route::get('/users', 'UserController@index')->name('users.table');
Route::post('/users/update/{id}', 'UserController@update');
Route::post('/users/updatepass/{id}', 'UserController@updatePass')->name('users.table');
Route::get('/users/delete/{id}', 'UserController@destroy')->name('users.table');