<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // READ - Show all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
{
    $task = new Task();
    $task->title = $request->title;
    $task->description = $request->description;
    $task->save();

    return redirect()->to('/tasks')->with('success', 'Task added successfully!');
}

public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $task->title = $request->title;
    $task->description = $request->description;
    $task->save();

    return redirect('/tasks')->with('success', 'Task updated successfully!');
}

public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect('/tasks')->with('success', 'Task deleted successfully!');
}

}
