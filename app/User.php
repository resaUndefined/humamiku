<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'role_id', 
        'jabatan_id', 
        'password',
        'jk',
        'ttl',
        'is_active',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Model\Jabatan');
    }


    public function iuran()
    {
        return $this->hasOne('App\Model\Iuran');
    }
}
