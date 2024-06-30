<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseConvertController extends Controller
{
    public function index()
    {
        return view('base-convert');
    }
}
