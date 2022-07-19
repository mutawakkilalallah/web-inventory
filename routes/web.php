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

  Route::get('/device/create', [DeviceController::class, 'createDevice'])->middleware('auth');
  Route::post('/device/create', [DeviceController::class, 'saveDevice']);

  Route::get('/device/delete/{id}', [DeviceController::class, 'deleteDevice'])->middleware('auth');

  Route::get('/device/edit/{id}', [DeviceController::class, 'editDevice'])->middleware('auth');
  Route::put('/device/update/{id}', [DeviceController::class, 'updateDevice']);

  Route::get('/device/in', [DeviceController::class, 'listInDevice'])->middleware('auth');
  Route::get('/device/on-hand-good', [DeviceController::class, 'onHandGood'])->middleware('auth');
  Route::get('/device/on-hand-bad', [DeviceController::class, 'onHandBad'])->middleware('auth');
  Route::get('/device/out', [DeviceController::class, 'listOutDevice'])->middleware('auth');

  Route::get('/device/verify/{id}', [DeviceController::class, 'verifyDevice'])->middleware('auth');
  Route::put('/device/verify/{id}', [DeviceController::class, 'verifyConditionDevice']);

  Route::get('/device/sell/{id}', [DeviceController::class, 'sellDevice'])->middleware('auth');
  Route::put('/device/sell/{id}', [DeviceController::class, 'sellDeviceToCustomer']);

  Route::get('/customer', [DeviceController::class, 'customer'])->middleware('auth');

  Route::get('/user/create', [UserController::class, 'create'])->middleware('auth');
  Route::post('/user/create', [UserController::class, 'save']);

  Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
  Route::post('/login', [UserController::class, 'auth']);
  Route::post('/logout', [UserController::class, 'logout']);

  Route::get('/user', [UserController::class, 'index'])->middleware('auth');

  Route::get('/user/delete/{id}', [UserController::class, 'deleteUser'])->middleware('auth');

  Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth');
  Route::put('/user/update/{id}', [UserController::class, 'update']);
  Route::put('/user/updatePassword/{id}', [UserController::class, 'updatePassword']);
