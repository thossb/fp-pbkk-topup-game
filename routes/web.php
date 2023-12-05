<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameDenomController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

//profile controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile-inbox', [ProfileController::class, 'inbox'])->name('profile.inbox');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User
Route::group(['middleware' => ['auth', 'isUser']], function () {
    Route::get('/', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
    Route::post('/transaction/add', [TransactionController::class, 'createTransaction'])->name('transaction.add');
});

//Admin
Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {
    //admin panel
    Route::get('/', [TransactionController::class, 'getView'])->name('admin');

    //manage transactions
    Route::get('/get-transactions', [TransactionController::class, 'getTransactionsData'])->name('admin.get-transactions');
    Route::patch('/transactions/update/{id}', [TransactionController::class, 'updateTransaction'])->name('admin.update');
    Route::patch('/transactions/reject/{id}', [TransactionController::class, 'rejectTransaction'])->name('admin.reject');



    //manage user
    Route::get('/user', [UserController::class, 'getUserList'])->name('user.list'); //have non crud filtered search
    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::patch('/edit-user/{id}', [UserController::class, 'updateUser'])->name('user.update');
    Route::patch('/photo-user/{id}', [UserController::class, 'photoUpload'])->name('picture.update');
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

    //manage game
    Route::post('/games/add', [GameController::class, 'addGame'])->name('game.add');
    Route::get('/games', [GameController::class, 'getGameList'])->name('game.list'); // Get the list of games //have non crud filtered search
    Route::put('/games/{id}/update', [GameController::class, 'updateGame'])->name('game.update');
    Route::delete('/games/{id}/delete', [GameController::class, 'deleteGame'])->name('game.delete');

    //manage game denoms
    Route::post('/game-denoms', [GameDenomController::class, 'addDenom']);
    Route::get('/game-denoms', [GameDenomController::class, 'getDenomList']);
    Route::put('/game-denoms/{id}', [GameDenomController::class, 'updateGameDenom']);
    Route::delete('/game-denoms/{id}', [GameDenomController::class, 'deleteGameDenom']);
});

Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('/', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/history', [TransactionController::class, 'getMyTransactions'])->middleware(['auth', 'verified'])->name('history');
