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

//Route::auth();
//
// Authentication Routes...
Route::get('login', [
	'as' => 'login',
	'uses' => 'Auth\AuthController@showLoginForm',
	]);
Route::post('login', [
	'as' => 'doLogin',
	'uses' => 'Auth\AuthController@login',
	]);
Route::get('logout', [
	'as' => 'logout',
	'uses' => 'Auth\AuthController@logout',
	]);
    // Registration Routes...
//Route::get('register', 'Auth\AuthController@showRegistrationForm');
//Route::post('register', 'Auth\AuthController@register');
    // Password Reset Routes...
// Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
// Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
// Route::post('password/reset', 'Auth\PasswordController@reset');



//Routes principales stock
Route::get('/', [
	'as' => 'accueil',
	'uses' => 'StockController@index',
	]);

//Route gestion stock
Route::group(['prefix' => 'stock'], function() {
	Route::get('/', [
		'as' => 'viewStock',
		'uses' => 'StockController@stock',
		]);
	Route::get('/extract', [
		'as' => 'viewExtractStock',
		'uses' => 'StockController@extract',
		]);
	Route::post('/extract/etat', [
		'as' => 'getExtractEtatStock',
		'uses' => 'StockController@extractEtatStock',
		]);
	Route::post('/extract/conso', [
		'as' => 'getExtractConso',
		'uses' => 'StockController@extractConso',
		]);
	//Routes d'ajout/suppression
	Route::post('/add', [
		'as' => 'addStock',
		'uses' => 'StockController@addStock'
		]);
	Route::post('/remove', [
		'as' => 'removeStock',
		'uses' => 'StockController@removeStock'
		]);
	//
	Route::get('/entrees', [
		'as' => 'entrees',
		'uses' => 'StockController@entrees',
		]);
	Route::get('/sorties', [
		'as' => 'sorties',
		'uses' => 'StockController@sorties',
		]);
});

//Route reference
Route::group(['prefix' => 'reference'], function() {
	Route::match(['get', 'post'], '/edit/{id}', [
		'as' => 'updateReference',
		'uses' => 'StockController@updateReference'
		]);
	Route::delete('/delete/{id}', [
		'as' => 'deleteReference',
		'uses' => 'StockController@deleteRefence'
		]);
	Route::match(['get', 'post'], '/create', [
		'as' => 'createReference',
		'uses' => 'StockController@createReference'
		]);
});

//Route pour gestion user
Route::group(['prefix' => 'user'], function() {
	Route::get('/', [
		'as' => 'viewUsers',
		'uses' => 'UserController@viewUsers',
		]);
	Route::match(['get', 'post'], '/edit/{id}', [
		'as' => 'updateUser',
		'uses' => 'UserController@updateUser'
		]);
	Route::delete('/delete/{id}', [
		'as' => 'deleteUser',
		'uses' => 'UserController@deleteUser'
		]);
	Route::match(['get', 'post'], '/create', [
		'as' => 'createUser',
		'uses' => 'UserController@createUser'
		]);
	Route::match(['get', 'post'], '/profile', [
		'as' => 'profileUser',
		'uses' => 'UserController@profileUser'
		]);
});


