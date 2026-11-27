<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\ResumenController;
use App\Http\Controllers\Api\JournalController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

// ---------- Revistas (públicas) ----------
Route::get('/revistas', [JournalController::class, 'index'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/revistas/{journal}', [JournalController::class, 'show'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/revistas/{journal}/secciones', [JournalController::class, 'sections'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/revistas/{journal}/numeros', [JournalController::class, 'issues'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/revistas/{journal}/numeros/{issue}', [JournalController::class, 'issue'])->scopeBindings();

// ---------- Públicas (consulta general, compatibles con versiones anteriores) ----------
Route::get('/issues', [IssueController::class, 'index']);
Route::get('/issues/{issue}', [IssueController::class, 'show']);
Route::get('/sections', [SectionController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'index'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->middleware('cache.headers:public;max_age=60;etag');
Route::get('/resumen', [ResumenController::class, 'index'])->middleware('cache.headers:public;max_age=60;etag');

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

        Route::get('/admin/metricas', [AdminController::class, 'metricas']);
        Route::get('/admin/logs', [AdminController::class, 'logs']);
    });
});
