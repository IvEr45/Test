<?php
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\GreetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;



Route::get('/', function () {
    return view('welcome');
});


//This is the first Route
Route::get('/greet', function () {
    return 'Hello, Laravel!';
//THis is the second Route
});
Route::get('/greeting',[GreetController::class, 'greeting']);




// READ - View all tasks
Route::get('/tasks', [TaskController::class, 'index']);

// CREATE - Add a new task
Route::post('/tasks', [TaskController::class, 'store']);

// UPDATE - Edit an existing task
Route::put('/tasks/{id}', [TaskController::class, 'update']);

// DELETE - Remove a task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

