<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/todos/create', 'todos.create-todo')->name('todos.create');
