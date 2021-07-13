<?php

namespace App\Http\Controllers;

use App\Models\exame;
use App\Models\hepotise_diagnostica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExamesComplementarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            # code...
            $dados = exame::join('hepotise_diagnostica', 'hepotise_diagnostica.id', '=', 'exames.hepotise_diagnostica_id')
            ->join('prontuario', 'hepotise_diagnostica.prontuario_id', '=', 'prontuario.id')
            ->join('pacientes', 'pacientes.prontuario_id', '=', 'prontuario.id')
            ->join('users', 'users.id', '=', 'pacientes.user_id')
            ->join('dados_pessoais', 'users.id', '=', 'dados_pessoais.user_id')
            ->select('exames.*', 'dados_pessoais.nome as nomepaciente')
           ->latest()->get();

            return DataTables::of($dados)->make(true);
        }

        return view('Exames.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $hepotise = hepotise_diagnostica::whereNotIn('id',function($query){
            $query->select('hepotise_diagnostica_id')->from('exames');
         })->where('solicitar_exame',1)->get();


        return view('Exames.create',['hepotise'=>$hepotise]);
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
            'paciente' => 'required',
            'nome_exame' => 'required|min:4,max:100',
            'material_analizado'=> 'required|min:6,max:255',
            'finalidade' => 'required|min:6,max:100',
            'valor_normais_descricao' => 'required|min:4,max:100',
            'valor_arormaais_segnifica'=> 'required|min:6,max:255',
            'nivel_confiablidade' => 'required|min:1,max:6',
            'preparacao_previa' => 'required|min:6,max:100',
            'prazo_resultado' => 'required|digits_between:1,3',
            'descricao_exame' => 'required',
            ];

            $validator = Validator::make($request->all(),$validationRules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            try {
                 $hepotise =    hepotise_diagnostica::find($request->paciente);
            $dados=    array(
           'nome_exame' => $request->nome_exame,
            'material_analizado'=> $request->material_analizado,
            'finalidade' => $request->finalidade,
            'valor_normais_descricao' => $request->valor_normais_descricao,
            'valor_arormaais_segnifica'=> $request->valor_arormaais_segnifica,
            'nivel_confiablidade' => $request->nivel_confiablidade,
            'prazo_resultado' => $request->prazo_resultado,
            'descricao_exame' => $request->descricao_exame,
            'preparacao_previa' => $request->preparacao_previa,

                    );

              $exame = new exame($dados);
              $hepotise->exames()->save($exame);


            } catch (\Exception $e) {
                 DB::rollBack();
                 dd( $e->getMessage());
              //return redirect()->back()->with('sweet-error', $e->getMessage());

            }

            DB::commit();
            return redirect()->back()->with('sweet-success', 'exames cadastrado com sucesso');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(exame $exame)
    {
        //
     return view('Exames.show',['exame'=>$exame]);
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
        $exame = exame::find($id);
        return view('Exames.update',['exame'=>$exame]);
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


        $validationRules =  [
            'nome_exame' => 'required|min:4,max:100',
            'material_analizado'=> 'required|min:6,max:255',
            'finalidade' => 'required|min:6,max:100',
            'valor_normais_descricao' => 'required|min:4,max:100',
            'valor_arormaais_segnifica'=> 'required|min:6,max:255',
            'nivel_confiablidade' => 'required|min:6,max:100',
            'preparacao_previa' => 'required|min:6,max:100',
            'prazo_resultado' => 'required|digits_between:1,3',
            'descricao_exame' => 'required',
            ];

            $validator = Validator::make($request->all(),$validationRules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();
            try {
                 $exame =    exame::find($id);
            $dados=    array(
           'nome_exame' => $request->nome_exame,
            'material_analizado'=> $request->material_analizado,
            'finalidade' => $request->finalidade,
            'valor_normais_descricao' => $request->valor_normais_descricao,
            'valor_arormaais_segnifica'=> $request->valor_arormaais_segnifica,
            'nivel_confiablidade' => $request->nivel_confiablidade,
            'prazo_resultado' => $request->prazo_resultado,
            'descricao_exame' => $request->descricao_exame,
            'preparacao_previa' => $request->preparacao_previa,
                    );

              $exame->update($dados);


            } catch (\Exception $e) {
                 DB::rollBack();

              return redirect()->back()->with('sweet-error', $e->getMessage());

            }

            DB::commit();
            return redirect()->back()->with('sweet-success', 'exames actualiado com sucesso');




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

        $exame = exame::find($id);
        if (!$found = $exame->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este exames '],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'exame elimindo com sucesso',

       ],200);
    }

}
