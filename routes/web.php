<?php

use App\Http\Controllers\BaseConvertController;
use App\Http\Controllers\HelloWorldLabController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NormalAlgoController;
use App\Http\Controllers\PageDisplayController;
use App\Http\Controllers\TuringMachineController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/base-convert', [BaseConvertController::class, 'index'])
    ->name('calc.base-convert');

Route::get('/turing-machine', [TuringMachineController::class, 'index'])
    ->name('calc.turing-machine');

Route::get('/normal-algo', [NormalAlgoController::class, 'index'])
    ->name('calc.normal-algo');

Route::get('/hello-world-lab', [HelloWorldLabController::class, 'index'])
    ->name('hello-world-lab');

Route::get('pages/{slug}', [PageDisplayController::class, 'show'])->name('frontend.page');
Route::get('pages', [PageDisplayController::class, 'index'])->name('pages');
