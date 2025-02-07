<?php

namespace App\Rules;

use App\Helpers\DB;

class AttendeeValidPhoneNumber
{

    public function validate($value, $field, $fail)
    {
        if (!str_starts_with($value, "01")) {
            $fail('Invalid Phone Number. Must starts with 01');
        }
    }
}
