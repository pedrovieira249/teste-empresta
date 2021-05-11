<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InstituicaoController;
use App\Http\Controllers\Api\ConveniosController;
use App\Http\Controllers\Api\CreditoDisponivelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/instituicoes/{chave?}', [InstituicaoController::class, 'index']);
Route::get('/convenios/{chave?}', [ConveniosController::class, 'index']);
Route::get('/credito', function () {
    return view('credito.index');
});

Route::post('/credito', [CreditoDisponivelController::class, 'index'])->name('api.creditoDisponivel');