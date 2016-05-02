<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::group(['prefix' => 'activedirectoryinspector'], function() {
//	Route::get('/', function() {
//		dd('This is the ActiveDirectoryInspector module index page.');
//	});
//});

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

//Route::group(['prefix' => 'activedirectoryinspector', 'middleware' => ['web']], function () {
//	//
//});



// Routes in this group must be authorized.
Route::group(['middleware' => 'authorize'], function () {

    // ActiveDirectoryInspector routes
    Route::group(['prefix' => 'activedirectoryinspector'], function () {
        Route::get( '/',               ['as' => 'activedirectoryinspector.home',   'uses' => 'ActiveDirectoryInspectorController@home']);
        Route::post('/search',         ['as' => 'activedirectoryinspector.search', 'uses' => 'ActiveDirectoryInspectorController@search']);
        Route::get( '/show/{dn}',      ['as' => 'activedirectoryinspector.show',   'uses' => 'ActiveDirectoryInspectorController@show']);
    }); // End of ActiveDirectoryInspector group


}); // end of AUTHORIZE middleware group
