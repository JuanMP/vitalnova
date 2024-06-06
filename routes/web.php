<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TeamController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsDoctor;
use App\Http\Middleware\IsReceptionist;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\HomeController;


//Página de inicio
Route::get('/', function () {
    return view('index');
})->name('index');

//Rutas para Footer
Route::get('/privacy/policy', function () { return view('legal.privacy.policy'); })->name('legal.privacy.policy'); //Política de privacidad
Route::get('/terms/conditions', function () { return view('legal.terms.conditions'); })->name('legal.terms.conditions'); //Términos y condiciones
Route::get('/cookies/policy', function () { return view('legal.cookies.policy'); })->name('legal.cookies.policy'); //Política de cookies
Route::get('/cookies/settings', function () { return view('legal.cookies.settings'); })->name('legal.cookies.settings'); //Configuración de cookies

//Rutas para el navbar
Route::view('/contact', 'contact.index')->name('contact');

//Rutas de autenticación
Route::get('signup', [LoginController::class, 'signupForm'])->name('signupForm'); //Muestra formulario de registro
Route::post('signup', [LoginController::class, 'signup'])->name('signup'); //Procesar el registro
Route::get('login', [LoginController::class, 'loginForm'])->name('loginForm'); //Muestra el formulario de inicio de sesión
Route::post('login', [LoginController::class, 'login'])->name('login'); //Procesa el inicio de sesión
Route::get('logout', [LoginController::class, 'logout'])->name('logout'); //Cierra sesión

//Rutas para la gestión de usuarios
Route::middleware('auth')->group(function () {
    Route::get('/users/profile', [UserController::class, 'show'])->name('users.profile'); //Muestra perfil del usuario
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); //Muestra formulario de edición de perfil
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); //Procesa actualización del perfil
});


//Rutas para la gestión de tratamientos
Route::middleware([IsAdmin::class])->group(function () {
    Route::get('treatments/create', [TreatmentController::class, 'create'])->name('treatments.create'); //Muestra formulario de creación de tratamientos
    Route::post('treatments', [TreatmentController::class, 'store'])->name('treatments.store'); //Procesa creación de tratamientos
    Route::get('treatments/{treatment}/edit', [TreatmentController::class, 'edit'])->name('treatments.edit'); //Muestra formulario de edición de tratamientos
    Route::put('treatments/{treatment}', [TreatmentController::class, 'update'])->name('treatments.update'); //Procesa actualización de tratamientos
    Route::delete('treatments/{treatment}', [TreatmentController::class, 'destroy'])->name('treatments.destroy'); //Elimina tratamientos
});

//Ruta para Muestra todos los tratamientos
Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index'); //Muestra lista de tratamientos

//Rutas para los doctores y recepcionistas (puedes añadir las rutas específicas aquí)
Route::middleware([IsDoctor::class])->group(function () {
    //Rutas específicas para doctores
});

//Rutas para la página de Pacientes (solo para la recepcionista)
Route::middleware([IsReceptionist::class])->group(function () {
    Route::get('/patients', [UserController::class, 'list'])->name('users.list');
});

//Ruta para la gestión de citas
Route::resource('appointments', AppointmentController::class);

//Ruta para generar PDF
Route::get('/generate-document/{appointmentId}', [DocumentController::class, 'generateAppointmentDocument'])->name('generate.document'); //Generar documentos PDF

//Página de equipo
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index'); //Muestra el equipo

// Route::get('/contact', function () {
//     return view('contact.index');
// })->name('contact')->middleware('notAdmin');

//Ruta para Especialidades (Solo admin puede crearlas)
Route::resource('specialties', SpecialtyController::class)->middleware('auth');

//Ruta para la página principal
Route::get('/', [HomeController::class, 'index'])->name('index');

//Middleware para evitar que Admin tenga acceso
Route::middleware(['notAdmin'])->group(function () {
    Route::resource('appointments', AppointmentController::class);
    Route::get('/contact', function () {
        return view('contact.index');
    })->name('contact');
});
