<?php

namespace App\Core;

use App\Models\User;

class Auth
{
    public static function login($data)
    {
        session_regenerate_id(true);
        Session::put('auth', true);
        Session::put('user', $data);
    }

    public static function user()
    {
        return Session::get('user') ?? null;
    }

    public static function attempt($credentials = [])
    {
        $user = new User();
        return $user->where('email', "=", $credentials['email'])->first();
    }

    public static function authorize($user_id = null)
    {
        if ($user_id !== auth()['id']) {
            http_response_code(403);
            require BASE_PATH . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '403.php';
            exit;
        }

        return true;
    }
}
