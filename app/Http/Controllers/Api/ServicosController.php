<?php

namespace App\Http\Controllers\Api;

use App\Models\profissional_saude;
use Illuminate\Http\Request;

use App\Models\servicos_medicos;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServicosController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->sendResponse(servicos_medicos::all(), 'certo');
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
        'nome' => 'required|min:6|max:255',
        'descricao' => 'required|min:10|max:255',
        ];


    $validator = Validator::make($request->all(),$validationRules);
    if ($validator->fails()) {
        return $this->sendError('Error validation', $validator->errors());
    }

    DB::beginTransaction();
    try {

        $dados = array('nome'=>$request->nome, 'descricao'=> $request->descricao);

       $servico = servicos_medicos::create($dados);


    } catch (\Exception $e) {

         DB::rollBack();
         return $this->sendError('Error validation', $e->getMessage());
    }

    DB::commit();
    return $this->sendResponse( $servico, 'o serviço foi salvo com sucesso.');

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

    public function listarMedico()
    {
        # code...
        $medico =  profissional_saude::with('dadosProfissionais','User')
        ->whereHas('User',function(Builder $query)
        {
            return $query->where('tipo','Medico');
            # code...
        })->get();
        return $this->sendResponse( $medico, 'lista de medicos.');

    }
}
