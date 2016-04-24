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



/* home */






/* Beasiswa */        
  
  
 /* News */



    


 /* Ukm */

 /* Event */   

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
	
	Route::group(['middleware' => 'auth'], function(){
		
		Route::post('/event/new','EventController@submit_new');
		Route::get('/event/new','EventController@create');
		Route::get('/event/edit/{id}','EventController@edit');
		Route::post('/event/update/{id}','EventController@update');
		Route::get('/event/delete/{id}','EventController@delete');
		
		Route::get('/ukm/new',['as'=>'ukm_new', 'uses'=>'UkmController@create']);
		Route::post('/ukm/new',['as'=>'ukm_new', 'uses'=>'UkmController@submit_new']);
		Route::get('/ukm/edit/{id}',['as'=>'ukm_edit', 'uses'=>'UkmController@edit']);
		Route::post('/ukm/update/{id}',['as'=>'ukm_update', 'uses'=>'UkmController@update']);
		Route::get('/ukm/delete/{id}','UkmController@delete');
		
		Route::get('/news/new',['as'=>'news_new', 'uses'=>'NewsController@create']);
		Route::post('/news/new',['as'=>'news_new', 'uses'=>'NewsController@submit_new']);
		Route::get('/news/edit/{id}',['as'=>'news_edit', 'uses'=>'NewsController@edit']);
		Route::post('/news/update/{id}',['as'=>'news_update', 'uses'=>'NewsController@update']);
        Route::get('/news/delete/{id}','NewsController@delete');
		
		Route::get('/beasiswa/new','BeasiswaController@create');
		Route::post('/beasiswa/new','BeasiswaController@submit_new');
		Route::get('/beasiswa/edit/{id}','BeasiswaController@edit');
		Route::post('/beasiswa/update/{id}','BeasiswaController@update');
		Route::get('/beasiswa/delete/{id}','BeasiswaController@delete');

        Route::get('/user', "UserController@index");
        Route::get('/cruduser/edit/{id}',"UserController@edit");
        Route::post('/cruduser/update/{id}',['as'=>'cruduser_update', 'uses'=>'UserController@update']);
        Route::get('/cruduser/new',['as'=>'cruduser_new', 'uses'=>'UserController@create']);
        Route::post('/cruduser',['as'=>'cruduser_new', 'uses'=>'UserController@store']);
        Route::get('/cruduser/resets/{id}',"UserController@resets");
        Route::post('/cruduser/updates/{id}','UserController@updatess');
		Route::get('/search','SearchController@search');

        
        Route::post('editprofile/editself','EditProfileController@editself');
        Route::get('/editprofile', "EditProfileController@index");

		Route::post('/profil/edit','HomeController@profilupdate');
		Route::get('/profil/edit','HomeController@profiledit');
		
		Route::post('/profil/saveavatar','HomeController@profilavatarsave');
		Route::post('/profil/checkavatar','HomeController@profilavatarcheck');
        

        Route::resource('user', 'UserController');
	});
	
	Route::get('/home',function(){
		return redirect(url('/'));
	});
	Route::get('/', "HomeController@index");
	Route::get('/login', "HomeController@login");
	Route::post('/login', "HomeController@trylogin");
	Route::get('/logout', "HomeController@logout");

	
    Route::resource('user','UserController');
	Route::get('/user', "UserController@index");

	Route::post('/event/list','EventController@getList');
    Route::get('/event/','EventController@index');  
    Route::get('/event/{id}','EventController@detail'); 
	
	Route::post('/ukm/list','UkmController@getList');
    Route::get('/ukm/{id}',['as'=>'ukm_get', 'uses'=>'UkmController@detail']);
    Route::get('/ukm/',['as'=>'ukm_index', 'uses'=>'UkmController@index']);
    Route::get('/ukm',['as'=>'ukm_index', 'uses'=>'UkmController@index']);

    Route::post('/news/list','NewsController@getList');
    Route::get('/news/{id}',['as'=>'news_get', 'uses'=>'NewsController@detail']);
    Route::get('/news',['as'=>'news_index', 'uses'=>'NewsController@index']);
    Route::get('/news/',['as'=>'news_index', 'uses'=>'NewsController@index']);
    

	Route::post('/beasiswa/list','BeasiswaController@getList');
	Route::get('/beasiswa/','BeasiswaController@index');  
	Route::get('/beasiswa/{id}','BeasiswaController@detail'); 
	
    Route::get('/profil','HomeController@profil');


});
