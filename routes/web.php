<?php

use App\Http\Controllers\DeviceController;
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

Route::get('/', [DeviceController::class, 'index']);

Route::get('/device/create', [DeviceController::class, 'createDevice']);
Route::post('/device/create', [DeviceController::class, 'saveDevice']);

Route::get('/device/in', [DeviceController::class, 'listInDevice']);
Route::get('/device/on-hand-good', [DeviceController::class, 'onHandGood']);
Route::get('/device/on-hand-bad', [DeviceController::class, 'onHandBad']);
Route::get('/device/out', [DeviceController::class, 'listOutDevice']);

Route::get('/device/verify/{id}', [DeviceController::class, 'verifyDevice']);
Route::put('/device/verify/{id}', [DeviceController::class, 'verifyConditionDevice']);

Route::get('/device/sell/{id}', [DeviceController::class, 'sellDevice']);
Route::put('/device/sell/{id}', [DeviceController::class, 'sellDeviceToCustomer']);
