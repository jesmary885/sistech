<?php


use App\Http\Livewire\Admin\UsuariosCreate;
use App\Http\Livewire\Admin\UsuariosIndex;

use Illuminate\Support\Facades\Route;


Route::get('usuarios', UsuariosIndex::class)->name('admin.usuarios.index');
Route::get('usuarios/create', UsuariosCreate::class)->name('admin.usuarios.create');

