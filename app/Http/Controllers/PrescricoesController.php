<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Models\prescricoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;
class PrescricoesController extends Controller
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
       $dados = prescricoes::join(
        'prontuario', 'prescricoes.prontuario_id', '=', 'prontuario.id')->join(
        'pacientes', 'pacientes.prontuario_id', '=', 'prontuario.id')
        ->join('users', 'users.id', '=', 'pacientes.user_id')
        ->join('dados_pessoais', 'users.id', '=', 'dados_pessoais.user_id')
        ->select('prescricoes.*', 'dados_pessoais.nome as nomepaciente')
        ->latest()->get();
            return DataTables::of($dados)->make(true);
        }
        return view('prescricao.index');

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
            $query->select('consulta_id')->from('prescricoes');
         })->where('estado',0)->where('consulta.profissional_saude_id', Auth::user()->funcionario->id)->latest()->get();

        return view('prescricao.create',['consulta'=>$consulta]);
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
            'obs' => 'required|min:10|max:255',
            'paciente'=>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $consulta = consulta::find($request->paciente);
            $dados =   new prescricoes(array('consulta_id'=>$request->paciente, 'descricao'=> $request->obs));
            $prescricao =  $consulta->paciente->prontuario->prescricao()->save($dados);


            $linha_medicamentos    = array();

            $medicamentos         = $request->medicamento;
            $posologia              = $request->posologia;
            $valor            =    $request->valor;
            $unidade            =    $request->unidade;
            $apresentacao            =    $request->apresentacao;

            $number_of_entries          = sizeof($medicamentos);

            for ($i = 0; $i < $number_of_entries; $i++)
            {
            if ($medicamentos[$i] != "" && $posologia[$i] )
           {
           $new_entry     = array('nome' => $medicamentos[$i], 'posologia' => $posologia[$i],
           'valor' => $valor[$i],'unidade'=>$unidade[$i],'apresentacao'=>$apresentacao[$i] );
         array_push($linha_medicamentos, $new_entry);
          }
            }


            foreach($linha_medicamentos as $linha)
            {
                $prescricao->medicamentos()->create([
                'nome_medicamento'=>$linha['nome'],'apresentacao'=>$linha['apresentacao'],
                'unidade'=>$linha['unidade'],'valor'=>$linha['valor'],'posologia'=>$linha['posologia']
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }
        DB::commit();

        return redirect()->back()->with('sweet-success', 'o serviço foi salvo com sucesso.');

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

        $prescricao = prescricoes::find($id);
        return view('prescricao.show', compact('prescricao'));


    }




      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createPdf($id)
    {
        //

      //  $data = Employee::all();
    /*  $prescricao = prescricoes::find($id);
     $medicamentos = $prescricao->medicamentos;
        // share data to view
        view()->share('prescricao.pdf',compact('medicamentos'));
        $pdf = PDF::loadView('prescricao.pdf', compact('medicamentos'));

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');*/

    }

    public function print($id)
    {
        //

        $prescricao = prescricoes::find($id);
        return view('prescricao.print', compact('prescricao'));


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
        $prescricao = prescricoes::find($id);
        if (!$found = $prescricao->delete())
        {

                return response(['success'=>false,
                'message'=>'a prescricão não encontrado ou já foi excluído.'],422);

            }

            return response(['success'=>true,
            'data'=>$found,
            'message'=>'a prescricão foi excluído corretamente.',

           ],200);


    }
}
