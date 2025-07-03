<?php

namespace App\Models\Todos;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'user_id'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'priority' => TodoPriority::class,
        'status' => ToDoStatus::class,
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

