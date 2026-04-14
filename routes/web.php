<?php

use App\Http\Controllers\Auth\ConfirmarEmailController;
use App\Http\Controllers\Auth\LoginClienteController;
use App\Http\Controllers\Auth\RegistrarClienteController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

// ─── Páginas públicas ──────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/storage', function () {
    return view('storage');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('aboutUs');
});

Route::get('/admHome', function () {
    return view('/adm/admHome');
});

Route::get('/login-adm', function () {
    return view('/login/login-adm');
})->name('login-adm');

<<<<<<< HEAD
Route::get('/login-cliente', [LoginClienteController::class, 'showLogin'])->name('login-cliente');
=======
Route::get('/admGerCar', function () {
    return view('/adm/admGerCar');
});

Route::get('/confirmar-email', function () {
    return view('/login/confirmar-email');
});
>>>>>>> 1b2e835d4f2f36edcc710a3256f966b0481d1a81

Route::post('/login-cliente', [LoginClienteController::class, 'login']);

Route::get('/registrar', [RegistrarClienteController::class, 'showRegistrar'])->name('registrar');

Route::post('/registrar', [RegistrarClienteController::class, 'registrar']);

Route::get('/confirmar-email', [ConfirmarEmailController::class, 'showConfirmar'])->name('confirmar-email');

Route::post('/confirmar-email', [ConfirmarEmailController::class, 'confirmar']);

Route::post('/reenviar-codigo', [ConfirmarEmailController::class, 'reenviar'])->name('reenviar-codigo');

Route::middleware('cliente.autenticado')->group(function () {

    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');

    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::post('/logout', [PerfilController::class, 'logout'])->name('cliente.logout');
    
});