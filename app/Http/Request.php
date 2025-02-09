<?php

namespace App\Http;

use Illuminate\Http\Request as HttpRequest;

class Request extends HttpRequest
{
    public function __construct()
    {
        parent::__construct($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);
    }
}
