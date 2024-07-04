<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Frontend\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {

        Route::get('register', [AccountController::class, 'register'])->name('account.register');
        Route::post('register', [AccountController::class, 'processRegister'])->name('account.processRegister');
        Route::get('login', [AccountController::class, 'login'])->name('account.login');
        Route::post('login', [AccountController::class, 'authenticate'])->name('account.authenticate');

    });

    Route::group(['middleware' => 'auth'], function () {

        Route::get('profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
        Route::put('update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');

        Route::resource('books', [BookController::class]);

        // Route::get('books', [BookController::class, 'index'])->name('books.index');
        // Route::get('books/create', [BookController::class, 'create'])->name('books.create');
        // Route::post('books', [BookController::class, 'store'])->name('books.store');
        // Route::get('books/show/{id}', [BookController::class, 'show'])->name('books.show');
        // Route::get('books/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        // Route::put('books/update/{id}', [BookController::class, 'update'])->name('books.update');
        // Route::delete('books/delete/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });
});

//Frontend Routes
Route::get('/', [BooksController::class, 'index']);
Route::get('/book/details/{slug}', [BooksController::class, 'show'])->name('single.books');
