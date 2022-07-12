<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\DB;
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
    return view('home');
});

Route::get('/device/create', [DeviceController::class, 'createDevice']);
Route::get('/device/in', [DeviceController::class, 'listInDevice']);
Route::get('/device/on-hand-good', [DeviceController::class, 'onHandGood']);
Route::get('/device/on-hand-bad', [DeviceController::class, 'onHandBad']);
Route::get('/device/out', [DeviceController::class, 'listOutDevice']);
