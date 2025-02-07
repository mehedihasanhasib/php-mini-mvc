<?php

namespace App\Rules;

use App\Helpers\DB;

class AttendeeUniquePhoneNumber
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validate($value, $field, $fail)
    {
        $result = DB::query('SELECT phone_number FROM attendees WHERE phone_number = :phone_number AND event_id = :event_id', [
            'phone_number' => $value,
            'event_id' => $this->request->input('event_id'),
        ]);

        if (!empty($result)) {
            $fail('Phone number already registered, use a different one.');
        }
    }
}
