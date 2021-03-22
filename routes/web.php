<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Signin;
use App\Http\Livewire\Dashboard;

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

Route::name('client.')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('signup', Register::class)->name('signup');
        Route::get('signin', Signin::class)->name('signin');
    });
});


Route::prefix('dashboard')->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/', Dashboard::class)->name('home');
        });
    });
});
