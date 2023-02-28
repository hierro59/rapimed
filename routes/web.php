<?php

use App\Mail\SendMail;

use App\Models\LogUser;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ResizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ScoreCustomerController;
use App\Models\UserUploadImages;

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

/* Route::get('/verify', function () {
    return view('auth.verify');
}); */

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class)->middleware('permission:super-admin');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('specialist', SpecialistController::class);
    Route::resource('citas', CitasController::class);
    Route::resource('score', ScoreController::class);
    Route::resource('scorecustomer', ScoreCustomerController::class);
    Route::post('loguser', [LogUser::class, 'store'])->name('loguser');
    Route::get('mails/send', [MailController::class, 'send']);
    Route::get('/file-resize', [ResizeController::class, 'index']);
    Route::post('/resize-file', [ResizeController::class, 'resizeImage'])->name('resizeImage');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
