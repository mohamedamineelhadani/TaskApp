<?php

use App\Http\Controllers\{
    ProfileController,
    ProjectsController,
    TasksController,
    ContactsController,
    DashboardController,
    };
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('welcome'); });


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/about', function () { return view('about.index'); })->name('about');


    Route::patch('/projects/{project}/status', [ProjectsController::class, 'updateStatus'])->name('projects.updateStatus');
    Route::resource('projects', ProjectsController::class);

    Route::post('/projects/{project}/tasks', [TasksController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}/toggle', [TasksController::class, 'toggleStatus'])->name('tasks.toggle');
    Route::post('/projects/{project}/tasks/complete-all', [TasksController::class, 'completeAll'])->name('tasks.completeAll');
    Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');


    Route::get('/contact', [ContactsController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactsController::class, 'store'])->name('contact.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
