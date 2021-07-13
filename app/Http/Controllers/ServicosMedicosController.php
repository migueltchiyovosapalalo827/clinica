<?php

namespace App\Http\Controllers;

use App\Models\servicos_medicos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServicosMedicosController extends Controller
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
            $data = servicos_medicos::latest()->get();
            return  DataTables::of($data)->make(true);
        }
        return view('servicos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("servicos.create");
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $dados = array('nome'=>$request->nome, 'descricao'=> $request->descricao);

            servicos_medicos::create($dados);


        } catch (\Exception $e) {
            $this->db->transRollback();
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
    public function show(servicos_medicos $servico)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(servicos_medicos $servico)
    {
        //

        return view('servicos.update',['servico'=>$servico]);
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
            'nome' => 'required|min:6|max:255',
            'descricao' => 'required|min:10|max:255',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $dados = array('nome'=>$request->nome, 'descricao'=> $request->descricao);
            $servico = servicos_medicos::find($id);
            $servico->save($dados);

           DB::commit();
        } catch (\Exception $e) {
            $this->db->transRollback();
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'o serviço foi actaulizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(servicos_medicos $servico)
    {
        //

          //

          if (!$found = $servico->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este servico'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'servço elimindo com sucesso',

       ],200);
    }
}
