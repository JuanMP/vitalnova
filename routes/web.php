<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsDoctor;
use App\Http\Middleware\IsReceptionist;





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
//estas no valen porque solo son para ver
Route::view('/login', 'auth.login')->name('login');
Route::view('/signup', 'auth.signup')->name('signup');

//Rutas para el inicio de sesión
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm');
Route::post('signup', [LoginController::class, 'signup'])->name('signup');
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/users/profile', [UserController::class, 'show'])->name('users.profile')->middleware('auth');
Route::resource('users', UserController::class);


//Roles Admin y Médico


//Página de Citas
//Route::resource('appointments', AppointmentController::class);



//Middleware Admin
Route::middleware('admin')->get('/admin', function () {
    return view('index');
});


Route::middleware([IsAdmin::class])->group(function () {

});

Route::middleware([IsDoctor::class])->group(function () {

});

Route::middleware([IsReceptionist::class])->group(function () {
});

Route::resource('appointments', AppointmentController::class);

