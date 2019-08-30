<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kasflow extends Model
{
    protected $table = 'kasflow';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kas_id',
        'tanggal',
        'status',
        'nominal',
        'nominal',
        'keterangan',
    ];

    public function kas()
    {
        return $this->belongsTo('App\Model\Kas');
    }
}
