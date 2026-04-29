<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


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



// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Forgot & Reset Password
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.reset');

// Email verification
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->name('verification.verify');

// ============================================================
// PROTECTED ROUTES (Authentication required)
// ============================================================
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Email verification
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])
        ->name('verification.send');
    Route::get('/email/check-verification', [AuthController::class, 'checkVerification']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::patch('projects/{project}/status', [ProjectController::class, 'updateStatus'])
        ->name('projects.updateStatus');
    Route::apiResource('projects', ProjectController::class);


    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');
    Route::post('/projects/{project}/complete-all', [TaskController::class, 'completeAll'])->name('tasks.completeAll');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



});
