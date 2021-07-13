<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\anamnese;
use App\Models\hepotise_diagnostica;
use App\Models\prescricoes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Str;
class HistoricoController extends BaseController
{
    //

    public function consultasRealizada()
    {
        $consulta  = Auth::user()->paciente->prontuario->anamnese->all();
        return $this->sendResponse($consulta, 'certo');
    }

    public function showConsultas($id)
    {
        //
        try {
            //code...
            $anamnese = anamnese::findOrFail($id);


            return $this->sendResponse($anamnese,'certo');

        } catch (Exception $e) {
            //throw $th;
            $msg = Str::limit($e->getMessage(),27, '...');

            return $this->sendError($msg);
        }

    }


    public function examesFesicos()
    {
        $examesFisicos  = Auth::user()->paciente->prontuario->examesFisicos->all();
        return $this->sendResponse($examesFisicos, 'certo');
    }

    public function hipotiseRealizada()
    {
        $consulta  = Auth::user()->paciente->prontuario->hepotise->all();
        return $this->sendResponse($consulta, 'certo');
    }

    public function showHipotise($id)
    {
        //
        try {
            //code...
            $hepotise = hepotise_diagnostica::findOrFail($id);


            return $this->sendResponse($hepotise->exames,'certo');

        } catch (Exception $e) {
            //throw $th;
            $msg = Str::limit($e->getMessage(),27, '...');

            return $this->sendError($msg);
        }

    }

    public function prescricaoRealizada()
    {
        $prescricao  = Auth::user()->paciente->prontuario->prescricao->all();
        return $this->sendResponse($prescricao, 'certo');
    }

    public function showPrescricao($id)
    {
        //
        try {
            //code...
            $prescricao = prescricoes::findOrFail($id);


            return $this->sendResponse($prescricao->medicamentos,'certo');

        } catch (Exception $e) {
            //throw $th;
           $msg = Str::limit($e->getMessage(),27, '...');

            return $this->sendError($msg);
        }

    }


}
