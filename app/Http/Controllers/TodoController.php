<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Services\TodoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    private readonly TodoServiceInterface $todoService;

    public function __construct(TodoServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $todos = Todo::all();

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $this->todoService->createTodo($request->validated());

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo): View
    {
        return view('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $todo = $this->todoService->updateTodo($id, $request->validated());

        return redirect()->route('todos.show', $todo)->with('success', 'Todo updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if ($this->todoService->deleteTodo($id)) {
            return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
        }

        return redirect()->route('todos.index')->with('error', 'Failure deleting todo.');
    }
}
