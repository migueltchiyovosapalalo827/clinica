<?php

namespace App\Http\Controllers\Api;

use App\Models\consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgendaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paciente  = Auth::user()->paciente->id;
        $consulta = consulta::where('paciente_id',$paciente)
        ->join('servicos_medicos', 'servicos_medicos.id', '=', 'consulta.servicos_medicos_id')
        ->select('consulta.*', 'servicos_medicos.nome  as nomeespecialidade')
       ->latest()->get();






        return $this->sendResponse($consulta, 'certo');
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
            'descricao'       => 'required|min:10|max:255',
            'data' => 'required',
            'hora' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        DB::beginTransaction();
        try {
            $data = date('Y-m-d ',strtotime($request->data));
            $hora = date('H:i:s',strtotime($request->hora));
            $paciente = Auth::user()->paciente()->first();
        $dados=    array(
                "descricao" => $request->descricao,
                "servicos_medicos_id" =>    $request->especialidade,
                "estado"     =>  1,
                "data_atendimento" => $data,
                "inicio_atendimento" => $hora,
                );

             $consulta = new consulta($dados);
             $paciente->consultas()->save($consulta);

        } catch (\Exception $e) {
             DB::rollBack();
             return $this->sendError('Error exception', $e->getMessage());

        }

        DB::commit();

        return $this->sendResponse(true, 'A consulta foi Agendada com sucesso');



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
        $consulta = consulta::find($id);

        return $this->sendResponse($consulta, 'consulta detalhada');


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
}
