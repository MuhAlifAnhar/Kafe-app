<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ServiceController;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('frontend.about');
Route::get('/layanan', [ServiceController::class, 'index'])->name('frontend.service');
Route::get('/acara', [EventController::class, 'index'])->name('frontend.event');
Route::get('/menu', [MenuController::class, 'index'])->name('frontend.menu');
Route::get('/hubungi', [ContactController::class, 'index'])->name('frontend.contact');
Route::get('/blog', [BlogController::class, 'index'])->name('frontend.blog');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
