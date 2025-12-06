<?php


use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'uz', 'ru'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');


///////////////////////////////////////////
////    Slider Controller Route Starts Here
///////////////////////////////////////////

Route::resource('slider', SliderController::class);
