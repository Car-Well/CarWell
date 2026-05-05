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

// Login admin
Route::get('/login-adm',  [LoginAdmController::class, 'showLogin'])->name('login-adm');
Route::post('/login-adm', [LoginAdmController::class, 'login'])->name('login-adm.post');
Route::post('/logout-adm',[LoginAdmController::class, 'logout'])->name('adm.logout');

// Painel admin (protegido)
Route::prefix('adm')->name('adm.')->middleware('admin.autenticado')->group(function () {

    Route::get('/', [AdmDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('carros')->name('carros.')->group(function () {
        Route::get('/',           [AdmCarroController::class, 'index'])->name('index');
        Route::post('/',          [AdmCarroController::class, 'store'])->name('store');
        Route::put('/{carro}',    [AdmCarroController::class, 'update'])->name('update');
        Route::delete('/{carro}', [AdmCarroController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('usuarios')->name('usuarios.')->group(function () {
        Route::get('/',              [AdmClienteController::class, 'index'])->name('index');
        Route::post('/',             [AdmClienteController::class, 'store'])->name('store');
        Route::put('/{cliente}',     [AdmClienteController::class, 'update'])->name('update');
        Route::delete('/{cliente}',  [AdmClienteController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pedidos')->name('pedidos.')->group(function () {
        Route::get('/',             [AdmPedidoController::class, 'index'])->name('index');
        Route::post('/',            [AdmPedidoController::class, 'store'])->name('store');
        Route::put('/{pedido}',     [AdmPedidoController::class, 'update'])->name('update');
        Route::delete('/{pedido}',  [AdmPedidoController::class, 'destroy'])->name('destroy');
    });

});

// Alias p/ não quebrar os links atuais das views
Route::get('/admGerCar', function () { return redirect()->route('adm.carros.index'); })->name('admGerCar');
Route::get('/admGerUser', function () { return redirect()->route('adm.usuarios.index'); })->name('admGerUser');
Route::get('/admGerPed', function () { return redirect()->route('adm.pedidos.index'); })->name('admGerPed');


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