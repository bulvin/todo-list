<?php

namespace App\Enums;

enum TodoDueDateFilter : string
{
    case Overdue = 'overdue';
    case Today = 'today';
    case Week = 'week';
    case Month = 'month';

    public function label() : string {
        return match ($this) {
            self::Overdue => 'Overdue',
            self::Today => 'Today',
            self::Week => 'This Week',
            self::Month => 'This Month',
        };
    }
}
