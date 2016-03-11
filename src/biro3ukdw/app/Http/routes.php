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
Route::get('/beasiswa/','BeasiswaController@index');  
Route::post('/beasiswa/new','BeasiswaController@submit_new');
Route::get('/beasiswa/new','BeasiswaController@create');
Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');
Route::post('/beasiswa/update/{id}','BeasiswaController@update');
Route::get('/beasiswa/{id}','BeasiswaController@detail');         
  
  
 /* News */

Route::post('/news/{id}','NewsController@index');
Route::get('/news/new','NewsController@create');
Route::post('/news/edit/{id}','NewsController@edit');
Route::post('/news/new','NewsController@submit_new'); 
Route::post('/news/update/{id}','NewsController@update');



 /* Ukm */
Route::get('/ukm','UkmController@index');
Route::get('/ukm/new','UkmController@create');
Route::post('/ukm/new','UkmController@submit_new');

 /* Event */
Route::get('/event/','EventController@index');  
Route::post('/event/new','EventController@submit_new');
Route::get('/event/new','EventController@create');
Route::get('/event/edit/{id}','EventController@edit');
Route::post('/event/update/{id}','EventController@update');
Route::get('/event/{id}','EventController@detail');    

Route::get('/alan/test',function(){
    return view('tes');
});

Route::get('/welly',function(){
    return view('news.create');
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
