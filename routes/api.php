<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => ['auth:api']], function () {
    
// });

Route::post('register','API\UserController@register');
Route::post('login','API\UserController@login');

Route::middleware('auth:api')->get('/users', 'API\UserController@Index');
Route::get('test','API\UserController@test');

/**
 * BUG API routes
 */

 //list bugs 

 /**
  * Project API Routes
  */

//Route::group(['scheme' => 'https'],function(){
  //list all projects 
  Route::get('project','API\ProjectController@index');
  //list a specific project
  Route::get('project/{id}','API\ProjectController@show');//->middleware(checkForAdmin::class);

//});


Route::group(['middleware' => ['auth:api'],'scheme' => 'https'], function () {
  //create a project 
  Route::post('project','API\ProjectController@store');
  //update a project 
  Route::put('project/{id}','API\ProjectController@update' );
  //Assign a user to a project 
  Route::get('project/{project_id}/user/{user_id}','API\ProjectController@assignUser');
  //make a user an admin
  Route::get('project/{project_id}/admin/{user_id}','API\ProjectController@assignAdmin');
  //remove a user from being admin
  Route::delete('project/{project_id}/admin/{user_id}','API\ProjectController@unassignAdmin');
  //unassign a user 
  Route::delete('project/{project_id}/user/{user_id}','API\ProjectController@assignUser');
  //delete a project 
  Route::delete('project/{id}','API\ProjectController@destroy' );
});

//test route
Route::get('project/test/{id}','API\ProjectController@test');




/**
  * Bugs  API Routes
  */
  Route::group(['scheme' => 'https'],function(){
    //get all the bugs in a project 
    Route::get('project/{id}/bug','API\BugController@index');
    //get a single bug 
    Route::get('bug/{id}','API\BugController@show');
  });

  Route::group(['middleware' => ['auth:api'],'scheme' => 'https'], function () {
    //to create a new bug 
    Route::post('bug','API\BugController@store');
    //update a bug
    Route::put('bug/{id}','API\BugController@update');
    //assign a user the assigned users
    Route::get('bug/{bug_id}/user/{user_id}','API\BugController@assignUser');
    //delete or remove an assigned user
    Route::delete('bug/{bug_id}/user/{user_id}','API\BugController@unassignUser');
    //delete a bug
    Route::delete('bug/{id}','API\BugController@destroy');
  });

