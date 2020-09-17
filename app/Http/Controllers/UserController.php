<?php

namespace App\Http\Controllers;

use App\BloodGroup;
use App\IdentificationType;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($buscar = null)
    {
        if (!empty($buscar)) {
            $users = User::where('nick', 'LIKE', '%'.$buscar.'%')
                            ->orWhere('name', 'LIKE', '%'.$buscar.'%')
                            ->orWhere('surname', 'LIKE', '%'.$buscar.'%')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
        } else {
            $users = User::orderBy('id', 'DESC')->paginate(10);
        }

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function contrasena()
    {
        return view('user.contrasena');
    }

    public function perfil()
    {
        $listIdentificationTypes = IdentificationType::all();
        $listBloodGroups = BloodGroup::all();
        return view('user.perfil', [
            'listIdentificationTypes' => $listIdentificationTypes,
            'listBloodGroups' => $listBloodGroups,
        ]);
    }

    public function crear()
    {
        if (Auth::user()->roles->isadmin) {
            $listIdentificationTypes = IdentificationType::all();
            $listBloodGroups = BloodGroup::all();
            $roles = Role::all();

            return view('user.crear', [
                'listIdentificationTypes' => $listIdentificationTypes,
                'listBloodGroups' => $listBloodGroups,
                'roles' => $roles,
            ]);
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }
    }

    public function cambiar(Request $request)
    {
        //Conseguir el usuario autenticado
        $user = \Auth::user();
        $id = $user->id;

        //validar los campos
        $validate = $this->validate($request, [
            'password' => 'required|string|min:10|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$/',
        ]);

        //Recoger los datos del formulario
        $password = $request->input('password');

        //Asignar los nuevos valores
        $user->password = Hash::make($password);

        //Ejecutar consulta y actualizar en la base de datos
        $user->update();

        toastr()->success("Contraseña actualizada correctamente.", 'Contraseña - Club RS200', ['timeOut' => 5000]);

        return redirect()->route('home');
    }

    public function create(Request $request)
    {
        if (Auth::user()->roles->isadmin) {
            //Conseguir el usuario autenticado
            $user = new User;

            //validar los campos
            $validate = $this->validate($request, [
                'identification' => 'required|string|max:15|unique:users',
                'name' => 'required|string|max:200',
                'surname' => 'required|string|max:200',
                'nick' => 'required|string|max:100|unique:users',
                'email' => 'required|string|email|max:250|unique:users',
                'defaultmotorbike' => 'required|string|max:15|unique:users',
                'bloodgroup_id' => 'max:5',
                'mobilenumber' => 'max:15',
                'emergencycontactname' => 'max:400',
                'emergencycontactnumber' => 'max:15',
            ]);

            //Recoger los datos del formulario
            $rol = $request->input('rol_id');
            $identificationtype_id = $request->input('identificationtype_id');
            $identification = $request->input('identification');
            $name = $request->input('name');
            $surname = $request->input('surname');
            $nick = $request->input('nick');
            $email = $request->input('email');
            $defaultmotorbike = $request->input('defaultmotorbike');
            $bloodgroup_id = $request->input('bloodgroup_id');
            $mobilenumber = $request->input('mobilenumber');
            $emergencycontactname = $request->input('emergencycontactname');
            $emergencycontactnumber = $request->input('emergencycontactnumber');
            $isorgandonor = $request->input('isorgandonor');
            $birthday = $request->input('birthday');

            //Asignar los nuevos valores
            $user->rol_id = $request->input('rol_id');
            $user->identificationtype_id = $identificationtype_id;
            $user->identification = $identification;
            $user->name = $name;
            $user->surname = $surname;
            $user->nick = $nick;
            $user->email = $email;
            $user->defaultmotorbike = $defaultmotorbike;
            $user->bloodgroup_id = $bloodgroup_id;
            $user->mobilenumber = $mobilenumber;
            $user->emergencycontactname = $emergencycontactname;
            $user->emergencycontactnumber = $emergencycontactnumber;
            $user->isorgandonor = isset($isactive);
            $user->birthday = $birthday;
            $user->password = Hash::make('Club-RS200');
            $user->isactive = true;
            $user->creationuser = Auth::user()->nick;
            $user->modificationuser = Auth::user()->nick;

            //Subir la imagen
            $image_path = $request->file('image_path');
            if (isset($image_path) && is_object($image_path)) {
                //Asignar un nombre único
                $image_path_name = time() . $image_path->getClientOriginalName();

                //Guardar en la carpeta storage (storage/app/users)
                Storage::disk('users')->put($image_path_name, File::get($image_path));

                //Seteo el nombre de la imagen en el objecto
                $user->image = $image_path_name;
            }

            //Ejecutar consulta y actualizar en la base de datos
            $user->save();

            toastr()->success("Creado correctamente.", 'Crear - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('pilotos.index');
        } else {
            toastr()->error("Acceso permitido solo para los administradores o lideres.", 'Acceso - Club RS200', ['timeOut' => 5000]);
            return redirect()->route('home');
        }

    }

    public function update(Request $request)
    {
        //Conseguir el usuario autenticado
        $user = \Auth::user();
        $id = $user->id;

        //validar los campos
        $validate = $this->validate($request, [
            'identification' => 'required|string|max:15|unique:users,identification,' . $id,
            'name' => 'required|string|max:200',
            'surname' => 'required|string|max:200',
            'nick' => 'required|string|max:100|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'defaultmotorbike' => 'required|string|max:15|unique:users,defaultmotorbike,' . $id,
            'bloodgroup_id' => 'max:5',
            'mobilenumber' => 'max:15',
            'emergencycontactname' => 'max:400',
            'emergencycontactnumber' => 'max:15',
        ]);

        // var_dump($request);
        // die();

        //Recoger los datos del formulario
        $identificationtype_id = $request->input('identificationtype_id');
        $identification = $request->input('identification');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $defaultmotorbike = $request->input('defaultmotorbike');
        $bloodgroup_id = $request->input('bloodgroup_id');
        $mobilenumber = $request->input('mobilenumber');
        $emergencycontactname = $request->input('emergencycontactname');
        $emergencycontactnumber = $request->input('emergencycontactnumber');
        $isorgandonor = $request->input('isorgandonor');
        $birthday = $request->input('birthday');

        //Asignar los nuevos valores
        $user->identificationtype_id = $identificationtype_id;
        $user->identification = $identification;
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        $user->defaultmotorbike = $defaultmotorbike;
        $user->bloodgroup_id = $bloodgroup_id;
        $user->mobilenumber = $mobilenumber;
        $user->emergencycontactname = $emergencycontactname;
        $user->emergencycontactnumber = $emergencycontactnumber;
        $user->isorgandonor = isset($isactive);
        $user->birthday = $birthday;
        $user->modificationuser = Auth::user()->nick;

        //Subir la imagen
        $image_path = $request->file('image_path');
        if (isset($image_path) && is_object($image_path)) {
            //Asignar un nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //Seteo el nombre de la imagen en el objecto
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y actualizar en la base de datos
        $user->update();

        toastr()->success("Datos del piloto actualizado correctamente.", 'Actualización - Club RS200', ['timeOut' => 5000]);
        return redirect()->route('home');

    }

    public function getImage($filename)
    {
        //Obtnener la imagen
        $file = Storage::disk('users')->get($filename);

        //retornar la imagen
        return new Response($file, 200);
    }

    public function profile($id)
    {
        $user = User::find($id);
        // $listBloodGroups = BloodGroup::all();

        return view('user.profile', ['user' => $user]);
    }

}
