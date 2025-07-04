<?php

namespace App\Services;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Contracts\Queue\EntityNotFoundException;

interface TodoServiceInterface
{
    public function createTodo(array $data): Todo;
    public function deleteTodo(int $id): bool;
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
}
