<?php

namespace App\Http\Controllers;

use App\BloodGroup;
use App\IdentificationType;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use View;

class AgreementController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($buscar = null)
    {
        if (Auth::user()->roles->isadmin || Auth::user()->roles->id==4) {
            if (!empty($buscar)) {
                $pilotos = User::Where('rol_id', '=', '4')
                    ->where(function ($query) use ($buscar) {
                        $query->Where('name', 'LIKE', '%' . $buscar . '%')
                              ->orWhere('surname', 'LIKE', '%' . $buscar . '%');})
                    ->orderBy('name', 'ASC')
                    ->paginate(5);
            } else {
                $pilotos = User::Where('rol_id', '=', '4')
                    ->orderBy('name', 'ASC')
                    ->paginate(5);
            }

            return view('agreement.index', [
                'pilotos' => $pilotos,
            ]);
        } else {
            toastr()->error("Acceso permitido solo para los administradores, lideres o convenios.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function buscarPiloto()
    {
        return view('contrasena');

        //$buscarPiloto = null
        // if (Auth::user()->roles->isadmin || Auth::user()->roles->id==4) {
        //     if (!empty($buscar)) {
        //         $pilotos = User::Where('rol_id', '=', '5')
        //             ->where(function ($query) use ($buscar) {
        //                 $query->Where('nick', 'LIKE', '%' . $buscar . '%')
        //                       ->orWhere('name', 'LIKE', '%' . $buscar . '%')
        //                       ->orWhere('surname', 'LIKE', '%' . $buscar . '%')
        //                       ->orWhere('defaultmotorbike', 'LIKE', '%' . $buscar . '%');})
        //             ->orderBy('name', 'ASC')
        //             ->paginate(10);
        //     } else {
        //         $pilotos = User::Where('rol_id', '=', '5')
        //             ->orderBy('name', 'ASC')
        //             ->paginate(10);
        //     }

        //     return view('agreement.buscar', [
        //         'pilotos' => $pilotos,
        //     ]);
        // } else {
        //     toastr()->error("Acceso permitido solo para los administradores, lideres o convenios.", 'Acceso - Club RS200', ['timeOut' => 5000]);
        //     return redirect()->route('home');
        // }
    }
}
