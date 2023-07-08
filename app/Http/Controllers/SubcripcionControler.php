<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcripcionControler extends Controller
{
    public function subcripcion(Request $request){
        return view('subcripcion.subscripcion');
    }
}
