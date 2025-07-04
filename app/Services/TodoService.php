<?php

namespace App\Services;

use App\Models\User;
use App\Models\Todo;

interface TodoServiceInterface
{
    public function createTodo(array $data): Todo;

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
}
