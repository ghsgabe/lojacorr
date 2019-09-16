<?php

//Home
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Users
Route::get('/users', 'UserController@index');
Route::post('/users/update/{id}', 'UserController@update');
Route::post('/users/updatepass/{id}', 'UserController@updatePass');
Route::get('/users/delete/{id}', 'UserController@destroy');
Route::get('/users/cep/{cep}', 'UserController@cep');