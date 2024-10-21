<?php

namespace App\Enums;

enum ForecastStep: int
{
    case Hourly = 1;
    case Daily = 2;
}
