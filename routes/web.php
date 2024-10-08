<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\WishlistController;

// HOMEPAGE 
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

// LINGUA
Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');

// ROTTE ARTICOLI
Route::get('/card', [ArticleController::class, 'create'])->name('create')->middleware('auth');
Route::get('/products', [ArticleController::class, 'index'])->name('products');
Route::get('/products/{article}', [ArticleController::class, 'show'])->name('products.show');
Route::delete('/products/{article}', [ArticleController::class, 'destroy'])->name('products.destroy');

// RICERCA ARTICOLI
Route::get('/search/article', [ArticleController::class, 'search'])->name('article.searched');

// PROFILO
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update-image')->middleware('auth');
Route::get('/user/{user}', [ProfileController::class, 'show'])->name('user.profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// REVISORE
Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index')->middleware('isRevisor');
Route::patch('/accept/{article}', [RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}', [RevisorController::class, 'reject'])->name('reject');

// INVIO MAIL
Route::post('/revisor/request', [RevisorController::class, 'becomeRevisor'])->name('become.revisor')->middleware('auth');
Route::get('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');
Route::get('/work/revisor', [RevisorController::class, 'workForm'])->name('work.revisor')->middleware('auth');

// Resubmission
Route::post('/revisor/resubmit/{article}', [RevisorController::class, 'resubmit'])->name('revisor.resubmit');

// WISHLIST
Route::post('/wishlist/{article}', [WishlistController::class, 'toggle'])->name('wishlist.toggle')->middleware('auth');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index')->middleware('auth');

