<?php

use App\Http\Controllers\AuthController;
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
    return view('index');
});


Route::get('/admin-dash', [AuthController::class, 'dashboard'])->middleware('IsAdminLoggedin');
Route::get('/user-dash', [AuthController::class, 'userDashboard'])->middleware('isUserLoggedin');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/user-register', [AuthController::class, 'userRegister'])->name('user.register');
Route::post('/user-login', [AuthController::class, 'userLogin'])->name('user.login');