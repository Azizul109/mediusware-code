<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::view('/register', 'register');

Route::view('/login', 'login');

// Route to create a new user
Route::post('/register', [UserController::class, 'createUser']);

// Route to log in user
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', [TransactionController::class, 'showAllTransactions']);
Route::get('/show-deposit', [TransactionController::class, 'showDeposits']);
Route::view('/deposit', 'deposit');
Route::post('/deposit', [TransactionController::class, 'deposit']);

Route::get('/show-withdrawal', [TransactionController::class, 'showWithdrawals']);
Route::view('/withdraw', 'withdraw');
Route::post('/withdraw', [TransactionController::class, 'withdraw']);
