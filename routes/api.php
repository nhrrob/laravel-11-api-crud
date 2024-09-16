<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', '\App\Http\Controllers\Api\AuthController@register');
Route::post('login', '\App\Http\Controllers\Api\AuthController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', '\App\Http\Controllers\Api\AuthController@logout');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group([ 'namespace'=> '\App\Http\Controllers\Api\V1', 'prefix' => 'v1',  'as'=>'v1.', 'middleware' => ['auth:sanctum']], function () { 
  Route::get('/projects/search/{title}', 'ProjectController@search')->name('projects.search'); 
  Route::apiResource('projects', 'ProjectController'); 
});

Route::group([ 'namespace'=> '\App\Http\Controllers\Api\V1\Admin', 'prefix' => 'v1/admin',  'as'=>'v1.admin.', 'middleware' => ['auth:api']], function () { 
  Route::get('/projects/search/{title}', 'ProjectController@search')->name('projects.search'); 
  Route::apiResource('projects', 'ProjectController'); 
});