<?php

namespace App\Http\Controllers;

use App\Models\anamnese;
use App\Models\consulta;
use App\Models\Paciente;
use App\Models\prontuario;
use App\Models\servicos_medicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HistoricoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    if($request->ajax()){
          $prontuario = prontuario::find($request->prontuario);
          $agenda = consulta::with('servico')->where('paciente_id',$prontuario->paciente->id)->get();
          $consultas =  $prontuario->anamnese;
          $examesFisicos = $prontuario->examesFisicos;
          $hepotise = $prontuario->hepotise;
          $prescricao = $prontuario->prescricao;
         return response()->json(compact('agenda','consultas','examesFisicos','hepotise','prescricao'));
        }
        $paciente = Paciente::all();
      return view('historico.index',compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->ajax()){

                $prontuario = prontuario::find(Auth::user()->paciente->prontuario->id);
                $agenda = consulta::with('servico')->where('paciente_id',Auth::user()->paciente->id)->get();
                $consultas =  $prontuario->anamnese;
                $examesFisicos = $prontuario->examesFisicos;
                $hepotise = $prontuario->hepotise;
                $prescricao = $prontuario->prescricao;
               return response()->json(compact('agenda','consultas','examesFisicos','hepotise','prescricao'));
          }

        return view('historico.show');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validationRules =  [
            'especialidade'       => 'required',
            'descricao'       => 'required|min:10|max:255',
            'data' => 'required',
            'hora' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = date('Y-m-d ',strtotime($request->data));
            $hora = date('H:i:s',strtotime($request->hora));
            $paciente = Auth::user()->paciente;
        $dados=    array(
                "paciente_id" => $paciente->id,
                "descricao" => $request->descricao,
                "servicos_medicos_id" =>    $request->especialidade,
                "estado"     => 1,
                "data_atendimento" => $data,
                "inicio_atendimento" => $hora,
                );
              consulta::create($dados);



        } catch (\Exception $e) {
             DB::rollBack();

             return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' A consulta foi Agendada com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function agendar()
    {   $especialidades = servicos_medicos::all();
        return view('historico.create',compact('especialidades'));
    }


}
