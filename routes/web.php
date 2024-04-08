<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


//Rutas para Footer
Route::get('/privacy/policy', function () {
    return view('legal.privacy.policy');
})->name('legal.privacy.policy');

Route::get('/terms/conditions', function (){
    return view('legal.terms.conditions');
})->name('legal.terms.conditions');


//Rutas para el navbar
Route::view('/', 'index')->name('index');
