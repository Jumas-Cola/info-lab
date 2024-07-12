<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloWorldLabController extends Controller
{
    public function index(Request $request)
    {
        return view('hello-world-lab');
    }
}
