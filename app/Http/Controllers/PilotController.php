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

class PilotController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($buscar = null)
    {
        if (Auth::user()->roles->isadmin) {
            if (!empty($buscar)) {
                $pilotos = User::Where('rol_id', ['5', '3', '1'])
                    ->where(function ($query) use ($buscar) {
                        $query->Where('nick', 'LIKE', '%' . $buscar . '%')
                            ->orWhere('name', 'LIKE', '%' . $buscar . '%')
                            ->orWhere('surname', 'LIKE', '%' . $buscar . '%')
                            ->orWhere('defaultmotorbike', 'LIKE', '%' . $buscar . '%');})
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            } else {
                $pilotos = User::Where('rol_id', ['5', '3', '1'])
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            }

            return view('pilots.index', [
                'pilotos' => $pilotos,
            ]);
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function perfil($id)
    {
        if (Auth::user()->roles->isadmin) {
            $user = User::find($id);
            $roles = Role::all();
            $listBloodGroups = BloodGroup::all();
            $listIdentificationTypes = IdentificationType::all();

            if ($user) {
                return view('pilots.cambiarperfil', [
                    'user' => $user,
                    'roles' => $roles,
                    'listBloodGroups' => $listBloodGroups,
                    'listIdentificationTypes' => $listIdentificationTypes]
                );
            }
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function eliminar($id)
    {
        if (Auth::user()->roles->isadmin) {
            $user = User::find($id);
            if ($user) {
                return view('pilots.destroy', ['user' => $user]);
            }
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function cambiarperfil(Request $request)
    {
        if (Auth::user()->roles->isadmin) {
            $id = $request->input('id');
            $rol = $request->input('rol_id');
            $isactive = $request->input('isactive');

            $user = User::find($id);
            if ($user) {
                $user->rol_id = $rol;
                $user->isactive = isset($isactive);
                $user->modificationuser = Auth::user()->nick;

                //Ejecutar consulta y actualizar en la base de datos
                $user->update();
                toastr()->success("Cambio de pérfil realizado correctamente.", 'Pérfil - Club RS200', ['timeOut' => 5000]);
            }
            return redirect()->route('pilotos.index');
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->roles->isadmin) {
            $user = User::find($id);

            if ($user) {
                $piloto = $user->name . ' ' . $user->surname;
                if (isset($user->image) && $user->image !== 'default.png');
                {
                    Storage::disk('users')->delete($user->image);
                }
                $user->delete();
                toastr()->info("Piloto: $piloto, eliminado correctamente.", 'Eliminado - Club RS200', ['timeOut' => 5000]);
            } else {
                toastr()->error("No se pudo eliminar el piloto.", 'Eliminar - Club RS200', ['timeOut' => 5000]);
            }
            return redirect()->route('pilotos.index');
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }
}
