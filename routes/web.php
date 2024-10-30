<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
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

Auth::routes();

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');    

    Route::resource('clients', ClientController::class);

    Route::prefix('products')->name('products.')->group(function () {
        
        Route::get('/products', [ProductController::class, 'index'])->name('products');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');        
        Route::post('/sale', [SalesController::class, 'store'])->name('sale');

    });     
    
    Route::prefix('users')->name('users.')->group(function () {      

        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');  

    });  

    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index'); 
        Route::post('/finalize', [SalesController::class, 'finalizeSale'])->name('finalize');
        Route::get('/{id}/edit', [SalesController::class, 'edit'])->name('edit'); 
        Route::put('/{id}', [SalesController::class, 'update'])->name('update');
        Route::delete('/{id}', [SalesController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/download', [SalesController::class, 'download'])->name('download');
    });

   
});


