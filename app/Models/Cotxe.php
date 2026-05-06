<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Comentari;
use App\Models\Mod;

class Cotxe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model',
        'any',
        'descripcio',
        'imatge_principal',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comentaris()
    {
        return $this->hasMany(Comentari::class);
    }

    public function mods()
    {
        return $this->hasMany(Mod::class);
    }
}