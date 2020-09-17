<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Relacion One to Many -> uno a muchos
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'DESC');
    }

     //Relacion One to Many -> uno a muchos    -  hasMany = Tiene muchos
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    //Relacion Many to One -> muchos a uno
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
