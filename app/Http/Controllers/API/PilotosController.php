<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class PilotosController extends Controller
{

    //Todos los pilotos
    public function index()
    {
        return User::all();
    }

    //Detalle de un piloto
    public function show($id)
    {
        return User::where('id', $id)->get();
    }
}
