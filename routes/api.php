<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Para crear las rutas GET, POST, PATCH, DELETE
Route::apiResource('books', BookController::class);
