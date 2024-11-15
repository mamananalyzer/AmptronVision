<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BelanjaController;
use App\Http\Controllers\CRMController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\HSEController;
use App\Http\Controllers\HSE_HazopsController;
use App\Http\Controllers\LabsController;
use App\Http\Controllers\Labs_LabelController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\QuickpinController;
use App\Http\Controllers\Quickpin_LabelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/base');
// Route::get('/base', function () {
//     return view('base.index');
// });
// Route::get('/users', function () {
//     return view('base.users');
// });


Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/account', [AccountController::class, 'index'])->name('Account.index');;
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/belanja', [BelanjaController::class, 'index'])->name('Belanja.index');;
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/CRM', [CRMController::class, 'index']);
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/daily', [DailyController::class, 'index'])->name('daily.index');
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/HSE', [HSEController::class, 'index'])->name('HSE.index');
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/HSE_Hazops', [HSE_HazopsController::class, 'index'])->name('HSE_Hazops.index');
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/Labs', [LabsController::class, 'index']);
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/Labs_Label', [LabsController::class, 'index']);
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/monitoring', [MonitoringController::class, 'index']);
});
Route::group(['middleware' => ['checkRole:1,14']], function() {
    Route::get('/motor', [MotorController::class, 'index']);
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
});
Route::group(['middleware' => ['checkRole:1,2,3,4,5,6,7,8,9,10,11,12,13']], function() {
    Route::get('/quickpin', [QuickpinController::class, 'index'])->name('quickpin.index');
    
});
Route::group(['middleware' => ['checkRole:1']], function() {
    Route::get('/Quickpin_Label', [QuickpinController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/base', function () {
        return view('base.index');
    });

    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

    // Route::get('/belanja', [BelanjaController::class, 'index'])->name('Belanja.index');;
    Route::get('/belanja/data', [BelanjaController::class, 'getData'])->name('Belanja.data');
    Route::get('/belanja/{id_user}/show', [BelanjaController::class, 'show'])->name('Belanja.show');
    Route::post('/belanja.store', [BelanjaController::class, 'store'])->name('Belanja.create');
    Route::get('/belanja/{id_user}/edit', [BelanjaController::class, 'edit'])->name('Belanja.edit');
    Route::delete('/belanja/{id_user}', [BelanjaController::class, 'destroy'])->name('Belanja.destroy');
    Route::get('/belanja/{id_user}/suspend', [BelanjaController::class, 'suspend'])->name('Belanja.suspend');

    // Route::get('/CRM', [CRMController::class, 'index']);
    Route::get('CRM/data', [CRMController::class, 'getData'])->name('CRM.data');
    Route::get('/CRM/{id_user}/show', [CRMController::class, 'show'])->name('CRM.show');
    Route::post('/CRM.store', [CRMController::class, 'store'])->name('CRM.create');
    Route::post('/quot.store', [CRMController::class, 'quot_store'])->name('quot.create');
    Route::get('/CRM/{id_user}/edit', [CRMController::class, 'edit'])->name('CRM.edit');
    Route::delete('/CRM/{id_user}', [CRMController::class, 'destroy'])->name('CRM.destroy');
    Route::get('/CRM/{id_user}/suspend', [CRMController::class, 'suspend'])->name('CRM.suspend');

    // Route::get('/Labs', [LabsController::class, 'index']);
    Route::get('Labs/data', [LabsController::class, 'getData'])->name('Labs.data');
    Route::get('/Labs/{id_user}/show', [LabsController::class, 'show'])->name('Labs.show');
    Route::post('/Labs.store', [LabsController::class, 'store'])->name('Labs.create');
    Route::post('/quot.store', [LabsController::class, 'quot_store'])->name('quot.create');
    Route::get('/Labs/{id_user}/edit', [LabsController::class, 'edit'])->name('Labs.edit');
    Route::delete('/Labs/{id_user}', [LabsController::class, 'destroy'])->name('Labs.destroy');
    Route::get('/Labs/{id_user}/suspend', [LabsController::class, 'suspend'])->name('Labs.suspend');

    // Route::get('/Labs_Label', [Labs_LabelController::class, 'index']);
    Route::get('Labs_Label/data', [Labs_LabelController::class, 'getData'])->name('Labs_Label.data');
    Route::get('/Labs_Label/{id_user}/show', [Labs_LabelController::class, 'show'])->name('Labs_Label.show');
    Route::post('/Labs_Label.store', [Labs_LabelController::class, 'store'])->name('Labs_Label.create');
    Route::get('/Labs_Label/{id_user}/edit', [Labs_LabelController::class, 'edit'])->name('Labs_Label.edit');
    Route::delete('/Labs_Label/{id_user}', [Labs_LabelController::class, 'destroy'])->name('Labs_Label.destroy');
    Route::get('/Labs_Label/{id_user}/suspend', [Labs_LabelController::class, 'suspend'])->name('Labs_Label.suspend');

    // Route::get('/CRM', [CRMController::class, 'index']);
    // Route::get('customers/data', [CRMController::class, 'getData'])->name('customers.data');
    Route::get('/customers/{id_user}/show', [CRMController::class, 'show'])->name('customers.show');
    // Route::post('/customers.store', [CRMController::class, 'store'])->name('customers.create');
    // Route::post('/quot.store', [CRMController::class, 'quot_store'])->name('quot.create');
    Route::get('/customers/{id_user}/edit', [CRMController::class, 'edit'])->name('customers.edit');
    Route::delete('/customers/{id_user}', [CRMController::class, 'destroy'])->name('customers.destroy');
    // Route::get('/customers/{id_user}/suspend', [CRMController::class, 'suspend'])->name('customers.suspend');
    
    // Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::get('/monitoring/{id_user}/show', [MonitoringController::class, 'show'])->name('Monitoring.show');
    Route::post('/monitoring.store', [MonitoringController::class, 'store'])->name('Monitoring.create');
    Route::get('/monitoring/{id_user}/edit', [MonitoringController::class, 'edit'])->name('Monitoring.edit');
    Route::delete('/monitoring/{id_user}', [MonitoringController::class, 'destroy'])->name('Monitoring.destroy');
    Route::get('/monitoring/{id_user}/suspend', [MonitoringController::class, 'suspend'])->name('Monitoring.suspend');

    // Route::get('/motor', [MotorController::class, 'index']);
    Route::get('/motor/data', [MotorController::class, 'getData'])->name('Motor.data');
    Route::get('/motor/{id_user}/show', [MotorController::class, 'show'])->name('Motor.show');
    Route::post('/motor.store', [MotorController::class, 'store'])->name('Motor.create');
    Route::get('/motor/{id_user}/edit', [MotorController::class, 'edit'])->name('Motor.edit');
    Route::delete('/motor/{id_user}', [MotorController::class, 'destroy'])->name('Motor.destroy');
    Route::get('/motor/{id_user}/suspend', [MotorController::class, 'suspend'])->name('Motor.suspend');

    // Route::get('/daily', [DailyController::class, 'index']);
    Route::get('/daily/{id_user}/show', [DailyController::class, 'show'])->name('Daily.show');
    Route::post('/daily.store', [DailyController::class, 'store'])->name('Daily.create');
    // Route::post('/quot.store', [DailyController::class, 'quot_store'])->name('quot.create');
    Route::get('/daily/{id_user}/edit', [DailyController::class, 'edit'])->name('Daily.edit');
    Route::delete('/daily/{id_user}', [DailyController::class, 'destroy'])->name('Daily.destroy');
    Route::get('/daily/{id_user}/suspend', [DailyController::class, 'suspend'])->name('Daily.suspend');

    // Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{id_user}/show', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product.store', [ProductController::class, 'store'])->name('product.create');
    Route::get('/product/{id_user}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/{id_user}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/{id_user}/suspend', [ProductController::class, 'suspend'])->name('product.suspend');

    // Route::get('/HSE_Hazops', [HSE_HazopsController::class, 'index']);
    Route::get('/HSE_Hazops/data', [HSE_HazopsController::class, 'getData'])->name('HSE_Hazops.data');
    Route::get('/HSE_Hazops/{id_hse}/show', [HSE_HazopsController::class, 'show'])->name('HSE_Hazops.show');
    Route::post('/HSE_Hazops.store', [HSE_HazopsController::class, 'store'])->name('HSE_Hazops.create');
    Route::get('/HSE_Hazops/{id_hse}/edit', [HSE_HazopsController::class, 'edit'])->name('HSE_Hazops.edit');
    Route::delete('/HSE_Hazops/{id_hse}', [HSE_HazopsController::class, 'destroy'])->name('HSE_Hazops.destroy');
    Route::get('/HSE_Hazops/{id_hse}/suspend', [HSE_HazopsController::class, 'suspend'])->name('HSE_Hazops.suspend');

    // Route::get('/quickpin', [QuickpinController::class, 'index']);
    Route::get('/quickpin/data', [QuickpinController::class, 'getData'])->name('quickpin.data');
    Route::get('/quickpin/{id_user}/show', [QuickpinController::class, 'show'])->name('quickpin.show');
    Route::post('/quickpin.store', [QuickpinController::class, 'store'])->name('quickpin.create');
    Route::get('/quickpin/{id_user}/edit', [QuickpinController::class, 'edit'])->name('quickpin.edit');
    Route::delete('/quickpin/{id_user}', [QuickpinController::class, 'destroy'])->name('quickpin.destroy');
    Route::get('/quickpin/{id_user}/suspend', [QuickpinController::class, 'suspend'])->name('quickpin.suspend');

    // Route::get('/Quickpin_Label', [Quickpin_LabelController::class, 'index']);
    Route::get('/Quickpin_Label/data', [Quickpin_LabelController::class, 'getData'])->name('Quickpin_Label.data');
    Route::get('/Quickpin_Label/{id_user}/show', [Quickpin_LabelController::class, 'show'])->name('Quickpin_Label.show');
    Route::post('/Quickpin_Label.store', [Quickpin_LabelController::class, 'store'])->name('Quickpin_Label.create');
    Route::get('/Quickpin_Label/{id_user}/edit', [Quickpin_LabelController::class, 'edit'])->name('Quickpin_Label.edit');
    Route::delete('/Quickpin_Label/{id_user}', [Quickpin_LabelController::class, 'destroy'])->name('Quickpin_Label.destroy');
    Route::get('/Quickpin_Label/{id_user}/suspend', [Quickpin_LabelController::class, 'suspend'])->name('Quickpin_Label.suspend');
});


// Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/data', [UsersController::class, 'getData'])->name('users.data');
Route::get('/users/{id_user}', [UsersController::class, 'show'])->name('users.show');
Route::post('/users.store', [UsersController::class, 'store'])->name('users.create');
Route::post('/roles.store', [UsersController::class, 'storeRole'])->name('roles.create');
Route::get('/users/{id_user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::delete('/users/{id_user}', [UsersController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id_user}/suspend', [UsersController::class, 'suspend'])->name('users.suspend');








