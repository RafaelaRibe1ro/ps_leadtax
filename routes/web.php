<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AmazonProductController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, 'index']);
Route::get('/scrape-books', [BookController::class, 'scrapeBooks']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/amazon-products', [AmazonProductController::class, 'index']);
Route::post('/store-books', [BookController::class, 'storeBooks']);

