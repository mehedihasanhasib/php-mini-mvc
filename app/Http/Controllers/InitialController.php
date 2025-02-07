<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Http\Request;

class InitialController extends Controller
{
    public function index($id)
    {
        dd($id);
        return $this->view('index');
    }
}
