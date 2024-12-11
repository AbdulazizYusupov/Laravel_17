<?php

use App\Livewire\LoginComponent;
use App\Livewire\WorkerComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',LoginComponent::class);

Route::middleware('check')->group(function(){
    Route::get('/category',\App\Livewire\CategoryComponent::class);
    Route::get('/food',\App\Livewire\FoodComponent::class);
    Route::get('/order',\App\Livewire\OrderComponent::class);
    Route::get('/users',\App\Livewire\UserComponent::class);
    Route::get('/section',\App\Livewire\SectionComponent::class);
    Route::get('/worker',WorkerComponent::class);
    Route::get('/jurnal',\App\Livewire\JurnalComponent::class);
});
Route::get('/client',\App\Livewire\Client::class);
Route::get('/category/{category}', \App\Livewire\FilterCategory::class)->name('category.foods');
Route::get('/cart',\App\Livewire\CartComponent::class);


