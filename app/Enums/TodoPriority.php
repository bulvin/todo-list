<?php

namespace App\Enums;

enum TodoPriority: string
{
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }

    public function color(): string {
        return match ($this) {
            self::LOW => 'bg-blue-200 text-blue-800',
            self::MEDIUM => 'bg-yellow-200 text-yellow-800',
            self::HIGH => 'bg-red-200 text-red-800',
        };
    }
}
