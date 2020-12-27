<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','MasterController@index')->name('index');
Route::get('/show/{id}','MasterController@show')->name('show');
Route::get('/tagfilter/{id}','MasterController@tagfilter')->name('tagfilter');

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');
Route::get('/listofusers', 'HomeController@listofusers')->middleware('auth');
Route::get('/adduser', 'HomeController@create')->middleware('auth');
Route::post('/storeuser', 'HomeController@store')->middleware('auth');
Route::get('/showuser/{id}', 'HomeController@show')->middleware('auth');
Route::get('/edituser/{id}', 'HomeController@edit')->middleware('auth');
Route::post('/editupdate/{id}', 'HomeController@update')->middleware('auth');
Route::get('/profile/{id}', 'HomeController@profile')->middleware('auth');
Route::post('/profileupdate/{id}', 'HomeController@profileupdate')->middleware('auth');
Route::get('/destroyuser/{id}','HomeController@destroy')->middleware('auth');


Route::get('/listofpost', 'PostsController@index')->middleware('auth');
Route::get('/addpost', 'PostsController@create')->middleware('auth');
Route::post('/storepost', 'PostsController@store')->middleware('auth');
Route::get('/showpost/{id}', 'PostsController@show')->middleware('auth');
Route::get('/editpost/{id}', 'PostsController@edit')->middleware('auth');
Route::post('/postupdate/{id}', 'PostsController@update')->middleware('auth');
Route::get('/destroypost/{id}','PostsController@destroy')->middleware('auth');


Route::get('/tag', 'TagsController@index')->middleware('auth');
Route::get('/addtag', 'TagsController@create')->middleware('auth');
Route::post('/storetag', 'TagsController@store')->middleware('auth');
Route::get('/showtag/{id}', 'TagsController@show')->middleware('auth');
Route::get('/edittag/{id}', 'TagsController@edit')->middleware('auth');
Route::post('/tagupdate/{id}', 'TagsController@update')->middleware('auth');
Route::get('/destroytag/{id}','TagsController@destroy')->middleware('auth');

Route::get('permission_error','HomeController@errorpage');