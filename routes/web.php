<?php

use App\Http\Controllers\Auth\ConfirmarEmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoginAdmController;
use App\Http\Controllers\Auth\EsqueciSenhaController;
use App\Http\Controllers\Auth\RegistrarClienteController;
use App\Http\Controllers\Adm\AdmCarroController;
use App\Http\Controllers\Adm\AdmMarcaController;
use App\Http\Controllers\Adm\AdmPedidoController;
use App\Http\Controllers\Adm\AdmUserController;
use App\Http\Controllers\Adm\AdmClienteController;
use App\Http\Controllers\Adm\AdmDashboardController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\PedidoClienteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

// Rota TESTE
Route::get('/admHome', [AdmDashboardController::class, 'index'])->middleware('admin.autenticado')->name('admHome');

// Troca de idioma
Route::get('/locale/{lang}', function ($lang) {
    if (in_array($lang, ['pt_BR', 'en'])) {
        session(['locale' => $lang]);
    }
    return redirect()->back();
})->name('locale.set');

// Páginas públicas do site
Route::get('/', fn() => redirect()->route('home'));

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/infocar', function () {
    return view('cliente.info_carro', ['carro' => null, 'relacionados' => collect()]);
})->name('info-carro');

Route::get('/carro/{carro}', [CarroController::class, 'show'])->name('carro.show');
Route::get('/carros/por-ids', [CarroController::class, 'porIds'])->name('carros.por-ids');
Route::get('/favoritos', fn() => view('cliente.favoritos'))->name('favoritos');

// Login unificado
Route::get('/login',  [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Aliases para compatibilidade com middlewares e links existentes
Route::get('/login-adm',     fn() => redirect()->route('login'))->name('login-adm');
Route::get('/login-cliente', fn() => redirect()->route('login'))->name('login-cliente');

Route::post('/logout-adm', [LoginAdmController::class, 'logout'])->name('adm.logout');

// Painel admin (protegido)
Route::prefix('adm')->name('adm.')->middleware('admin.autenticado')->group(function () {

    Route::get('/', [AdmDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('marcas')->name('marcas.')->group(function () {
        Route::post('/',                       [AdmMarcaController::class, 'store'])->name('store');
        Route::post('/{marca}/logo',           [AdmMarcaController::class, 'updateLogo'])->name('logo');
        Route::delete('/{marca}',              [AdmMarcaController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('carros')->name('carros.')->group(function () {
        Route::get('/',                    [AdmCarroController::class, 'index'])->name('index');
        Route::post('/',                   [AdmCarroController::class, 'store'])->name('store');
        Route::put('/{carro}',             [AdmCarroController::class, 'update'])->name('update');
        Route::post('/{carro}/destacar',   [AdmCarroController::class, 'destacar'])->name('destacar');
        Route::delete('/{carro}',          [AdmCarroController::class, 'destroy'])->name('destroy');
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



// Recuperação de senha
Route::get('/esqueci-senha', [EsqueciSenhaController::class, 'showForm'])->name('esqueci-senha');
Route::post('/esqueci-senha', [EsqueciSenhaController::class, 'enviarLink'])->name('esqueci-senha.enviar');
Route::get('/redefinir-senha/{token}', [EsqueciSenhaController::class, 'showReset'])->name('senha.redefinir.form');
Route::post('/redefinir-senha', [EsqueciSenhaController::class, 'redefinir'])->name('senha.redefinir');

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
    Route::post('/perfil/endereco', [PerfilController::class, 'updateEndereco'])->name('perfil.endereco.update');
    Route::delete('/perfil', [PerfilController::class, 'destroy'])->name('perfil.destroy');
    Route::post('/logout', [PerfilController::class, 'logout'])->name('cliente.logout');

    Route::get('/carrinho',                    [CarrinhoController::class, 'index'])->name('carrinho');
    Route::post('/carrinho/{carro}/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/carrinho/{carro}/remover',   [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::post('/carrinho/limpar',            [CarrinhoController::class, 'limpar'])->name('carrinho.limpar');
    Route::get('/checkout',                    [CarrinhoController::class, 'checkout'])->name('checkout');

    Route::get('/meus-pedidos', [PedidoClienteController::class, 'index'])->name('pedidos.index');
    Route::post('/pedido', [PedidoClienteController::class, 'store'])->name('pedido.store');
    Route::get('/pedido/{pedido}', [PedidoClienteController::class, 'show'])->name('pedido.show');

    Route::post('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/stripe/success',   [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/stripe/cancel',    [StripeController::class, 'cancel'])->name('stripe.cancel');

});