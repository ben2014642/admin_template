<?php

namespace App\Enums\Employee;

use App\Supports\Enum;

enum EmployeeRole: int
{
    use Enum;

    case PARTIME = 1;
    case FULLTIME = 2;
}
