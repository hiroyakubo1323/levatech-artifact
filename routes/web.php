<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecruiteController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/recommendations/create', [BookController::class, 'create'])->name('recommendations.create');
    Route::get('/recommendations/answer/{recruite_id}', [BookController::class, 'create_answer']);    
    Route::post('/searchbook', [BookController::class, 'search'])->name('search');
    Route::post('/searchbook/{recruite_id}', [BookController::class, 'search_answer']);
    Route::get('/recommendations/create/{googlebook_id}', [RecommendationController::class, 'create'])->name('recommendations.input');
    Route::get('/recommendations/answer/{googlebook_id}/{recruite_id}', [RecommendationController::class, 'answer_create']);
    Route::post('/recommendations/store/{googlebook_id}/{user_id}', [RecommendationController::class, 'store'])->name('recommendation.store');
    Route::post('/recommendations/store/{googlebook_id}/{user_id}/{recruite_id}', [RecommendationController::class, 'answer_store']);
    Route::get('/recruites/create', [RecruiteController::class, 'create'])->name('recruite.create');
    Route::post('/recruites/store/{user_id}', [RecruiteController::class, 'store'])->name('recruite.store');
});



require __DIR__.'/auth.php';
