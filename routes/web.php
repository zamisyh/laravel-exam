<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Signin;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Admin\Roles\Role;
use App\Http\Livewire\Admin\Roles\Permission;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\Admin\Src\Jurusan;
use App\Http\Livewire\Admin\Src\Kelas;
use App\Http\Livewire\Admin\Src\Mapel;

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

            Route::group(['middleware' => ['role:admin']], function () {
                Route::get('/role', Role::class)->name('role');
                Route::get('/permission', Permission::class)->name('permission');
                Route::get('/users', Users::class)->name('users');

                Route::prefix('data')->group(function () {
                    Route::get('/', function () {
                        redirect()->route('dashboard.home');
                    });


                    Route::get('majors', Jurusan::class)->name('majors');
                    Route::get('class', Kelas::class)->name('class');
                    Route::get('mapel', Mapel::class)->name('mapel');
                });
            });
        });
    });
});
