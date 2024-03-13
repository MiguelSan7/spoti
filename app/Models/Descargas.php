<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descargas extends Model
{
    use HasFactory;
    protected $table = 'descargas';

    public function cancion()
    {
        return $this->belongsTo(Canciones::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
