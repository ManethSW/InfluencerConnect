<?php

namespace App\Enums;

enum CollaborationStatus: int
{
    case Pending = 0;
    case Active = 1;
    case Completed = 2;
    case Rejected = 3;

    public function getValue(): int
    {
        return $this->value;
    }
}
