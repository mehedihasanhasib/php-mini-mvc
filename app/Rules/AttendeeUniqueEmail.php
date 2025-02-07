<?php

namespace App\Rules;

use App\Helpers\DB;

class AttendeeUniqueEmail
{
    public $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validate($value, $field, $fail)
    {
        $result = DB::query('SELECT email FROM attendees WHERE email = :email AND event_id = :event_id', [
            'email' => $value,
            'event_id' => $this->request->input('event_id'),
        ]);

        if (!empty($result)) {
            $fail('Email already registered, use a different email.');
        }
    }
}
