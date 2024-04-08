<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthenticatedController::class, "store"])->name("auth.store");

Route::middleware("auth:sanctum")->group(function() {

    Route::get('/teste', function() {
        return response()->json(["message" => "entrei"], 200);
    });

    Route::get('/book', [BookController::class, 'all'])->name('book.all');
    Route::get('/book/{id}', [BookController::class, 'get'])->name('book.get');
    Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
    Route::post('/book', [BookController::class, 'store'])->name('book.store');
    Route::delete('/book/{id}', [BookController::class, 'delete'])->name('book.delete');

    Route::get('/store', [StoreController::class, 'all'])->name('store.all');
    Route::get('/store/{id}', [StoreController::class, 'get'])->name('store.get');
    Route::put('/store/{id}', [StoreController::class, 'update'])->name('store.update');
    Route::post('/store', [StoreController::class, 'store'])->name('store.store');
    Route::delete('/store/{id}', [StoreController::class, 'delete'])->name('store.delete');

    Route::get('/logout', [AuthenticatedController::class, "destroy"])->name("auth.destroy");
});
