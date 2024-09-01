<?php

use App\Http\Controllers\BaseConvertController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GameOfLifeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NormalAlgoController;
use App\Http\Controllers\PageDisplayController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestCheckController;
use App\Http\Controllers\TuringMachineController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::prefix('calc')->name('calc.')->group(function () {
    Route::get('base-convert', [BaseConvertController::class, 'index'])
        ->name('base-convert');

    Route::get('turing-machine', [TuringMachineController::class, 'index'])
        ->name('turing-machine');

    Route::get('normal-algo', [NormalAlgoController::class, 'index'])
        ->name('normal-algo');

    Route::get('game-of-life', [GameOfLifeController::class, 'index'])
        ->name('game-of-life');
});

Route::get('pages/{slug}', [PageDisplayController::class, 'show'])->name('frontend.page')->where('slug', '.*');
Route::get('pages', [PageDisplayController::class, 'index'])->name('pages');
Route::get('pages/laboratornye', [PageDisplayController::class, 'show'])->name('labs');
Route::get('pages/o-sajte', [PageDisplayController::class, 'show'])->name('about');

Route::post('test-check', [TestCheckController::class, 'handleTestResults'])->name('test-check');

Route::get('search', [SearchController::class, 'search'])->name('search');

Route::middleware('recaptcha')->group(function () {
    Route::post('contact-us', [ContactUsController::class, 'contactUs'])->name('contact-us');
});
