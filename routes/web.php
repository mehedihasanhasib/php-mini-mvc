<?php

use App\Core\Route;
use App\Http\Controllers\InitialController;
use App\Http\Request;

Route::get('/user/{id}', function(Request $request,$id){
    dd($request->all());
});
