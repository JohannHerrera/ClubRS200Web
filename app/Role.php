<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    //Relacion One to Many -> uno a muchos    -  hasMany = Tiene muchos
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
