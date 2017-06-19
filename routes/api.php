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
    return redirect('poi');
});
Route::get('poi/find/{dmax?}/{coordinate_x?}/{coordinate_y?}', 'PoiController@find')->name('poi.find');
Route::resource('poi', 'PoiController', ['except' => ['edit', 'create']]);