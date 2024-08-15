<?php

namespace App\Http\Controllers;

class GameOfLifeController extends Controller
{
    public function index()
    {
        return view('game-of-life');
    }
}
