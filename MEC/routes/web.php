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

Route::resource('mantenedores', MantenedorController::class)->middleware(['auth', 'verified']);
Route::resource('instituicoes', InstituicaoController::class);
Route::resource('professores', ProfessorController::class);
Route::resource('cursos', CursoController::class);
Route::resource('instrumentos', InstrumentoController::class);
Route::resource('dimensoes', DimensaoController::class);
Route::post('/dimensoes/{id}/up', [DimensaoController::class, 'up'])->name('dimensoes.up')->middleware(['auth', 'verified']);
Route::post('/dimensoes/{id}/down', [DimensaoController::class, 'down'])->name('dimensoes.down')->middleware(['auth', 'verified']);

Route::resource('indicadores', IndicadorController::class);
Route::post('/indicadores/{id}/up', [IndicadorController::class, 'up'])->name('indicadores.up')->middleware(['auth', 'verified']);
Route::post('/indicadores/{id}/down', [IndicadorController::class, 'down'])->name('indicadores.down')->middleware(['auth', 'verified']);

Route::resource('criterios', CriterioController::class);
Route::post('/criterios/{id}/up', [CriterioController::class, 'up'])->name('criterios.up')->middleware(['auth', 'verified']);
Route::post('/criterios/{id}/down', [CriterioController::class, 'down'])->name('criterios.down')->middleware(['auth', 'verified']);

Route::resource('avaliacoes', AvaliacaoController::class);
Route::resource('evidencias', EvidenciaController::class);

require __DIR__ . '/auth.php';
