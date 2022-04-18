<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClimbingRegistrationController;
use App\Http\Controllers\MountainController;
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

Route::get('/', [MountainController::class, 'index']);
Route::get('informasi', function () {
    return view('informasi');
});

//auth routes
Route::get('/login', [AuthController::class, 'loginUser']);
Route::post('/login', [AuthController::class, 'loginUserPost']);
Route::get('/admin/login', [AuthController::class, 'loginAdmin']);
Route::post('/admin/login', [AuthController::class, 'loginAdminPost']);
Route::get('/register', [AuthController::class, 'registerUser']);
Route::post('/register', [AuthController::class, 'registerUserPost']);
Route::get('/logout', [AuthController::class, 'logoutUser']);

//mountain routes
Route::get('/mountains/{id}', [MountainController::class, 'show']);
Route::get('/admin/mountains', [MountainController::class, 'list']);
Route::post('/admin/mountains', [MountainController::class, 'store']);
Route::put('/admin/mountains/{id}', [MountainController::class, 'update']);

//climbing registration routes
Route::get('/admin/climbing_registrations', [ClimbingRegistrationController::class, 'index']);
Route::get('/climbing_registrations/users/{id}', [ClimbingRegistrationController::class, 'showByUserId']);
Route::get('/climbing_registrations/register/{id}', [ClimbingRegistrationController::class, 'climbingRegistration']);
Route::post('/climbing_registrations/register/{id}', [ClimbingRegistrationController::class, 'climbingRegistrationPost']);
Route::get('/climbing_registrations/approve/{id}', [ClimbingRegistrationController::class, 'approve']);
Route::get('/climbing_registrations/decline/{id}', [ClimbingRegistrationController::class, 'decline']);
Route::get('/climbing_registrations/climb/{id}', [ClimbingRegistrationController::class, 'climb']);
Route::get('/climbing_registrations/done/{id}', [ClimbingRegistrationController::class, 'done']);