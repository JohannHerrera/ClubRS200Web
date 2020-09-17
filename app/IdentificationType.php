<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentificationType extends Model
{
    protected $table = 'identificationtypes';

    //Relacion One to Many -> uno a muchos    -  hasMany = Tiene muchos
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
