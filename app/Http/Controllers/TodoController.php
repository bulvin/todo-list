<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTodosRequest;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\TodoShareTokenRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\TodoShareToken;
use App\Services\TodoServiceInterface;
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
    public function index(GetTodosRequest $request) : View
    {
        $filters = $request->validated();

        $todos = $this->todoService->getTodos($filters);

        return view('todos.index', compact('todos', 'filters'));
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
    public function update(UpdateTodoRequest $request, Todo $todo)
    {

        $todo = $this->todoService->updateTodo($todo->id, $request->validated());

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

    public function generatePublicLink(TodoShareTokenRequest $request, Todo $todo)
    {
        $validated = $request->validated();

        $link = $this->todoService->generateShareLink($todo->id, $validated['days']);

        return back()->with('success', "Link has been generated: $link (valid till {$validated['days']} days.)");
    }

    public function showPublicTodo(string $token)
    {
        $todo = $this->todoService->getPublicTodoByToken($token);

        return view('todos.show', compact('todo'));
    }
}
