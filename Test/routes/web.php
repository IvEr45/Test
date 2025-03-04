<?php
use App\Http\Controllers\GreetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});


//This is the first Route
Route::get('/greet', function () {
    return 'Hello, Laravel!';
//THis is the second Route
});
Route::get('/greeting',[GreetController::class, 'greeting']);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
<<<<<<< HEAD
=======


use App\Models\Task;
use Illuminate\Http\Request;

use App\Http\Controllers\TaskController;

// READ - View all tasks
Route::get('/tasks', [TaskController::class, 'index']);

// CREATE - Add a new task
Route::post('/tasks', [TaskController::class, 'store']);

// UPDATE - Edit an existing task
Route::put('/tasks/{id}', [TaskController::class, 'update']);

// DELETE - Remove a task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
>>>>>>> 124f499 (Added Tailwind CSS)
