<?php

use App\http\Controllers\PessoaController;
use App\http\Controllers\BairroController;
use App\http\Controllers\MunicipioController;
use App\http\Controllers\Uf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/pessoa', [PessoaController::class, 'index']);
Route::put('/pessoa/{id}', [PessoaController::class, 'update']);
Route::post('/pessoa', [PessoaController::class, 'store']);

Route::get('/bairro', [BairroController::class, 'index']);
Route::put('/bairro/{codigoBairro}', [BairroController::class, 'update']);
Route::post('/bairro', [BairroController::class, 'store']);

Route::get('/municipio', [MunicipioController::class, 'index']);
Route::put('/municipio/{codigoMunicipio}', [MunicipioController::class, 'update']);
Route::post('/municipio', [MunicipioController::class, 'store']);

Route::get('/uf', [Uf::class, 'index']);
Route::put('/uf/{codigoUf}', [Uf::class, 'update']);
Route::post('/uf', [Uf::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
