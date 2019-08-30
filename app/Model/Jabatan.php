<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
	protected $table = 'jabatan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jabatan',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
