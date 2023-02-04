<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;


use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;

use Illuminate\Http\Request;

use App\Http\Livewire\Mediatama\Userlivewire;
use App\Http\Livewire\Mediatama\DaftarVideo;
use App\Http\Livewire\Mediatama\RequestCustomer;
use App\Http\Livewire\Mediatama\User\DaftarVideoUser;
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

Route::get('/', function() {
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth','admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
   
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
//Mediatama  Admin
    Route::get('/mediatama-user', Userlivewire::class)->name('mediatama-user');
    Route::get('/mediatama-request', RequestCustomer::class)->name('mediatama-request-customer');
    Route::get('/mediatama-daftar-video', DaftarVideo::class)->name('mediatama-daftar-video');
    Route::get('/mediatama-user-daftar-video', DaftarVideoUser::class)->name('mediatama-user-daftar-video');
});

Route::middleware('auth')->group(function () {

//Mediatama Customer
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/mediatama-user-daftar-video', DaftarVideoUser::class)->name('mediatama-user-daftar-video');
});