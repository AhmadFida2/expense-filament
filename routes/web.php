<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::redirect('/','/dashboard')->name('login');

Route::get('/setup', function () {
    Artisan::call('db:wipe --force');
    Artisan::call('migrate:fresh --force');
    Artisan::call('db:seed --force');
    Artisan::call('config:cache');
    return redirect('/');
});
