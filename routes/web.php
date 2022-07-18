 <?php

  use App\Http\Controllers\DeviceController;
  use App\Http\Controllers\UserController;
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

  Route::get('/', [DeviceController::class, 'index'])->middleware('auth');

  Route::get('/device/create', [DeviceController::class, 'createDevice']);
  Route::post('/device/create', [DeviceController::class, 'saveDevice']);

  Route::get('/device/delete/{id}', [DeviceController::class, 'deleteDevice']);

  Route::get('/device/in', [DeviceController::class, 'listInDevice']);
  Route::get('/device/on-hand-good', [DeviceController::class, 'onHandGood']);
  Route::get('/device/on-hand-bad', [DeviceController::class, 'onHandBad']);
  Route::get('/device/out', [DeviceController::class, 'listOutDevice']);

  Route::get('/device/verify/{id}', [DeviceController::class, 'verifyDevice']);
  Route::put('/device/verify/{id}', [DeviceController::class, 'verifyConditionDevice']);

  Route::get('/device/sell/{id}', [DeviceController::class, 'sellDevice']);
  Route::put('/device/sell/{id}', [DeviceController::class, 'sellDeviceToCustomer']);

  Route::get('/customer', [DeviceController::class, 'customer']);

  Route::get('/user/create', [UserController::class, 'create']);
  Route::post('/user/create', [UserController::class, 'save']);

  Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
  Route::post('/login', [UserController::class, 'auth']);
  Route::post('/logout', [UserController::class, 'logout']);

  Route::get('/user', [UserController::class, 'index']);

  Route::get('/user/delete/{id}', [UserController::class, 'deleteUser']);
