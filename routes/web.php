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

Route::get('/cookies/policy', function () {
    return view('legal.cookies.policy');
})->name('legal.cookies.policy');

Route::get('/cookies/settings', function () {
    return view('legal.cookies.settings');
})->name('legal.cookies.settings');


//Rutas para el navbar
Route::view('/', 'index')->name('index');
Route::view('/treatments', 'treatments.index')->name('treatments');
Route::view('/teams', 'teams.index')->name('teams');
