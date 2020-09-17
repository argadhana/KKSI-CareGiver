<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pesan', 'TransaksiController@pesan');
Route::get('/load/{id}', 'TransaksiController@loadid');
Route::post('/uploadbukti', 'TransaksiController@uploadBuktiTransaksi');
Route::get('/loadtransaksi/{id}', 'TransaksiController@loadTransaksi');


Route::group(['prefix' => 'status'], function () {
    Route::get('{id}/menunggu', 'TransaksiController@statusMenunggu');
    Route::get('{id}/dikonfirmasi', 'TransaksiController@statusDikonfirmasi');
    Route::get('{id}/belum', 'TransaksiController@statusBelum');
    Route::get('{id}/merawat', 'TransaksiController@statusMerawat');
    Route::get('{id}/selesai', 'TransaksiController@statusSelesai');
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
});

Route::group(['esccort' => 'API'], function () {
    Route::resource('esccort', 'API\EsccortController');
 });
