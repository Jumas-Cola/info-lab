<?php

use App\Http\Controllers\BaseConvert;
use App\Http\Controllers\NormalAlgo;
use App\Http\Controllers\TuringMachine;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('scholar');
})->name('home');

Route::get('/base-convert', [BaseConvert::class, 'index'])
    ->name('base-convert');

Route::get('/turing-machine', [TuringMachine::class, 'index'])
    ->name('turing-machine');

Route::get('/normal-algo', [NormalAlgo::class, 'index'])
    ->name('normal-algo');
