<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
    protected $fillable = [
        'nom',
        'descripcio',
        'tipus',
        'imatge',
        'cotxe_id',
    ];

    public function cotxe()
    {
        return $this->belongsTo(Cotxe::class);
    }
}