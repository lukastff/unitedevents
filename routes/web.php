<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("welcome");
});

Route::get('/contact', function () {
    return view("contact");
});

Route::get('/products', function () {
    $busca = request("search");

    return view("products", ["busca" => $busca]);
});

Route::get('/products/{id?}', function ($id = null) {
    return view("product", ["id" => $id]);
});
