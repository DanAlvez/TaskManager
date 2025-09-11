<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->orderBy('status')->orderBy('priority')->orderBy('title')->paginate(5);
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = auth()->user()->categories()->get();
        return view('tasks.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = [
            'title' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ];
        Task::create($task);
        return redirect()->route('tasks.index')->with('notification', [
            'type' => 'success',
            'message' => 'Tarefa criada com sucesso!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $categories = auth()->user()->categories()->get();
        return view('tasks.edit', [
            'task' => $task,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $taskUpdate = [
            'title' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ];
        $task->update($taskUpdate);
        return redirect()->route('tasks.index')->with('notification', [
            'type' => 'success',
            'message' => 'Tarefa atualizada com sucesso!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index')->with('notification', [
            'type' => 'error',
            'message' => 'Tarefa deletada com sucesso!'
        ]);
    }
}
