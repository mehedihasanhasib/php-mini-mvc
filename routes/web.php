<?php

use App\Core\Route;
use App\Http\Controllers\InitialController;

Route::get('/', [InitialController::class, 'index']);
