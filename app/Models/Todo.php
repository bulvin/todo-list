<?php

namespace App\Models;

use App\Enums\TodoPriority;
use App\Enums\TodoStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
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

    public function shareTokens() : HasMany
    {
        return $this->hasMany(TodoShareToken::class);
    }

    public function scopeByPriority(Builder $query, TodoPriority $priority): Builder
    {
        return $query->where('priority', $priority);
    }

    public function scopeByStatus(Builder $query, TodoStatus $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeDueBetween(Builder $query, Carbon $from, Carbon $to): Builder
    {
        return $query->whereBetween('due_date', [$from, $to]);
    }

    public function scopeDueBefore(Builder $query, Carbon $date): Builder
    {
        return $query->where('due_date', '<', $date);
    }

    public function scopeDueAfter(Builder $query, Carbon $date): Builder
    {
        return $query->where('due_date', '>', $date);
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('due_date', '<', now()->startOfDay())
            ->where('status', '!=', TodoStatus::DONE);
    }

    public function scopeWithFilters(Builder $query, array $filters): Builder
    {
        if (!empty($filters['status'])) {
            $query->byStatus(TodoStatus::from($filters['status']));
        }

        if (!empty($filters['priority'])) {
            $query->byPriority(TodoPriority::from($filters['priority']));
        }

        if (!empty($filters['due_date'])) {
            match ($filters['due_date']) {
                'overdue' => $query->overdue(),
                'today' => $query->dueBetween(
                    now()->startOfDay(),
                    now()->endOfDay()
                ),
                'week' => $query->dueBetween(
                    now()->startOfDay(),
                    now()->addWeek()->endOfDay()
                ),
                'month' => $query->dueBetween(
                    now()->startOfDay(),
                    now()->addMonth()->endOfDay()
                ),
                default => null,
            };
        }

        return $query;
    }
}

