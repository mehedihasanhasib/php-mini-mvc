<?php

namespace App\Http\Middlewares;

class GuestMiddleware
{
    public function handle()
    {
        if (auth()) {
            redirect(route('home'));
        }
    }
}
