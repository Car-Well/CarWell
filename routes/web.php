<?php

use App\Http\Controllers\Auth\ConfirmarEmailController;
use App\Http\Controllers\Auth\LoginClienteController;
use App\Http\Controllers\Auth\RegistrarClienteController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

// Rota TESTE
Route::get('/teste', function(){
    return view('teste');
});

// Páginas públicas do site
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

Route::get('/infocar', function () {
    return view('info_carro');
});

Route::get('/carrinho', function () {
    return view('carrinho');
})->name('carrinho');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');




// Área administrativa
Route::get('/admHome', function () {
    return view('adm/admHome');
})->name('admHome');

Route::get('/login-adm', function () {
    return view('login/login-adm');
})->name('login-adm');

Route::get('/admGerCar', function () {
    return view('adm/admGerCar');
})->name('admGerCar');

Route::get('/admGerUser', function(){
    return view('adm/admGerUser');
})->name('admGerUser');

// Autenticação do cliente
// ============================================================

// Login
Route::get('/login-cliente', [LoginClienteController::class, 'showLogin'])->name('login-cliente');
Route::post('/login-cliente', [LoginClienteController::class, 'login']);

// Cadastro
Route::get('/registrar', [RegistrarClienteController::class, 'showRegistrar'])->name('registrar');
Route::post('/registrar', [RegistrarClienteController::class, 'registrar']);

// Confirmação de e-mail (verificação por código de 6 dígitos)
Route::get('/confirmar-email', [ConfirmarEmailController::class, 'showConfirmar'])->name('confirmar-email');
Route::post('/confirmar-email', [ConfirmarEmailController::class, 'confirmar']);
Route::post('/reenviar-codigo', [ConfirmarEmailController::class, 'reenviar'])->name('reenviar-codigo');


// Área do cliente (requer login)


Route::middleware('cliente.autenticado')->group(function () {

    Route::get('/perfil', [PerfilController::class, 'show'])->name('perfil');

    Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::post('/logout', [PerfilController::class, 'logout'])->name('cliente.logout');

});