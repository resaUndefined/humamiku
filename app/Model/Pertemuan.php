<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = 'pertemuan';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tempat',
        'tanggal',
        'total_iuran',
        'notulen',
    ];

    public function iurans()
    {
        return $this->hasMany('App\Model\Iuran');
    }
}
