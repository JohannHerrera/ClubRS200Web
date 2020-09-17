<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificationtype_id',
        'identification',
        'name',
        'surname',
        'nick',
        'email',
        'defaultmotorbike',
        'image',
        'isactive',
        'password',
        'bloodgroup_id',
        'mobilenumber',
        'emergencycontactname',
        'emergencycontactnumber',
        'isorgandonor',
        'birthday',
        'creationuser',
        'modificationuser',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // //Relacion One to Many -> uno a muchos    -  hasMany = Tiene muchos
    // public function images()
    // {
    //     return $this->hasMany('App\Image');
    // }

    //Relacion Many to One -> muchos a uno
    public function identificationTypes()
    {
        return $this->belongsTo('App\IdentificationType', 'identificationtype_id');
    }

    //Relacion Many to One -> muchos a uno
    public function roles()
    {
        return $this->belongsTo('App\Role', 'rol_id');
    }

    //Relacion Many to One -> muchos a uno
    public function bloodGroups()
    {
        return $this->belongsTo('App\BloodGroup', 'bloodgroup_id');
    }

    //Relacion One to Many -> uno a muchos
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
