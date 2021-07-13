<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\dados_pessoais;
use App\Models\dados_profissionais;
use App\Models\profissional_saude;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Support\Str;
class UserController extends Controller
{

   // Use  Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $users;


     public function __construct(User $user)
     {
         $this->users = new $user();
     }

    public function index(Request $request)
    {
        //

        if ($request->ajax()) {
            $data = User::where('tipo','<>', 'paciente')->latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('User.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = [['nome'=>'Administrador'],['nome'=>'secretario(a)'],
        ['nome'=>'Medico'],['nome'=>'enfirmeiro(a)'],['nome'=>'tecnico de Laboratorio']
    ];

        return view('User.create',[

            'permissions' => $permissions,

        ]);
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
            'telefone'=>'required|min:9|max:12',
            'telefone_secundario'=>'required|min:9|max:12',
            'tipo'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'sexo'=>'required',
            'bi'=>'required',
            'tipo_conselho'=>'required',
            'municipio'=>'required',
            'numero_registro'=>'required',
            'profissao'=>'required',
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
                'tipo'   => $request->tipo,
                'matricula' => $matriculaFinal,
                'foto' =>$nome_arquivo,
                'email'    => $request->email,
                'name' => $request->name,
                'password' =>Hash::make($request->password)
                ]);

             $user->dadosPessoais()->save(Helper::dadosPessoais($request));
             $user->funcionario()->create(['dados_profissionais_id'=>Helper::dadosProfissionais($request)->id]);



        } catch (\Exception $e) {
           DB::rollBack();
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
    public function show(User $user)
    {
        //
        return  view('User.profile',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $funcionario = $user->funcionario()->first();

        //dd($funcionario->dados_profissionais_id);
        $dadosProfissionais = $funcionario ?  dados_profissionais::find($funcionario->dados_profissionais_id)  : new dados_profissionais();
        $dadosPessoais = $user->dadosPessoais()->first() ? $user->dadosPessoais()->first() : new dados_pessoais() ;
        $permissions =['admintrador','Medico','enfirmeiro','Tecnico de Laboratorio'];
        return view("User.update",['dadosProfissionais'=>$dadosProfissionais,'dadosPessoais'=>$dadosPessoais,
        'user'=>$user,'permissions'=> $permissions]);
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
            'tipo'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'sexo'=>'required',
            'bi'=>'required',
            'tipo_conselho'=>'required',
            'municipio'=>'required',
            'numero_registro'=>'required',
            'profissao'=>'required',
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


                 $user= User::find($id);
                 $user->save([
                    'tipo'   => $request->tipo,
                    'matricula' => $matriculaFinal,
                    'foto' =>$nome_arquivo,
                    'email'    => $request->email,
                    'name' => $request->name,
                    'password' =>Hash::make($request->password)
                    ]);

                 //$user->funcionario()->create(['dados_profissionais_id'=>Helper::dadosProfissionais($request)->id]);

                 if (is_null($user->funcionario)) {
                   # code...
                   $user->dadosPessoais()->save(Helper::dadosPessoais($request));
                   $user->funcionario()->create(['dados_profissionais_id'=>Helper::dadosProfissionais($request)->id]);

               } else {
                   # code...
                   $user->dadosPessoais()->update(['nome'=>$request->nome, 'data_nasc'=> date('Y-m-d ', strtotime($request->data_nasc)),
                   'sexo'=>$request->sexo,	'telefone'=>$request->telefone,'telefone_secundario'=>$request->telefone_secundario,
                    'bi'=>$request->bi,'nacionalidade'=>$request->nacionalidade,'provincia'=>$request->provincia,
                    'municipio'=>$request->municipio,'bairro'=>$request->bairro]);
                   Helper::dadosProfissionaisUpdate($request, $user->funcionario->dados_profissionais_id);
               }


            } catch (\Exception $e) {
               DB::rollBack();
                dd($e->getMessage());
              // return redirect()->back()->with('sweet-error', );
            }

            DB::Commit();
            return redirect()->back()->with('sweet-success', 'os dados do funcionario foram actualzadas com sucesso');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        DB::beginTransaction();
        $funcionarioId = profissional_saude::where('user_id',$user->id)->first()->dados_profissionais_id;
       if ( dados_profissionais::find($funcionarioId)->delete()) {
           # code...
           $found = $user->delete();
           DB::Commit();
           return response(['success'=>true,
           'data'=>$found,
           'message'=>'usuario elimindo com sucesso',

          ],200);
       }else{
        DB::rollBack();
        return response(['success'=>false,
        'message'=>'não foi possivel eliminar este usuario'],422);

       }



    }
}
