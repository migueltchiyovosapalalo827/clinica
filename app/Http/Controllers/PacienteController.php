<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\dados_complementar;
use App\Models\dados_familiar;
use App\Models\dados_pessoais;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Str;
class PacienteController extends Controller
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
            $data = User::with('dadosPessoais')->where('tipo','paciente')->latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('paciente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('paciente.create');
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
            'name' => 'required|max:255',
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'data_nasc'=>'required',
            'nacionalidade'=>'required',
            'telefone'=>'required|min:9|max:16',
            'telefone_secundario'=>'required|min:9|max:16',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'sexo'=>'required',
            'bi'=>'required',
            'nome_f'=>'required|max:30',
            'email_f' => 'required|email|max:255',
            'telefone_f'=>'required|max:16',
            'parentesco'=>'required|min:3',
            'idade'=>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('sweet-error',"Ops...há algo de errado! Verifique se os campos obrigatórios foram inseridos corretamente." );
        }
        $uid = hexdec(uniqid());
        $matriculaFull = $uid;

        $matricula=Str::limit($matriculaFull,30);
        $matriculaNova=substr_replace($matricula, '', 0,-10);
        $matriculaFinal=substr_replace($matriculaNova,'',6);
        $nome_arquivo="default.jpg";

        DB::beginTransaction();
        try {


             $user= User::create([
                'tipo'   => 'paciente',
                'matricula' => $matriculaFinal,
                'foto' =>$nome_arquivo,
                'email'    => $request->email,
                'name' => $request->name,
                'password' =>Hash::make($request->password)
                ]);
              $complementar =  Helper::dadosComplementar($request);

             $user->dadosPessoais()->save(Helper::dadosPessoais($request));
             $user->paciente()->create(['prontuario_id'=>Helper::prontuario()->id,
                                         'dados_complementares_id'=>$complementar->id,
            ]);
            $complementar->dadosFamiliares()->save(Helper::dadosFamiliar($request));


        } catch (\Exception $e) {
           DB::rollBack();

         // return dd($e->getMessage());
        return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        DB::Commit();
        return redirect()->back()->with('sweet-success', 'usuarios criado com sucesso');
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
        $user = User::find($id);



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
         $user = User::find($id);
         $dadoscomplementar = $user->paciente->dados_complementar ??  new dados_complementar();
         $dadosPessoais = $user->dadosPessoais()->first() ??  new dados_pessoais() ;
         $dadosFamiliares =$dadoscomplementar->dadosFamiliares()->first() ??  new dados_familiar();
         return view("paciente.update", compact('dadoscomplementar','dadosPessoais','user','dadosFamiliares'));

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
            'name' => 'required|max:255',
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255',
            'data_nasc'=>'required',
            'nacionalidade'=>'required',
            'telefone'=>'required|min:9|max:12',
            'telefone_secundario'=>'required|min:9|max:12',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'sexo'=>'required',
            'bi'=>'required',
            'nome_f'=>'required|max:30',
            'email_f' => 'required|email|max:255',
            'telefone_f'=>'required',
            'parentesco'=>'required|min:3',
            'idade'=>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('sweet-error',"Ops...há algo de errado! Verifique se os campos obrigatórios foram inseridos corretamente." );
        }
        $uid = hexdec(uniqid());
        $matriculaFull = $uid;

        $matricula=Str::limit($matriculaFull,30);
        $matriculaNova=substr_replace($matricula, '', 0,-10);
        $matriculaFinal=substr_replace($matriculaNova,'',6);
        $nome_arquivo="default.jpg";

        DB::beginTransaction();
        try {

            $user = User::find($id);
              $user->save([
                'tipo'   => 'paciente',
                'matricula' => $matriculaFinal,
                'foto' =>$nome_arquivo,
                'email'    => $request->email,
                'name' => $request->name,
                ]);

           if (is_null($user->paciente)) {
            $complementar =  Helper::dadosComplementar($request);

            $user->dadosPessoais()->save(Helper::dadosPessoais($request));
            $user->paciente()->create(['prontuario_id'=>Helper::prontuario()->id,
                                        'dados_complementares_id'=>$complementar->id,
           ]);
           $complementar->dadosFamiliares()->save(Helper::dadosFamiliar($request));
           } else {
               # code...

               $complementar =  Helper::dadosComplementarUpdate($request,$user->paciente->dados_complementar->id);
               $user->dadosPessoais()->update(['nome'=>$request->nome, 'data_nasc'=> date('Y-m-d ', strtotime($request->data_nasc)),
               'sexo'=>$request->sexo,	'telefone'=>$request->telefone,'telefone_secundario'=>$request->telefone_secundario,
                'bi'=>$request->bi,'nacionalidade'=>$request->nacionalidade,'provincia'=>$request->provincia,
                'municipio'=>$request->municipio,'bairro'=>$request->bairro]);

               $complementar->dadosFamiliares()->update(['nome'=>$request->nome_f,
               'telefone'=>$request->telefone_f,'idade'=>$request->idade,
              'parentesco'=>$request->parentesco,'email'=>$request->email_f]);
           }




        } catch (\Exception $e) {
           DB::rollBack();
          dd($e->getMessage());
         // return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        DB::Commit();
        return redirect()->back()->with('sweet-success', 'os dados do pacientes foram actaulizados com sucesso');
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
        DB::beginTransaction();
        $paciente = Paciente::where('user_id',$id)->first();
        if ($paciente) {
            # code...
            $paciente->delete();
            $found = User::find($id)->delete();
            DB::commit();
            return response(['success'=>true,
            'data'=>$found,
            'message'=>'usuario elimindo com sucesso',

           ],200);
        } elseif ( $found = User::find($id)->delete()) {
            # code...
            DB::commit();
            return response(['success'=>true,
            'data'=>$found,
            'message'=>'usuario elimindo com sucesso',
           ],200);
        }else {
            DB::rollBack();
        return response(['success'=>false,
        'message'=>'não foi possivel eliminar este usuario'],422);
        }
    }
}
