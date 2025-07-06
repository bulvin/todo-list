<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class TodoShareToken extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'todo_id',
        'token',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function todo() : BelongsTo
    {
        return $this->belongsTo(Todo::class);
    }

    public function scopeByToken($query, string $token) : Builder
    {
        return $query->where('token', $token);
    }

    public function scopeActive($query) : Builder
    {
        return $query->where('expires_at', '>', now());
    }

    public static function generateToken(): string
    {
        return Str::random(64);
    }

    public static function createForTodo(int $todoId, int $hours): self
    {
        return self::create([
            'todo_id' => $todoId,
            'token' => self::generateToken(),
            'expires_at' => now()->addHours($hours),
        ]);
    }

}
