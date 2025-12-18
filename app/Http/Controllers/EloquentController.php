<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matriculas;

class EloquentController extends Controller
{
    public function index() {

        $Matricula = Matriculas::select('*')
        ->where('estado_matricula', 'Activo')     
        ->get()
        
        ;
        dd($Matricula);
    }
}
