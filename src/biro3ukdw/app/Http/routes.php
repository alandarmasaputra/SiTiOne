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


use App\User;


Route::get('/', "UserController@index");

/* home */



Route::get('/home', function () {   
    return view('welcome');
});

Route::resource('news','NewsController');


/* Beasiswa */
Route::get('/beasiswa/{id}','BeasiswaController@');   
Route::get('/beasiswa/new','BeasiswaController@');        
  
  
 /* News */

Route::get('/news/{id}','NewsController@update');
Route::get('/news/new','NewsController@new');


 /* Ukm */
Route::get('/ukm','UkmController@index');
Route::get('/ukm/{id}','UkmController@');
Route::get('/ukm/new','UkmController@');

 /* Event */
Route::get('/event/{id}','EventController@');
Route::get('/event/new','EventController@');

Route::get('/alan/test',function(){
    return view('tes');
});

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
    Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');
    Route::get('/news/edit/{id}','NewsController@edit');
    Route::get('/ukm/edit/{id}','UkmController@edit');
    Route::get('/event/edit/{id}','EventController@edit');
    Route::get('/admin/organize','AdminController@organize');
});
