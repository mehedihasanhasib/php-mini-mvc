<?php

namespace App\Http\Middlewares;

use App\Core\Session;

class VerifyCsrf
{
    public function handle()
    {
        if (!isset($_POST['_token']) || $_POST['_token'] !== Session::get('csrf_token')) {
            http_response_code(419);
            die('CSRF token mismatch');
        }
    }
}
