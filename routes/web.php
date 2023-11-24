<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameDenomController;
use Illuminate\Support\Facades\Route;
require __DIR__ . '/auth.php';

//profile controller
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//User
Route::group(['middleware' => ['auth', 'isUser']], function () {
    Route::get('/', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
});

//Admin
Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {

    //manage user
    Route::get('/user', [UserController::class, 'getUserList']);    //->name('user.list');
    Route::get('/edit-user/{id}', [UserController::class, 'editUser']); //->name('user.edit');
    Route::patch('/edit-user/{id}', [UserController::class, 'updateUser']); //->name('user.update');
    Route::patch('/photo-user/{id}', [UserController::class, 'photoUpload']);   //->name('picture.update');
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']); //->name('user.delete');

    //manage game
    Route::post('/games/add', [GameController::class, 'addGame'])->name('game.add');    // Add a new game
    Route::get('/games', [GameController::class, 'getGameList'])->name('game.list');    // Get the list of games
    Route::put('/games/{id}/update', [GameController::class, 'updateGame'])->name('game.update');   // Update a game
    Route::delete('/games/{id}/delete', [GameController::class, 'deleteGame'])->name('game.delete');    // Delete a game

    //manage game denoms
    Route::post('/game-denoms', [GameDenomController::class, 'addDenom']);  // Add new denom
    Route::get('/game-denoms', [GameDenomController::class, 'getDenomList']);    // Get denom list
    Route::put('/game-denoms/{id}', [GameDenomController::class, 'updateGameDenom']);    // Update game denom
    Route::delete('/game-denoms/{id}', [GameDenomController::class, 'deleteGameDenom']);    // Delete game denom
});

Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');
Route::get('/', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [GameController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');