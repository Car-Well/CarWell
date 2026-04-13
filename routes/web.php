<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/storage', function () {
    return view('storage');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('aboutUs');
});

Route::get('/login-client', function () {
    return view('/login/login-client');
});

Route::get('/admHome', function () {
    return view('/adm/admHome');
});

Route::get('/login-adm', function () {
    return view('/login/login-adm');
});

Route::get('/admGerCar', function () {
    return view('/adm/admGerCar');
});

Route::get('/confirmar-email', function () {
    return view('/login/confirmar-email');
});

Route::get('/registrar', function () {
    return view('/login/registrar-cliente');
});

Route::get('/perfil', function () {
    return view('/login/perfil');
});