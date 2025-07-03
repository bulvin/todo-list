<?php

namespace App\Models\Todos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'user_id'
    ];

    protected $casts = [
        'due_date' => 'date',
        'priority' => TodoPriority::class,
        'status' => TodoStatus::class,
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

