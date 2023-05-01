<?php

use App\Models\LogUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ResizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ScoreCustomerController;
use App\Http\Controllers\PerfilPublicController;
use App\Http\Controllers\DoctorsPublicController;
use App\Http\Controllers\WelcomePublicController;
use App\Http\Controllers\ControlCitasController;

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

//Auth::routes();
Auth::routes(['verify' => true]);


Route::post('send', [MailController::class, 'send'])->name('send');
Route::get('/perfil/{id}', PerfilPublicController::class)->name('perfil');
Route::get('/doctors', DoctorsPublicController::class)->name('doctors');
Route::get('/', WelcomePublicController::class)->name('welcome');
//Route::get('/welcome', WelcomePublicController::class)->name('welcome');

//Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('roles', RoleController::class)->middleware('permission:super-admin');
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('specialist', SpecialistController::class);
    Route::resource('citas', CitasController::class);
    Route::resource('score', ScoreController::class);
    Route::resource('scorecustomer', ScoreCustomerController::class);
    Route::post('loguser', [LogUser::class, 'store'])->name('loguser');
    Route::get('/file-resize', [ResizeController::class, 'index']);
    Route::post('/resize-file', [ResizeController::class, 'resizeImage'])->name('resizeImage');
    Route::get('specialistdata', [UserController::class, 'specialist'])->name('specialistdata');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/citas/consultorio-virtual/{id}', [ControlCitasController::class, 'DetalleCita'])->name('consultorio-virtual');
});


