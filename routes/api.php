<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getusers/', 'Controller@getUser');
Route::post('/adduser/', 'Controller@addUser');
Route::patch('/updateuser/', 'Controller@updateUser');
Route::delete('/deleteuser/', 'Controller@deleteUser');
Route::post('/signup/', 'Controller@signUp');
Route::post('/signin/', 'Controller@signIn');