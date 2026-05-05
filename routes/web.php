<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('main.dashboard');
});

Route::get('/leaderboard', function () {
    return view('main.peringkat');
});

Route::get('/profil', function () {
    return view('main.profil');
});


Route::get('/arena', function () {
    return view('main.arena');
});

Route::get('/argumentbuilder', function () {
    return view('main.argumentbuilder');
});

Route::get('/fixargument', function () {
    return view('main.fixargument');
});

Route::get('/fallacyfinder', function () {
    return view('main.fallacyfinder');
});

Route::get('/gamifiedqte', function () {
    return view('main.gamifiedqte');
});