<?php

namespace App\Service;

use DateTime;

class DateTimeService {
    public function getCurrentDateTime(): DateTime{
        return new DateTime;
    }
}