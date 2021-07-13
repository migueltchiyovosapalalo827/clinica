<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Models\hepotise_diagnostica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HipoteseController extends Controller
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
        ->join('hepotise_diagnostica', 'hepotise_diagnostica.prontuario_id', '=', 'prontuario.id')
        ->join('users', 'users.id', '=', 'pacientes.user_id')
        ->join('consulta', 'consulta.id', '=', 'hepotise_diagnostica.consulta_id')
        ->join('profissional_saude', 'consulta.profissional_saude_id', '=', 'profissional_saude.id')
        ->join('dados_pessoais', 'profissional_saude.user_id', '=', 'dados_pessoais.user_id')
        ->select('hepotise_diagnostica.*', 'users.name  as nomepaciente','dados_pessoais.nome as medico')
       ->latest()->get();
      return  DataTables::of($data)->make(true);;

         }


                 return view('hepotise_diagnostica.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $consulta =   consulta::whereNotIn('id',function($query){
            $query->select('consulta_id')->from('hepotise_diagnostica');
         })->where('estado',0) ->where('consulta.profissional_saude_id', Auth::user()->funcionario->id)->latest()->get();

        return view('hepotise_diagnostica.criar',['consulta'=>$consulta]);
    }

    /**
     * Show the form for creating a new resource.
     * @param consulta $consulta
     * @return \Illuminate\Http\Response
     */
   public function criar(consulta $consulta)
    {
        # code...

         return view('hepotise_diagnostica.create',['consulta'=>$consulta]);
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

            'hipotise' => 'required',
            'tipo_exame' => 'required',
            'diagnostico_final'=> 'required|min:6|max:255',
            'solicitar_exame' => 'required',
             'requer_iternacao' => 'required',
            'reque_urgencia' => 'required',
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
           'hipotise' =>  $request->hipotise,
            'tipo_exame' =>  $request->tipo_exame,
            'diagnostico_final'=>  $request->diagnostico_final,
            'solicitar_exame' =>  $request->solicitar_exame,
             'requer_iternacao' =>  $request->requer_iternacao,
            'reque_urgencia' =>  $request->reque_urgencia,
                );
            $hepotise_diagnostica = new hepotise_diagnostica($dados);
             $consulta->paciente->prontuario->hepotise()->save($hepotise_diagnostica);


        } catch (\Exception $e) {
             DB::rollBack();
          dd($e->getMessage());
         // return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' hepotise criada com sucesso');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(hepotise_diagnostica $hepotise_diagnostica)
    {
        //
        return view('hepotise_diagnostica.show',['hepotise_diagnostica'=>$hepotise_diagnostica]);
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
        $hepotise_diagnostica  =  hepotise_diagnostica::find($id);
        return view('hepotise_diagnostica.update',['hepotise_diagnostica'=>$hepotise_diagnostica]);

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
        $hepotise_diagnostica = hepotise_diagnostica::find($id);

        $validationRules =  [

            'hipotise' => 'required',
            'tipo_exame' => 'required',
            'diagnostico_final'=> 'required|min:6|max:255',
            'solicitar_exame' => 'required',
            'requer_iternacao' => 'required',
            'reque_urgencia' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
           $dados = array(
           'hipotise' =>  $request->hipotise,
            'tipo_exame' =>  $request->tipo_exame,
            'diagnostico_final'=>  $request->diagnostico_final,
            'solicitar_exame' =>  $request->solicitar_exame,
             'requer_iternacao' =>  $request->requer_iternacao,
            'reque_urgencia' =>  $request->reque_urgencia,

                );

                $hepotise_diagnostica->update($dados);
        } catch (\Exception $e) {
             DB::rollBack();

          return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' hepotise actualizado com sucesso');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(hepotise_diagnostica $hepotise_diagnostica)
    {
        //
        if (!$found = $hepotise_diagnostica->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este hepotise'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'hepotise elimindo com sucesso',

       ],200);
    }
}
