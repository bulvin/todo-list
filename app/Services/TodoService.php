<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Support\Collection;

interface TodoServiceInterface
{
    public function createTodo(array $data): Todo;
    public function deleteTodo(int $id): bool;
    public function updateTodo(int $id, array $data);

    public function getTodos(array $filters = []): Collection;
}

class TodoService implements TodoServiceInterface
{
    public function createTodo(array $data): Todo
    {
        return Todo::create([
            ...$data,
            'user_id' => 1,
        ]);
    }

    public function deleteTodo(int $id): bool
    {
        return Todo::where('id', $id)->delete() > 0;
    }

    public function updateTodo(int $id, array $data) : Todo
    {
        $todo = Todo::findOrFail($id);
        $todo->update($data);

        return $todo;
    }

    public function getTodos(array $filters = []): Collection
    {
        $userId = 1;
        return Todo::forUser($userId)
            ->select(['id', 'name', 'priority', 'status', 'due_date'])
            ->withFilters($filters)
            ->latest()
            ->get()
            ->groupBy('status');
    }
}
