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
Route::get('/beasiswa/{id}','BeasiswaController@detail');         
  
  
 /* News */

Route::post('/news/{id}','NewsController@index');
Route::get('/news/new','NewsController@create');
Route::post('/news/edit/{id}','NewsController@edit');
Route::post('/news/new','NewsController@submit_new'); 
Route::post('/news/update/{id}','NewsController@update');

    


 /* Ukm */

 /* Event */   

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

    Route::get('/event/','EventController@index');  
    Route::post('/event/new','EventController@submit_new');
    Route::get('/event/new','EventController@create');
    Route::get('/event/edit/{id}','EventController@edit');
    Route::post('/event/update/{id}','EventController@update');
    Route::get('/event/{id}','EventController@detail'); 

    Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');
    Route::get('/news/edit/{id}','NewsController@edit');
    Route::get('/event/edit/{id}','EventController@edit');
    Route::get('/admin/organize','AdminController@organize');
    
    Route::get('/ukm/new',['as'=>'ukm_new', 'uses'=>'UkmController@create']);
    Route::post('/ukm/new',['as'=>'ukm_new', 'uses'=>'UkmController@submit_new']);
    Route::get('/ukm/edit/{id}',['as'=>'ukm_edit', 'uses'=>'UkmController@edit']);
    Route::post('/ukm/update/{id}',['as'=>'ukm_update', 'uses'=>'UkmController@update']);
    Route::get('/ukm/{id}',['as'=>'ukm_get', 'uses'=>'UkmController@detail']);
    Route::get('/ukm',['as'=>'ukm_index', 'uses'=>'UkmController@index']);
    
    Route::post('/beasiswa/new','BeasiswaController@submit_new');
    Route::get('/beasiswa/new','BeasiswaController@create');
    Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');
    Route::post('/beasiswa/update/{id}','BeasiswaController@update');
});
