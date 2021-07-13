<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoricoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/


Route::middleware('auth:sanctum')->group(function () {
Route::get('consulta',[HistoricoController::class, 'consultasRealizada']);
Route::get('consulta/{id}',[HistoricoController::class, 'showConsultas']);
Route::get('exames',[HistoricoController::class, 'examesFesicos']);
Route::get('hipotises',[HistoricoController::class, 'hipotiseRealizada']);
Route::get('hipotises/{id}',[HistoricoController::class, 'showHipotise']);
Route::get('prescricao',[HistoricoController::class, 'prescricaoRealizada']);
Route::get('prescricao/{id}',[HistoricoController::class, 'showPrescricao']);
Route::get('medicos', [App\Http\Controllers\Api\ServicosController::class,'listarMedico']);

Route::apiResources(['servico' => Api\ServicosController::class,
    'agenda' => Api\AgendaController::class,
]);
Route::get('logout', [AuthController::class, 'destroy']);

});


//Route::get('servico', [ServicosController::class,'index']);
Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
