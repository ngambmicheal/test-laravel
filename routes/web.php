<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function($auth){
    $auth->resource('tasks', 'TaskController');
    $auth->get('/tasks/{id}/update-priority', 'TaskController@updatePriority');
    $auth->get('/get-projects', 'TaskController@getProjects'); 


    $auth->resource('projects', 'ProjectController');
    $auth->get('/projects/{id}/tasks', 'ProjectController@tasks');
});
