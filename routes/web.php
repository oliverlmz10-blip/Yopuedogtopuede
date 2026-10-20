<?php
use App\Http\Controllers\IdseController;
use App\Http\Controllers\FolioController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PromotorController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ImportacionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Módulo IDSE: búsqueda y actualización de estatus
Route::prefix('idse')->controller(IdseController::class)->name('idse.')->group(function () {
    Route::get('/', 'index')->name('index');           // buscador con filtros
    Route::get('/{beneficiario}', 'show')->name('show'); // ficha individual
    Route::put('/{beneficiario}', 'update')->name('update'); // actualizar estatus
});

// Módulo FOLIOS: impresión de solicitudes
Route::prefix('folios')->controller(FolioController::class)->name('folios.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{beneficiario}/imprimir', 'imprimirIndividual')->name('imprimir.individual');
    Route::post('/imprimir-masivo', 'imprimirMasivo')->name('imprimir.masivo');
});

// Módulo LISTAS: listas de asistencia
Route::prefix('listas')->controller(ListaController::class)->name('listas.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/generar', 'generar')->name('generar');
});

// Módulo RECONOCIMIENTOS
Route::prefix('reconocimientos')->controller(ReconocimientoController::class)->name('reconocimientos.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{beneficiario}/individual', 'individual')->name('individual');
    Route::post('/masivo', 'masivo')->name('masivo');
});

//Ruta para el excel
Route::prefix('importaciones')->controller(ImportacionController::class)->name('importaciones.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{archivo}', 'show')->name('show');
});

// Módulo GRUPOS (y sus catálogos: promotores, municipios, regiones)
Route::resource('grupos', GrupoController::class);
Route::resource('promotores', PromotorController::class);
Route::resource('municipios', MunicipioController::class);
Route::resource('regiones', RegionController::class);
