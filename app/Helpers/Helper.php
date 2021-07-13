<?php
namespace App\Helpers;

use App\Models\dados_complementar;
use App\Models\dados_familiar;
use App\Models\dados_pessoais;
use App\Models\dados_profissionais;
use App\Models\prontuario;
use Illuminate\Http\Request;

class Helper
{

    public static function dadosFamiliar(Request $request)
    {
        # code...
      return  new dados_familiar(['nome'=>$request->nome_f,
      	'telefone'=>$request->telefone_f,'idade'=>$request->idade,
         'parentesco'=>$request->parentesco,'email'=>$request->email_f]);
    }


    // retorna uma instancia da dados_pessoais
public static function dadosPessoais(Request $request)
{
    # code...
  return  new dados_pessoais(['nome'=>$request->nome, 'data_nasc'=> date('Y-m-d ', strtotime($request->data_nasc)),
    'sexo'=>$request->sexo,	'telefone'=>$request->telefone,'telefone_secundario'=>$request->telefone_secundario,
     'bi'=>$request->bi,'nacionalidade'=>$request->nacionalidade,'provincia'=>$request->provincia,
     'municipio'=>$request->municipio,'bairro'=>$request->bairro,'email'=>$request->email,]);
}


   // retorna uma instancia da dados_profissionais
public static function dadosProfissionais(Request $request)
{
    # code...
    return   dados_profissionais::create(['tipo_conselho'=>$request->tipo_conselho,'numero_registro'=>
       $request->numero_registro,'profissao'=>$request->profissao,'especialidade'=>$request->especialidade]);


      }


      public static function dadosProfissionaisUpdate(Request $request, $id)
{
    # code...
       $dados_profissionais=  dados_profissionais::find($id);
       $dados_profissionais->update(['tipo_conselho'=>$request->tipo_conselho,'numero_registro'=>
       $request->numero_registro,'profissao'=>$request->profissao,'especialidade'=>$request->especialidade]);
       return  $dados_profissionais;

      }


        // retorna uma instancia da dados_profissionais
public static function dadosComplementar(Request $request)
{
    # code...

    return   dados_complementar::create(['naturalidade'=>$request->naturalidade,'estadocivil'=>$request->estadocivil,'profissao'=>$request->profissao,'escolaridade'=>$request->escolaridade]);


      }

      public static function dadosComplementarUpdate(Request $request, $id)
      {
          # code...
          $dados_complementar = dados_complementar::find($id);
          $dados_complementar->update(['naturalidade'=>$request->naturalidade,'estadocivil'=>
          $request->estadocivil,'profissao'=>$request->profissao,'escolaridade'=>$request->escolaridade]);
           return $dados_complementar;
       }



      public static function prontuario()
      {
          # code...
         return  prontuario::create();


      }


}
