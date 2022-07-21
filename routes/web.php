<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProvisionAbout;
use App\Http\Controllers\ProvisionDashboard;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;

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

// to home page
Route::get('/', [DeviceController::class, 'index'])->name('device.index');

// To all devices page
Route::get('/device', [DeviceController::class, 'index'])->name('device.index'); //user

Route::middleware(['auth'])->group(function () {
    // To my devices page
    Route::get('/device/my-devices', [DeviceController::class, 'myDevices'])->name('device.my-devices');
    // To return or cancel device
    Route::put('/device/{device}/refund', [DeviceController::class, 'refund'])->name('device.refund');
    // To hire device
    Route::put('/device/{device}/hire', [DeviceController::class, 'hire'])->name('device.hire');
    // To tracking history
    Route::get('/device/history', [DeviceController::class, 'history'])->name('device.history');

    Route::resource('/users', UserController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // To pending devices page
    Route::get('/all-devices', [DeviceController::class, 'showAll'])->name('device.all-devices');
    // To pending devices page
    Route::get('/device/pending', [DeviceController::class, 'pending'])->name('device.pending');
    // To pending devices page
    Route::get('/device/tracking', [DeviceController::class, 'tracking'])->name('device.tracking');
    // To create device page
    Route::get('/device/create', [DeviceController::class, 'create'])->name('device.create');
    // To approve pending device
    Route::put('/device/{device}/approve', [DeviceController::class, 'approve'])->name('device.approve');
    // To edit device
    Route::get('/device/{device}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    // To update device
    Route::put('/device/{device}', [DeviceController::class, 'update'])->name('device.update');
    // To delete device
    Route::delete('/device/{device}', [DeviceController::class, 'destroy'])->name('device.destroy');
    // To store device
    Route::post('/device', [DeviceController::class, 'store'])->name('device.store');

    Route::resource('/types', TypeController::class);
});

// To single device page
Route::get('/device/{device:slug}', [DeviceController::class, 'show'])->name('device.show');
// To dashboard
Route::get('/dashboard', ProvisionDashboard::class)->middleware(['auth', 'role:admin,user'])->name('dashboard');
// To about page
Route::get('/about', ProvisionAbout::class)->name('about');
// To contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// To send mail
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Go to facebook
Route::get('/login/facebook', [SocialLoginController::class, 'goFacebook'])->name('login.facebook');
// Facebook callback processing
Route::get('/login/facebook/callback', [SocialLoginController::class, 'facebookCallback']);
// Switch language
Route::get('lang', [LanguageController::class, 'index'])->name('lang.index');

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

require __DIR__.'/auth.php';
