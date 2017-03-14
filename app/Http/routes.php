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

Route::get('/','HomeController@welcome');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('projects','ProjectController');
//Route::group(['middleware'=>'isnow'],function() {
    Route::get('tasks/charts', ['as' => 'tasks.charts', 'uses' => 'TasksController@charts']);
    Route::resource('tasks', 'TasksController');
//});
Route::post('tasks/{id}/check',['as'=>'tasks.check','uses'=>'TasksController@check']);
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::resource('roles','RolesController');
    Route::resource('Permissions','PermissionsController');
    Route::resource('users','UsersController');
});