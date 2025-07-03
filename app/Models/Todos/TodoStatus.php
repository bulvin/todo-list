<?php

namespace App\Models\Todos;

enum TodoStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';

    public function label(): string
    {
        return match ($this) {
            self::TODO => 'To Do',
            self::IN_PROGRESS => 'In Progress',
            self::DONE => 'Done',
        };
    }

    public function next(): self
    {
        return match ($this) {
            self::TODO => self::IN_PROGRESS,
            self::IN_PROGRESS => self::DONE,
            self::DONE => self::TODO,
        };
    }
}
