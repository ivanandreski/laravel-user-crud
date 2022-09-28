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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'loginUser']);
    Route::post('register', [AuthController::class, 'createUser']);
    Route::post('logout', [AuthController::class, 'logoutUser'])
        ->middleware('apiauthenticated');
});

Route::middleware(['apiauthenticated'])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('edit-details', [UserController::class, "editDetails"]);
        Route::post('change-password', [UserController::class, "changePassword"]);
        Route::post('delete-profile', [UserController::class, "deleteProfile"]);
    });
});

Route::middleware(['apiauthenticated', 'accessroleapi'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::post('edit-user-role', [AdminController::class, "editUserRole"]);
        Route::post('create-role', [AdminController::class, "createRole"]);
        Route::delete('delete-role', [AdminController::class, "deleteRole"]);
        Route::post('add-user', [AdminController::class, "addUser"]);
        Route::delete('delete-user', [AdminController::class, "deleteUser"]);
    });
});
