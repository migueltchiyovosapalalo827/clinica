<?php

namespace App\Http\Controllers;

use App\Models\anamnese;
use App\Models\consulta;
use App\Models\prontuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AnamneseController extends Controller
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
        $data = anamnese::join('prontuario', 'anamnese.prontuario_id', '=', 'prontuario.id')
                 ->join('pacientes', 'pacientes.prontuario_id', '=', 'prontuario.id')
                 ->join('users', 'users.id', '=', 'pacientes.user_id')
                 ->join('consulta', 'consulta.id', '=', 'anamnese.consulta_id')
                 ->join('profissional_saude', 'consulta.profissional_saude_id', '=', 'profissional_saude.id')
                 ->join('dados_pessoais', 'profissional_saude.user_id', '=', 'dados_pessoais.user_id')
                 ->select('anamnese.*', 'users.name  as nomepaciente','dados_pessoais.nome as medico')
                ->latest()->get();
               return  Datatables::of($data)->make(true);

         }


                 return view('Anamnese.index');


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
           $query->select('consulta_id')->from('anamnese');
        })->where('estado',0)->where('consulta.profissional_saude_id', Auth::user()->funcionario->id)->latest()->get();
       return view('Anamnese.criar',['consulta'=>$consulta]);
    }

    /**
     * Show the form for creating a new resource.
     * @param consulta $consulta
     * @return \Illuminate\Http\Response
     */
   public function criar(consulta $consulta)
    {
        # code...

         return view('Anamnese.create',['consulta'=>$consulta]);
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

            'queixa_principal' => 'required',
            'problemas_renais' => 'required',
            'problemas_resperatorios'=> 'required',
            'reumastismo' => 'required',
             'alergias' => 'required',
            'problemas_grasticos' => 'required',
            'historia' => 'required',
            'hepatite' => 'required',
            'diabetes' => 'required',


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
           'queixa_principal' =>  $request->queixa_principal,
            'problemas_renais' =>  $request->problemas_renais,
            'problemas_resperatorios'=>  $request->problemas_resperatorios,
            'reumastismo' =>  $request->reumastismo,
             'alergias' =>  $request->alergias,
            'problemas_grasticos' =>  $request->problemas_grasticos,
            'historia' =>  $request->historia,
            'hepatite' =>  $request->hepatite,
            'diabetes' =>  $request->diabetes,
                );
            $anamnese = new anamnese($dados);
            $consulta->paciente->prontuario->anamnese()->save($anamnese);


        } catch (\Exception $e) {
             DB::rollBack();

          return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' Anamnese criada com sucesso');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(anamnese $anamnese)
    {
        //
        return view('Anamnese.show',['anamnese'=>$anamnese]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(anamnese $anamnese)
    {
        //
        return view('Anamnese.update',['anamnese'=>$anamnese]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,anamnese $anamnese)
    {
        //

        $validationRules =  [

            'queixa_principal' => 'required',
            'problemas_renais' => 'required',
            'problemas_resperatorios'=> 'required',
            'reumastismo' => 'required',
             'alergias' => 'required',
            'problemas_grasticos' => 'required',
            'historia' => 'required',
            'hepatite' => 'required',
            'diabetes' => 'required',


            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
           $dados = array(
           'queixa_principal' =>  $request->queixa_principal,
            'problemas_renais' =>  $request->problemas_renais,
            'problemas_resperatorios'=>  $request->problemas_resperatorios,
            'reumastismo' =>  $request->reumastismo,
             'alergias' =>  $request->alergias,
            'problemas_grasticos' =>  $request->problemas_grasticos,
            'historia' =>  $request->historia,
            'hepatite' =>  $request->hepatite,
            'diabetes' =>  $request->diabetes,
                );

          $anamnese->update($dados);
        } catch (\Exception $e) {
             DB::rollBack();

          return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' Anamnese actualizado com sucesso');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(anamnese $anamnese)
    {
        //
        if (!$found = $anamnese->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este anamnese'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'anamnese elimindo com sucesso',

       ],200);
    }
}
