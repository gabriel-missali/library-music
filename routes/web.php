<?php

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
    if(!Auth::user()){
      return view('auth/login');
    } else {
      return redirect('home');
      // return view('home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search');

Route::get('/users', 'UserController@index')->middleware('admin');
Route::get('/new-user', 'UserController@viewUserAdd')->middleware('admin');
Route::get('/edit-user/{id}', 'UserController@viewUserEdit')->middleware('admin');
Route::resource('user','UserController')->middleware('admin');

Route::get('new-band-artist', 'BandArtistController@viewBandArtistAdd')->middleware('user');
Route::get('edit-band-artist/{id}', 'BandArtistController@viewBandArtistEdit')->middleware('user');
Route::resource('band-artist','BandArtistController')->middleware('user');
Route::get('band-artist','BandArtistController@index');

Route::get('new-album', 'AlbumController@viewAlbumAdd')->middleware('user');
Route::get('edit-album/{id}', 'AlbumController@viewAlbumEdit')->middleware('user');
Route::resource('album','AlbumController')->middleware('user');
Route::get('album','AlbumController@index');

Route::get('new-song/{id}', 'SongController@viewSongAdd')->middleware('user');
Route::get('edit-song/{id}', 'SongController@viewSongEdit')->middleware('user');
Route::get('song/{id}','SongController@show');
Route::resource('song','SongController')->middleware('user');
