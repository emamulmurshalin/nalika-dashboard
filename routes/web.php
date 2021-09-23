<?php

use App\Http\Controllers\Admin\ManageSilderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('admin.dashboard.dashboard');
//})->name('dashboard');

//Front end route
Route::get('/', function () {
    return view('front.dashboard.dashboard');
})->name('front.dashboard');

//Admin route
Route::get('/dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin.dashboard');
Route::get('/manage-slider', function () {
    return view('admin.slider.manage-slider');
})->name('admin.dashboard');


//Route
Route::resource('slider', ManageSilderController::class);

require __DIR__.'/auth.php';
