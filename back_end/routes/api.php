<?php

use App\Http\Controllers\JoueurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('joueur')->group(function () {
    Route::get('/', [JoueurController::class, 'index']);
    Route::get('/{id}', [JoueurController::class, 'index']);
    Route::post('/store', [JoueurController::class, 'store']);
    Route::put('/{id}', [JoueurController::class, 'update']);
    Route::delete('/{id}', [JoueurController::class, 'destroy']);
}
);

