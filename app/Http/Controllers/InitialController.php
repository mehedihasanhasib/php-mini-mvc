<?php

namespace App\Http\Controllers;

use App\Core\Controller;

class InitialController extends Controller
{
    public function index()
    {
        return $this->view('index');
    }
}
