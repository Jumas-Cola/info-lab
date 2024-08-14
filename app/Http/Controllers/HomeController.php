<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;

class HomeController extends Controller
{
    public function __invoke(): mixed
    {
        return view('home');
    }
}
