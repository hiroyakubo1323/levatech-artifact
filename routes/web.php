<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecruiteController;
use App\Http\Controllers\UserController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/index', [RecommendationController::class, 'index'])->name('recommendation.index');
    Route::get('/recommendation/{recommendation}', [RecommendationController::class,'show']);
    Route::get('/recruite/index', [RecruiteController::class, 'index'])->name('recruite.index');
    Route::get('/recruite/show/{recruite_id}', [RecommendationController::class, 'show_answer'])->name('recruite.show');
    Route::post('/recommendation/emotion', [RecommendationController::class, 'emotion'])->name('recommendation.emotion');
    Route::get('/authuser/recommendation', [RecommendationController::class, 'auth_user'])->name('recommendation.authuser');
    Route::get('/user/recruite', [RecruiteController::class, 'eachUser'])->name('recruite.user');
    Route::get('/book/recommendation/{book_id}', [RecommendationController::class, 'each_book'])->name('recommendation.book');
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
