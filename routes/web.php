<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('spa');
})->where('any', '^(?!api).*$');
