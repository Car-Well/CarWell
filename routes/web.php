<?php

use App\Http\Controllers\Auth\ConfirmarEmailController;
use App\Http\Controllers\Auth\LoginClienteController;
use App\Http\Controllers\Auth\RegistrarClienteController;
use App\Http\Controllers\Adm\AdmCarroController;
use App\Http\Controllers\Adm\AdmPedidoController;
use App\Http\Controllers\Adm\AdmUserController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

// Rota TESTE
Route::get('/teste', function(){
    return view('teste');
});

// Troca de idioma
Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['pt_BR', 'en'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('locale.set');

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
})->name('info-carro');

// Área administrativa
Route::get('/admHome', function () {
    return view('adm/admHome');
})->name('admHome');

Route::get('/login-adm', function () {
    return view('login/login-adm');
})->name('login-adm');

Route::prefix('adm')->name('adm.')->group(function () {
    Route::get('/carros', [AdmCarroController::class, 'index'])->name('carros.index');
    Route::post('/carros', [AdmCarroController::class, 'store'])->name('carros.store');
    Route::put('/carros/{carro}', [AdmCarroController::class, 'update'])->name('carros.update');
    Route::delete('/carros/{carro}', [AdmCarroController::class, 'destroy'])->name('carros.destroy');

    Route::get('/usuarios', [AdmUserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios', [AdmUserController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{cliente}', [AdmUserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{cliente}', [AdmUserController::class, 'destroy'])->name('usuarios.destroy');

    Route::get('/pedidos', [AdmPedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos', [AdmPedidoController::class, 'store'])->name('pedidos.store');
    Route::put('/pedidos/{pedido}', [AdmPedidoController::class, 'update'])->name('pedidos.update');
    Route::delete('/pedidos/{pedido}', [AdmPedidoController::class, 'destroy'])->name('pedidos.destroy');
});

// Alias p/ não quebrar os links atuais das views
Route::get('/admGerCar', fn () => redirect()->route('adm.carros.index'))->name('admGerCar');
Route::get('/admGerUser', fn () => redirect()->route('adm.usuarios.index'))->name('admGerUser');
Route::get('/admGerPed', fn () => redirect()->route('adm.pedidos.index'))->name('admGerPed');

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

    Route::get('/carrinho', function () {
        return view('carrinho');
    })->name('carrinho');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');

    Route::get('/pedido', function () {
        return view('pedido');
    })->name('pedido');

});