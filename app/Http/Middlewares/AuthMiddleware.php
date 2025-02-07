<?php

namespace App\Http\Middlewares;

class AuthMiddleware
{
    public function handle()
    {
        if (!auth()) {
            redirect(route('login'));
        }
    }
}
