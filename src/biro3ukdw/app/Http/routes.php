<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/* home */
Route::get('/home','HomeController@index');

/* Beasiswa */
Route::get('/beasiswa/{id}','BeasiswaController@');   
Route::get('/beasiswa/new','BeasiswaController@');    
Route::get('/beasiswa/edit/{id}','BeasiswaController@');    
  
  
 /* News */
Route::get('/news/{id}','NewsController@');
Route::get('/news/new','NewsController@');
Route::get('/news/edit/{id}','NewsController@');

 /* Ukm */
Route::get('/ukm/{id}','UkmController@');
Route::get('/ukm/new','UkmController@');
Route::get('/ukm/edit/{id}','UkmController@');

 /* Event */
Route::get('/event/{id}','EventController@');
Route::get('/event/new','EventController@');
Route::get('/event/edit/{id}','EventController@');

 /* Admin */
Route::get('/admin/organize','AdminController@');

 /* Searh */
//Route::get('/search?query={}','SearchController@');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
