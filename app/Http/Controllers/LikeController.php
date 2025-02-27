<?php

namespace App\Http\Controllers;

use App\Like;
use view;

class LikeController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();

        $likes = Like::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(5);


        if ($likes->count() == 0) {
            toastr()->error("No tiene publicaciones marcada como favoritas.", 'Publicaciones - Club RS200', ['timeOut' => 5000]);
        }

        return view('likes.index', [
            'likes' => $likes,
        ]);
    }

    public function like($image_id)
    {
        $user = \Auth::user();
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = $image_id;
            $like->save();

            return response()->json([
                'like' => $like,
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe',
            ]);
        }
    }

    public function dislike($image_id)
    {
        $user = \Auth::user();
        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();

        if ($like) {
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike correctamente.',
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe',
            ]);
        }
    }
}
