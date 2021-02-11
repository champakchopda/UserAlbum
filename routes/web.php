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
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', 'HomeController@index')->name('register_form');
Route::post('/registration', 'HomeController@store')->name('registraion_create');
Route::post('/login_user', 'HomeController@Login')->name('login_user');
Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', 'HomeController@Dashboard')->name('dashboard');
Route::get('/createalbum', 'AlbumController@index')->name('createalbum');
Route::post('/save_album', 'AlbumController@store')->name('save_album');
Route::get('/albumlist', 'AlbumController@Albumlist')->name('albumlist');
Route::get('/albumlistloaddata', 'AlbumController@LoadData')->name('albumlistloaddata');


Route::get('/albumsearch','AlbumController@Albumsearch')->name('albumsearch');
Route::post('/likealbum', 'AlbumController@Likeupdate')->name('likealbum');
Route::post('/searchbydate', 'AlbumController@SearchbyDate')->name('searchbydate');
Route::post('/deletealbum', 'AlbumController@Deletealbum')->name('deletealbum');
});


