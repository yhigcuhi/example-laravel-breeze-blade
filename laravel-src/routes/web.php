<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ダッシュボードユーザー系 (Breezeそのまま)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // シーズン 試合系
    Route::group(['prefix' => '/game', 'as' => 'game.'], function() {
        Route::get('/', [GameController::class, 'index'])->name('index'); // 試合一覧 画面
        Route::get('/new', [GameController::class, 'create'])->name('create'); // 試合追加 画面
        Route::post('/', [GameController::class, 'search'])->name('search'); // 試合一覧 画面: 検索
        Route::post('/new', [GameController::class, 'store'])->name('store'); // 試合追加 通信
    });
});

require __DIR__.'/auth.php';
