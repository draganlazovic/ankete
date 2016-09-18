<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/surveys', 'SurveysController@index');
Route::get('/surveys/{id}', 'SurveysController@show');
Route::get('/surveys/{id}/answers', 'SurveysController@answers');
Route::get('/surveys/{id}/csv', 'SurveysController@csv');
Route::post('/surveys', 'SurveysController@store');

Route::post('/questions', 'QuestionsController@store');

Route::get('/answers/{slug}', 'AnswersController@show');
Route::post('/answers', 'AnswersController@store');
