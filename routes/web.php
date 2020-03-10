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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('account/{account_number}', 'HomeController@detail');

// Transaksi
Route::get('transaction/balance/{account_number}', 'HomeController@balance');
Route::post('transaction/balance/{account_number}', 'HomeController@store_balance');

Route::get('transaction/transfer/{account_number}', 'HomeController@transfer');
Route::post('transaction/transfer/{account_number}', 'HomeController@store_transfer');

Route::get('transaction/pulsa/{account_number}', 'HomeController@pulsa');
Route::post('transaction/pulsa/{account_number}', 'HomeController@store_pulsa');

Route::get('transaction/point/{account_number}', 'HomeController@point');
Route::post('transaction/point/{account_number}', 'HomeController@store_point');

