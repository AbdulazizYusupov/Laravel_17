<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/category',\App\Livewire\CategoryComponent::class);
Route::get('/food',\App\Livewire\FoodComponent::class);
Route::get('/client',\App\Livewire\Client::class);
