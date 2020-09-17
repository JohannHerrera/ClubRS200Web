<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        //VAlidar los campos
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image',
        ]);

        //recoger los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asignar datos
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;
        $image->image_path = null;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();

        return redirect()->route('home')->with(['message' => 'Imagen cargada correctmente.']);
    }

    public function getImage($filename)
    {
        //Obtnener la imagen
        $file = Storage::disk('images')->get($filename);

        //retornar la imagen
        return new Response($file, 200);
    }

    public function detail($id)
    {
        if (session('message') && !empty(session('message'))) {
            toastr()->success(session('message'), 'Imagen - Club RS200', ['timeOut' => 5000]);
        }

        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image,
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->users->id == $user->id) {
            if ($comments && count($comments) >= 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            Storage::disk('images')->delete($image->image_path);

            $image->delete();

            $message = array('message' => 'La imagen se ha borrado correctamente.');
        } else {
            $message = array('message' => 'La imagen no se ha borrado.');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->users->id == $user->id) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request)
    {
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //VAlidar los campos
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image',
        ]);

        //Asignar datos
        $user = \Auth::user();
        $image = Image::find($image_id);
        $image->description = $description;
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Imagen actualizada correctmente!!']);
    }
}
