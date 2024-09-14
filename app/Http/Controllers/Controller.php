<?php

namespace App\Http\Controllers;

use A17\Twill\Facades\TwillAppSettings;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    public function __construct()
    {
        View::share('siteSettings', TwillAppSettings::getGroupDataForSectionAndName('homepage', 'homepage'));
    }
}
