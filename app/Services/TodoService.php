<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\TodoShareToken;
use Illuminate\Support\Collection;

interface TodoServiceInterface
{
    public function createTodo(array $data): Todo;
    public function deleteTodo(int $id): bool;
    public function updateTodo(int $id, array $data);

    public function generateShareLink(int $id, int $days): string;

    public function getPublicTodoByToken(string $token): Todo;

}

class TodoService implements TodoServiceInterface
{
    public function createTodo(array $data): Todo
    {
        return Todo::create([
            ...$data,
            'user_id' => auth()->id(),
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
        $userId = auth()->id();
        return Todo::forUser($userId)
            ->select(['id', 'name', 'priority', 'status', 'due_date'])
            ->withFilters($filters)
            ->latest()
            ->get()
            ->groupBy('status');
    }

    public function generateShareLink(int $id, int $days): string
    {
        $hours = $days * 24;
        $token = TodoShareToken::createForTodo($id, $hours);

        return route('todos.public.show', ['token' => $token->token]);
    }

    public function getPublicTodoByToken(string $token): Todo
    {
        $shareToken = TodoShareToken::byToken($token)
            ->active()
            ->firstOrFail();

        return $shareToken->todo;
    }
}
