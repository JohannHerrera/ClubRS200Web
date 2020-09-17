<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsuariosController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'httpStatusCode' => 200, 'message' => 'Error al validar los campos', 'data' => $validator->errors()->all()], 200);
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user(); //obtenemos el usuario logueado
            if ($user->isactive) {
                return response()->json(['status' => true, 'httpStatusCode' => 200, 'message' => 'Usuario OK.', 'data' => $user], 200);
            } else {
                return response()->json(['status' => false, 'httpStatusCode' => 401, 'message' => 'Usuario no se encuentra activo.', 'data' => null], 200);
            }
        } else {
            return response()->json(['status' => false, 'httpStatusCode' => 401, 'message' => 'Datos ingresados son incorrectos.', 'data' => null], 200);
        }
    }
}
