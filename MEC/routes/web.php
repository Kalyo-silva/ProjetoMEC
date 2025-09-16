<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MantenedorController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InstrumentoController;
use App\Http\Controllers\DimensaoController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\EvidenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('mantenedores', MantenedorController::class);
Route::resource('instituicoes', InstituicaoController::class);
Route::resource('professores', ProfessorController::class);
Route::resource('cursos', CursoController::class);
Route::resource('instrumentos', InstrumentoController::class);
Route::resource('dimensoes', DimensaoController::class);
Route::resource('indicadores', IndicadorController::class);
Route::resource('criterios', CriterioController::class);
Route::resource('avaliacoes', AvaliacaoController::class);
Route::resource('evidencias', EvidenciaController::class);

require __DIR__.'/auth.php';
