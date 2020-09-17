<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //Relacion Many to One -> muchos a uno
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function images()
    {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
