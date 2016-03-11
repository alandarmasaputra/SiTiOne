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


Route::get('/', "HomeController@index");

/* home */



Route::get('/home', function () {   
    return redirect('/');
});




/* Beasiswa */
Route::get('/beasiswa/index','BeasiswaController@index');
Route::get('/beasiswa/{id}','BeasiswaController@detail');
Route::post('/beasiswa/update/{id}','BeasiswaController@update');
Route::post('/beasiswa/submit','BeasiswaController@submit_new');   
Route::get('/beasiswa/create','BeasiswaController@create');
Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');        
  
  
 /* News */

Route::post('/news/{id}','NewsController@update');
Route::get('/news/new','NewsController@new');
Route::post('/news/edit/{id}','NewsController@edit');


 /* Ukm */
Route::get('/ukm','UkmController@index');
Route::get('/ukm/new','UkmController@create');
Route::get('/ukm/{id}','UkmController@');

 /* Event */
Route::get('/event/index','EventController@index');
Route::get('/event/{id}','EventController@detail');
Route::post('/event/update/{id}','EventController@update');
Route::post('/event/submit','EventController@submit_new');   
Route::get('/event/create','EventController@create');
Route::get('/event/edit/{id}','EventController@edit'); 

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
