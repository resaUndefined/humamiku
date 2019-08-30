<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal',
        'sisa_saldo',
    ];

    public function kas_flows()
    {
        return $this->hasMany('App\Model\Kasflow');
    }
}
