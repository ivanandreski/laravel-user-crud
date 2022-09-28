<?php

use App\Http\Livewire\Admin\Admin;
use App\Http\Livewire\RedirectHome;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Profile\Profile;
use App\Http\Livewire\Welcome;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;

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

Route::get('/home', RedirectHome::class);
Route::get('/', Welcome::class);
Route::get('/login', Login::class);
Route::get('/register', Register::class);
Route::get('/profile', Profile::class);

Route::group(['middleware' => [
    'accessrole',
]], function () {
    Route::get('/admin', Admin::class);
});

