<?php

namespace App\Http\Controllers;

use App\Models\servicos_medicos;
use Illuminate\Http\Request;

class Home extends Controller
{
    //


    public function index()
    {
        $especialidade =  servicos_medicos::all();
        return view('welcome1', compact('especialidade'));
    }

    public function contactos()
    {
        # code...

        return view('contact');
    }
}
