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
use App\Http\Livewire\Admin\Src\Guru;
use App\Http\Livewire\Admin\Src\Siswa as Student;
use App\Http\Livewire\Settings\Profile;
use App\Http\Livewire\Settings\ChangeUser;
use App\Http\Livewire\Admin\Guru\BankSoal;

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
                Route::get('/permission', function () {
                    return response()->json([
                        'response' => [
                            'status' => '401',
                            'message' => 'The developer has disabled this page'
                        ]
                    ], 401);
                })->name('permission');
                Route::get('/users', Users::class)->name('users');

                Route::prefix('data')->group(function () {
                    Route::get('/', function () {
                        redirect()->route('dashboard.home');
                    });


                    Route::get('majors', Jurusan::class)->name('majors');
                    Route::get('class', Kelas::class)->name('class');
                    Route::get('mapel', Mapel::class)->name('mapel');
                    Route::get('teacher', Guru::class)->name('teacher');
                    Route::get('student', Student::class)->name('student');
                });
            });

            //Page for manajemen profile

            Route::group(['middleware' => ['role:siswa|guru']], function () {
                Route::get('profile', Profile::class)->name('profile');
            });

            Route::get('profile/setting', ChangeUser::class)->name('setting');

            Route::group(['middleware' => ['role:guru']], function () {
                Route::get('bank_soal', BankSoal::class)->name('bank_soal');
                Route::prefix('create')->group(function () {
                    Route::get('bank_soal', BankSoal::class)->name('create.bank_soal');
                });
            });
        });
    });
});
