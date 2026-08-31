<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'todos.index')->name('todos.index');

Route::livewire('/todos/create', 'todos.create-todo')->name('todos.create');
