<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RawMaterialController;
use App\Http\Controllers\Backend\IncomingRawMaterialController;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/layanan', [ServiceController::class, 'index'])->name('frontend.service');
Route::get('/acara', [EventController::class, 'index'])->name('frontend.event');
Route::get('/menu', [MenuController::class, 'index'])->name('frontend.menu');
Route::get('/hubungi', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/blog', [BlogController::class, 'index'])->name('frontend.blog');

Route::prefix('panel')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('panel.dashboard.index');

    Route::resource('raw-material', RawMaterialController::class)
    ->names('panel.raw-material');

    Route::resource('incoming-raw-material', IncomingRawMaterialController::class)
    ->names('panel.incoming-raw-material');

    Route::resource('product', ProductController::class)
        ->names('panel.product');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
