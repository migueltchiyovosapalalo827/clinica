<?php

namespace App\Http\Controllers;

use App\Models\consulta;
use App\Models\Paciente;
use App\Models\profissional_saude;
use App\Models\prontuario;
use App\Models\servicos_medicos;
use App\Models\User;
use App\Notifications\AgendaConfirmada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
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
            $data = DB::table('consulta')->join('pacientes', 'pacientes.id', '=', 'consulta.paciente_id')
        ->join('servicos_medicos', 'servicos_medicos.id', '=', 'consulta.servicos_medicos_id')
        ->join('users', 'users.id', '=', 'pacientes.user_id')
        ->select('consulta.*', 'servicos_medicos.nome  as nomeespecialidade', 'users.name  as nomepaciente')
         ->latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('Agenda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // $paciente = prontuario::all();
        $paciente = User::where('tipo','paciente')->latest()->get();
        $medico = User::where('tipo','medico')->latest()->get();
        $especialidades = servicos_medicos::latest()->get();

        return view('Agenda.create',['pacientes'=>$paciente,'medicos'=>$medico,'especialidades'=>$especialidades]);
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

            'paciente'   => 'required',
            'medico'      => 'required',
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
            $medico = User::find($request->medico)->funcionario()->first();
            $paciente = User::find($request->paciente)->paciente()->first();
        $dados=    array(
                "paciente_id" => $paciente->id,
                "profissional_saude_id" =>   $medico->id ,
                "descricao" => $request->descricao,
                "servicos_medicos_id" =>    $request->especialidade,
                "estado"     =>    $request->estado,
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
       $consulta = consulta::find($id);
       return view('Agenda.show',['consulta'=>$consulta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consulta = consulta::find($id);
        $medico = User::where('tipo','medico')->latest()->get();
        $especialidades = servicos_medicos::latest()->get();
         return view('Agenda.update',['agenda'=>$consulta,
         'medicos'=>$medico,'especialidades'=>$especialidades]);
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

            'paciente'   => 'required',
            'medico'      => 'required',
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

            $consulta = consulta::find($id);
            $data = date('Y-m-d ',strtotime($request->data));
            $hora = date('H:i:s',strtotime($request->hora));
            $medico = User::find($request->medico)->funcionario()->first();
          $dados=    array(
                "paciente_id" => $request->paciente,
                "profissional_saude_id" =>   $medico->id ,
                "descricao" => $request->descricao,
                "servicos_medicos_id" =>    $request->especialidade,
                "estado"     =>    $request->estado,
                "data_atendimento" => $data,
                "inicio_atendimento" => $hora,
                );
              $consulta->update($dados);

              if ( $request->estado==0) {
                $user = Paciente::find($request->paciente)->user()->first();
                $user->notify(new AgendaConfirmada);
            }
        } catch (\Exception $e) {
             DB::rollBack();
            dd($e->getMessage());
             //return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', ' A consulta foi actualizada com sucesso');

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

        $consulta = consulta::find($id)->first();
        if (!$found = $consulta->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este agendamento'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'agendamento elimindo com sucesso',

       ],200);
    }


    public function AgendaMedico(Request $request)
    {
        # code...
             //
      if ($request->ajax()) {
        $data = DB::table('consulta')->join('pacientes', 'pacientes.id', '=', 'consulta.paciente_id')
    ->join('users', 'users.id', '=', 'pacientes.user_id')
    ->join('servicos_medicos', 'servicos_medicos.id', '=', 'consulta.servicos_medicos_id')
    ->where('consulta.profissional_saude_id', Auth::user()->funcionario->id)
    ->select('consulta.*', 'servicos_medicos.nome  as nomeespecialidade', 'users.name  as nomepaciente')
     ->latest()->get();
        return  Datatables::of($data)->make(true);
    }
     return view('Agenda.medico');


    }
}
