<?php

use App\Http\Controllers\API\Backend\StallResource\StallResourceController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => ['web']], function () {
Route::get( 'download-resource/{id}', [StallResourceController::class, 'download_resource']);

Route::group(['namespace' => 'Backend'], function(){

    Route::get('/admin', 'HomeController@index');
    Route::get('/admin/{any}', 'HomeController@index')->where('any', '.*');

});

Route::group(['namespace' => 'Company'], function(){

    Route::get('/company-panel', 'HomeController@index');
    Route::get('/company-panel/{anycompany}', 'HomeController@index')->where('anycompany', '.*');

});

Route::group(['namespace' => 'WebRtc'], function(){

    Route::get('/websession', 'WebRtcController@index');
    Route::get('/websession/{anyfirebase}', 'WebRtcController@index')->where('anywebsession', '.*');

});

Route::group(['namespace' => 'Firebase'], function(){

    Route::get('/vnc', 'FirebaseController@index');
    Route::get('/vnc/{anyfirebase}', 'FirebaseController@index')->where('anyfirebase', '.*');

});


Route::group(['namespace' => 'Frontend'], function(){

    Route::get('/', 'HomeController@index');
    Route::get('/{path}', 'HomeController@index')->where('path','([A-z\d\-\/_.]+)?');

});

});

