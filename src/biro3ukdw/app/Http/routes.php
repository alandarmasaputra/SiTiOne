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
<<<<<<< HEAD

use App\User;

Route::get('/', "UserController@index");
=======
/* home */
<<<<<<< HEAD
Route::get('/home','HomeController@index');
=======
Route::get('/home', function () {   
    return view('welcome');
});
>>>>>>> 4f9b61be3c7717b600794cc431214ba2b29d02d3
>>>>>>> 3b7db019fe0c62bf7c8b27981e08b7982feb8049

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
