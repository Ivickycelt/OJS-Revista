<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// ---------- Públicas (cualquiera puede leer la revista) ----------
Route::get('/issues', [IssueController::class, 'index']);
Route::get('/issues/{issue}', [IssueController::class, 'show']);
Route::get('/sections', [SectionController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show']);

// ---------- Registro e inicio de sesión (máximo 6 intentos por minuto) ----------
Route::middleware('throttle:6,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// ---------- Usuarios con sesión iniciada (token de Sanctum) ----------
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites/{article}', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{article}', [FavoriteController::class, 'destroy']);

    // ---------- Solo administradores ----------
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::post('/articles', [ArticleController::class, 'store']);
        Route::put('/articles/{article}', [ArticleController::class, 'update']);
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy']);
    });
});
