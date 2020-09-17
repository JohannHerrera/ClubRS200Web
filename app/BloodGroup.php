<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    protected $table = 'bloodgroups';

    //Relacion One to Many -> uno a muchos    -  hasMany = Tiene muchos
    public function users()
    {
        return $this->hasMany('App\User', 'user_id');
    }
}
