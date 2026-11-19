<?php

use App\Http\Controllers\GiftsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');

Route::get('/hello/{message}', function ($message) {
    return '<h1>Hello ' . $message . '</h1>';
});

//rota de homepage
Route::get('/home', [UtilController::class, 'loadHomepage'])->name('home');

//registrar user
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');
Route::put('/update-user', [UserController::class, 'updateUser'])->name('users.update');

// rotas de users
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');
Route::get('/add-users', [UserController::class, 'addUsers'])->name('users.add');
Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('users.edit')->middleware('auth');
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('users.delete');


//rotas tasks
Route::get('/tasks', [TaskController::class, 'allTasks'])->name('tasks.all');
Route::get('/add-tasks', [TaskController::class, 'createTasks'])->name('tasks.add');
Route::post('/store-tasks', [TaskController::class, 'storeTasks'])->name('tasks.store');
Route::get('/edit-task/{id}', [TaskController::class, 'editTasks'])->name('tasks.edit')->middleware('auth');
Route::get('/delete-task/{id}', [TaskController::class, 'deleteTasks'])->name('tasks.delete');


//rotas prendas de natal
Route::get('/gifts', [GiftsController::class, 'allGifts'])->name('gifts.all');
Route::get('/gifts/edit/{id}', [GiftsController::class, 'editGifts'])->name('gifts.edit');
Route::put('/gifts/update', [GiftsController::class, 'updateGifts'])->name('gifts.update');
Route::get('/gifts/add', [GiftsController::class, 'addGifts'])->name('gifts.add');
Route::post('/gifts/store', [GiftsController::class, 'storeGifts'])->name('gifts.store');
Route::get('/delete-gift/{id}', [GiftsController::class, 'deleteGifts'])->name('gifts.delete');


//rota fallback
Route::fallback([UtilController::class, 'fallback'])->name('utils.fallback');;
