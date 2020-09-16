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

Route::get('logout', 'Auth\LoginController@logout')->middleware('auth');

Route::get('/dashboard', 'HomeController@index');

Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');

Route::get('/data-admin/create', 'AdminController@create'); // menampilkan halaman form
Route::post('/data-admin', 'AdminController@store'); // menyimpan data
Route::get('/data-admin', 'AdminController@index'); // menampilkan semua
Route::get('/data-admin/{id}', 'AdminController@show'); // menampilkan detail item dengan id
Route::get('/data-admin/{id}/edit', 'AdminController@edit'); // menampilkan form untuk edit item
Route::put('/data-admin/{id}', 'AdminController@update'); // menyimpan perubahan dari form edit
Route::delete('/data-admin/{id}', 'AdminController@destroy'); // menghapus data dengan id

Route::resource('data-role', 'RoleController');
Route::resource('data-esccort', 'EsccortController');
Route::post('data-esccort/store', 'EsccortController@store');
Route::post('updatestatus', 'TransaksiController@updatestatus');

Route::group(['prefix' => 'api'], function () {
    
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'lansia'], function () {
        Route::get('/', 'MasterController@lansia');
        Route::get('/get', 'MasterController@getDataLansia');
    });
    
    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', 'TransaksiController@index');
        Route::get('/verifikasi', 'TransaksiController@indexverif');
        Route::get('/getpesan', 'TransaksiController@getDataTransaksi');
        Route::get('/getverif', 'TransaksiController@getDataVerif');
    });
});