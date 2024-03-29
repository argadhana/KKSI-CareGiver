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

Route::get('/dashboard/data-chart-user', 'DashboardController@user');
Route::get('/dashboard/data-chart-pemesanan', 'DashboardController@pemesanan');

Route::get('/data-admin/create', 'AdminController@create'); // menampilkan halaman form
Route::post('/data-admin', 'AdminController@store'); // menyimpan data
Route::get('/data-admin', 'AdminController@index'); // menampilkan semua
Route::delete('/data-admin/{id}', 'AdminController@destroy'); // menghapus data dengan id

Route::get('/data-customer', 'CustomerController@index'); // menampilkan semua
Route::get('/data-customer/{id}', 'CustomerController@show'); // menampilkan detail item dengan id


Route::resource('data-role', 'RoleController');

// Route::get('/data-esccort/create', 'EsccortController@create');
// Route::post('/data-esccort/store', 'EsccortController@store');
// Route::get('/data-esccort', 'EsccortController@index');
// Route::get('/data-esccort/{id}', 'EsccortController@show');
// Route::get('/data-esccort/{id}/edit', 'EsccortController@edit');
// Route::put('/data-esccort/{id}', 'EsccortController@update');
// Route::delete('/data-esccort/{id}', 'EsccortController@destroy');


Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'lansia'], function () {
        Route::get('/', 'MasterController@lansia');
        Route::get('/get', 'MasterController@getDataLansia');
        Route::get('/delete/{id}', 'MasterController@del');
        Route::post('/simpan', 'MasterController@simpan');
        Route::get('/load/{id}', 'MasterController@loadlansia');
        Route::post('/update', 'MasterController@updatelansia');
    });

    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index');
        Route::get('/get', 'CustomerController@getDataCustomer');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'MasterController@role');
        Route::get('/get', 'MasterController@getDataRole');
    });
    
    Route::group(['prefix' => 'cg'], function () {
        Route::get('/', 'EsccortController@index');
        Route::get('/get', 'MasterController@getDataEsccort');
        Route::get('/delete/{id}', 'EsccortController@destroy');
        Route::post('/simpan', 'EsccortController@store');
        Route::get('/load/{id}', 'EsccortController@edit');
        Route::post('/update', 'EsccortController@update');
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', 'TransaksiController@index');
        Route::get('/verifikasi', 'TransaksiController@indexverif');
        Route::get('/getpesan', 'TransaksiController@getDataTransaksi');
        Route::get('/getverif', 'TransaksiController@getDataVerif');
    });
    
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'MasterController@admin');
        Route::get('/get', 'MasterController@getDataAdmin');
        // Route::get('/delete/{id}', 'EsccortController@destroy');
        // Route::post('/simpan', 'EsccortController@store');
        // Route::get('/load/{id}', 'EsccortController@edit');
        // Route::post('/update', 'EsccortController@update');
    });
});
