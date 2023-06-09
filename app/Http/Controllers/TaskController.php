<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $allTasks = Task::latest()->paginate(3);
        return view('index', ['allTasks' => $allTasks]);
    }
    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Nueva tarea creada exitosamente');
    }
    public function show(Task $task)
    {
        //
    }
    public function edit(Task $task)
    {
        return view('edit', ['task' => $task]);
    }
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Tarea editada exitosamente');
    }
    public function destroy(Task $task)
    {
       $task->delete(); 
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente');
        
    }
}
