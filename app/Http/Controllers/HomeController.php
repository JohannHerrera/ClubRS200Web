<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('status') && !empty(session('status'))) {
            toastr()->info(session('status'), 'Registro - Club RS200', ['timeOut' => 5000]);
        }
        if (!\Auth::user()->isactive) {
            toastr()->error('Su usuario no ha sido habilitado, por tal rázon no se habilitará las opicones del menu.', 'Activar Acceso - Club RS200', ['timeOut' => 10000]);
        }

        if (session('message') && !empty(session('message'))) {
            toastr()->success(session('message'), 'Publicación - Club RS200', ['timeOut' => 5000]);
        }

        // Consultar las imagenes cargadadas por todos los usuarios en la apliación
        $images = Image::orderBy('id', 'DESC')->paginate(10);
        return view('home', [
            'images' => $images,
        ]);

        //toastr()->error(\Auth::user()->password, 'Password');
        //toastr()->warning('My name is Inigo Montoya. You killed my father, prepare to die!');
        //toastr()->success('Have fun storming the castle!', 'Miracle Max Says');
        //toastr()->error('I do not think that word means what you think it means.', 'Inconceivable!');
        //toastr()->success('We do have the Kapua suite available.', 'Turtle Bay Resort', ['timeOut' => 5000]);
        //toastr()->info('Are you the 6 fingered man?', '', ['timeOut' => 5000]);
        //toastr()->info('sgaggfs dgsg afgg sa', 'Registro - Club RS200', ['timeOut' => 5000]);
        //toastr()->info('Are you the 6 fingered man?')->success('Have fun storming the castle!')->warning('doritos');
    }
}
