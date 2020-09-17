<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    //Se utiliza para validar el ingreso a las pagina a los usuarios autrenticados.
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        //validar los campos
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required',
        ]);

        $user_id = \Auth::user()->id;
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Has publicado tu comentario correctmente!!']);
    }

    public function delete($id)
    {
        $user = \Auth::user();
        $comment = Comment::find($id);
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->images->id])->with(['message' => 'Comentario eliminado correctmente!!']);
        } else {
            return redirect()->route('image.detail', ['id' => $comment->images->id])->with(['message' => 'EL COMENTARIO NO SE HA ELIMINADO!!']);
        }
    }
}
