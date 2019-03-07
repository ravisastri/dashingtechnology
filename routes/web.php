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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/','ItemController@importExport');
Route::get('importExport', 'ItemController@importExport');
Route::get('downloadExcel/{type}', 'ItemController@downloadExcel');
Route::post('importExcel', 'ItemController@importExcel');
Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));
