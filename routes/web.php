<?php

use App\Core\Route;
use App\Http\Controllers\InitialController;
use App\Http\Request;

Route::get('/', function () {
    return view('index');
});

Route::post('/file', function (Request $request) {
    $file = $request->file('file');
    $file->move(public_path('uploads'), time() . $file->getClientOriginalName());
    echo "File Upload Successfull";
});
