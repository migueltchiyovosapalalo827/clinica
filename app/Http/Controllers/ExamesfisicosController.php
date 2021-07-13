<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Models\exame_fisico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExamesfisicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
      if($request->ajax())
       {
        $data = DB::table('prontuario')->join('pacientes', 'pacientes.prontuario_id', '=', 'prontuario.id')
        ->join('exame_fisico', 'exame_fisico.prontuario_id', '=', 'prontuario.id')
        ->join('users', 'users.id', '=', 'pacientes.user_id')
        ->join('consulta', 'consulta.id', '=', 'exame_fisico.consulta_id')
        ->join('profissional_saude', 'consulta.profissional_saude_id', '=', 'profissional_saude.id')
        ->join('dados_pessoais', 'profissional_saude.user_id', '=', 'dados_pessoais.user_id')
        ->select('exame_fisico.*', 'users.name  as nomepaciente','dados_pessoais.nome as medico')
       ->latest()->get();
      return  DataTables::of($data)->make(true);;

         }


                 return view('Exames_fisicos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $consulta = consulta::whereNotIn('id',function($query){
            $query->select('consulta_id')->from('exame_fisico');
         })->where('estado',0)->where('consulta.profissional_saude_id', Auth::user()->funcionario->id)->latest()->get();
        return view('Exames_fisicos.criar',['consulta'=>$consulta]);
    }

    /**
     * Show the form for creating a new resource.
     * @param consulta $consulta
     * @return \Illuminate\Http\Response
     */
   public function criar(consulta $consulta)
    {
        # code...

         return view('Exames_fisicos.create',['consulta'=>$consulta]);
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
            'peso' => 'required|digits_between:min:1,6',
            'altura' => 'required|digits_between:min:1,6',
            'pressao_arterial_sistolica'=> 'required|digits_between:min:1,6',
            'pressao_arterial_diastolica' => 'required|digits_between:min:1,6',
             'frequencia_cardiaca' => 'required|digits_between:1,6',
            'observacao_gerais' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
             $consulta =    consulta::find($request->consulta_id);
        $dados=    array(
         "consulta_id" => $request->consulta_id,
           'peso' =>  $request->peso,
            'altura' =>  $request->altura,
            'pressao_arterial_sistolica'=>  $request->pressao_arterial_sistolica,
            'pressao_arterial_diastolica' =>  $request->pressao_arterial_diastolica,
             'frequencia_cardiaca' =>  $request->frequencia_cardiaca,
            'problemas_grasticos' =>  $request->problemas_grasticos,
            'observacao_gerais' =>  $request->observacao_gerais,

                );
            $exames_fisicos = new exame_fisico($dados);
            $consulta->paciente->prontuario->examesFisicos()->save($exames_fisicos);


        } catch (\Exception $e) {
             DB::rollBack();

          return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', 'exames fisicos criada com sucesso');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(exame_fisico $exame_fisico)
    {
        //
        return view('Exames_fisicos.show',['exame_fisico'=>$exame_fisico]);
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

        $exame_fisico = exame_fisico::find($id);
        return view('Exames_fisicos.update',['exame_fisico'=>$exame_fisico]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,exame_fisico $exame_fisico)
    {
        //

        $validationRules =  [
            'peso' => 'required|digits_between:min:1,6',
            'altura' => 'required|digits_between:min:1,6',
            'pressao_arterial_sistolica'=> 'required|digits_between:min:1,6',
            'pressao_arterial_diastolica' => 'required|digits_between:min:1,6',
             'frequencia_cardiaca' => 'required|digits_between:1,6',
            'observacao_gerais' => 'required',
            ];

        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
           $dados = array(
            'peso' =>  $request->peso,
            'altura' =>  $request->altura,
            'pressao_arterial_sistolica'=>  $request->pressao_arterial_sistolica,
            'pressao_arterial_diastolica' =>  $request->pressao_arterial_diastolica,
             'frequencia_cardiaca' =>  $request->frequencia_cardiaca,
            'problemas_grasticos' =>  $request->problemas_grasticos,
            'observacao_gerais' =>  $request->observacao_gerais,
                );

          $exame_fisico->update($dados);
        } catch (\Exception $e) {
             DB::rollBack();

          return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', 'exames fisicos actualizado com sucesso');



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
        $exame_fisico = exame_fisico::find($id);
        if (!$found = $exame_fisico->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este exames fisicos'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'exame_fisico elimindo com sucesso',

       ],200);
    }
}
