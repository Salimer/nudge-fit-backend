<?php

namespace App\Enums;

enum HomeStateEnum: string
{
    case setupRequired = 'setup_required';
    case restDay = 'rest_day';
    case actionRequired = 'action_required';
    case completed = 'completed';
    case skipped = 'skipped';
}
