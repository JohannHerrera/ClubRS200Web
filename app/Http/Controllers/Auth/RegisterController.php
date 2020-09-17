<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Softon\SweetAlert\Facades\SWAL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'identification' => 'required|string|max:15|unique:users',
            'name' => 'required|string|max:200',
            'surname' => 'required|string|max:200',
            'nick' => 'required|string|max:100|unique:users',
            'email' => 'required|string|email|max:250|unique:users',
            'defaultmotorbike' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:10|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,}$/',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $creado = User::create([
            'rol_id' => '1',
            'identificationtype_id' => 1,
            'identification' => $data['identification'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'nick' => $data['nick'],
            'email' => $data['email'],
            'defaultmotorbike' => strtoupper($data['defaultmotorbike']),
            'password' => Hash::make($data['password']),
            'image' => 'default.png',
            'isactive' => false,
            'bloodgroup_id' => null,
            'mobilenumber' => '',
            'emergencycontactname' => '',
            'emergencycontactnumber' => '',
            'isorgandonor' => false,
            'birthday' => null,
            'creationuser' => 'Registro Portal',
            'modificationuser'  => 'Registro Portal'
        ]);

        //SWAL::message('Good Job','You have successfully logged In!','success',['timer'=>5000]);
        //swal()->autoclose(2000)->message('Good Job','You have successfully logged In!','info');

        session(['status' => 'Registrado correctamente. Solo falta el proceso de activación, comuniquese con el administrador del portal o líder del club.']);

        return $creado;
    }
}
