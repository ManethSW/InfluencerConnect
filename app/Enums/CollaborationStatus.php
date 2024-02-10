<?php

namespace App\Enums;

enum CollaborationStatus: int
{
    case Pending = 0;
    case Active = 1;
    case Completed = 3;
    case Rejected = 4;
}
