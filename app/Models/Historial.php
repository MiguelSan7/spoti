<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cancion()
    {
        return $this->belongsTo(Canciones::class);
    }
}
