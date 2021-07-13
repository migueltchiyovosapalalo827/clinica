<?php
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [Home::class, 'index']);
Route::get('/contactos', [Home::class, 'contactos'])->name('contacto');
Route::post('agendamento', [Home::class, 'agenda'] )->name('agendamento');
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group( function()
{
    Route::post('/perfil/{user}',[App\Http\Controllers\UserController::class,'perfil'])->name('perfil');
    Route::get('/anamnese/criar/{consulta}',[App\Http\Controllers\AnamneseController::class,'criar'])->name('anamnese.criar');
    Route::get('/exames_fisicos/criar/{consulta}',[App\Http\Controllers\ExamesfisicosController::class,'criar'])->name('exames_fisicos.criar');
    Route::get('/hipotise/criar/{consulta}',[App\Http\Controllers\HipoteseController::class,'criar'])->name('hipotise.criar');
    Route::get('/prescricao/print/{id}',[App\Http\Controllers\PrescricoesController::class,'print'])->name('prescricao.print');
    Route::get('/prescricao/pdf/{id}',[App\Http\Controllers\PrescricoesController::class,'createPdf'])->name('prescricao.pdf');

    Route::get('historico/agenda',[App\Http\Controllers\HistoricoController::class,'agendar'])->name('historico.agendar');
    Route::get('agenda/medico', [App\Http\Controllers\AgendaController::class,'AgendaMedico'])->name('agenda.medico');;
Route::resources([
    'user' =>  UserController::class,
    'servicos' => ServicosMedicosController::class,
    'paciente' => PacienteController::class,
    'agenda' => AgendaController::class,
    'anamnese' =>AnamneseController::class,
    'exames_fisicos' =>  ExamesfisicosController::class,
    'hipotise' => HipoteseController::class,
    'exames' => ExamesComplementarController::class,
    'prescricao'=> PrescricoesController::class,
    'historico' => HistoricoController::class,
]);

}
);

require __DIR__.'/auth.php';
