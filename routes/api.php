<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/logout', [AuthController::class, 'logoutUser'])
    ->middleware('apiauthenticated');

Route::middleware(['apiauthenticated'])->group(function () {
    Route::post('/user/edit-details', [UserController::class, "editDetails"]);
    Route::post('/user/change-password', [UserController::class, "changePassword"]);
    Route::post('/user/delete-profile', [UserController::class, "deleteProfile"]);
});

Route::middleware(['apiauthenticated', 'accessroleapi'])->group(function () {
    Route::post('/admin/edit-user-role', [AdminController::class, "editUserRole"]);
    Route::post('/admin/create-role', [AdminController::class, "createRole"]);
    Route::delete('/admin/delete-role', [AdminController::class, "deleteRole"]);
    Route::post('/admin/add-user', [AdminController::class, "addUser"]);
    Route::delete('/admin/delete-user', [AdminController::class, "deleteUser"]);
});
