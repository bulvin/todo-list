<?php

namespace App\Models\Todos;

use App\Models\User;
use Carbon\Carbon;
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
        'due_date' => 'datetime',
        'priority' => TodoPriority::class,
        'status' => TodoStatus::class,
    ];

    protected static function booted(): void
    {
        static::saving(function ($todo) {
            $todo->due_date = Carbon::parse($todo->due_date)->setSeconds(0);
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

