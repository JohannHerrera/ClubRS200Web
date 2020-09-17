<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    protected $table = 'pilots';


    //Relacion Many to One -> muchos a uno
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
