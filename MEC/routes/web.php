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
Route::resource('instituicoes', InstituicaoController::class)->middleware(['auth', 'verified']);;
Route::resource('professores', ProfessorController::class)->middleware(['auth', 'verified']);;
Route::resource('cursos', CursoController::class)->middleware(['auth', 'verified']);;
Route::resource('instrumentos', InstrumentoController::class)->middleware(['auth', 'verified']);;
Route::get('instrumentos/{id}/export', [InstrumentoController::class, 'export'])->name('instrumentos.export')->middleware(['auth', 'verified']);

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

Route::get('/evidencias/files', [EvidenciaController::class, 'files'])->name('evidencias.files')->middleware(['auth', 'verified']);
Route::get('/evidencias/links/{size}', [EvidenciaController::class, 'links'])->name('evidencias.links')->middleware(['auth', 'verified']);
Route::get('/evidencias/texts', [EvidenciaController::class, 'texts'])->name('evidencias.texts')->middleware(['auth', 'verified']);
Route::get('/evidencias/{id}/details', [EvidenciaController::class, 'details'])->name('evidencias.details')->middleware(['auth', 'verified']);

Route::resource('evidencias', EvidenciaController::class);
Route::post('/evidencias/store_link', [EvidenciaController::class, 'store_link'])->name('evidencias.store_link')->middleware(['auth', 'verified']);
Route::post('/evidencias/store_text', [EvidenciaController::class, 'store_text'])->name('evidencias.store_text')->middleware(['auth', 'verified']);
Route::post('/evidencias/store_file', [EvidenciaController::class, 'store_file'])->name('evidencias.store_file')->middleware(['auth', 'verified']);


require __DIR__ . '/auth.php';
