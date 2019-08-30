<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $table = 'iuran';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pertemuan_id',
        'user_id',
        'iuran',
        'hadir',
    ];

    public function pertemuan()
    {
        return $this->belongsTo('App\Model\Pertemuan');
    }


    public function user()
    {
        return $this->hasOne('App\User');
    }
}
