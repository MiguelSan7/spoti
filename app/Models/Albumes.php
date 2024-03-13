<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albumes extends Model
{
    use HasFactory;
    protected $table = 'albumes';
    public function artistas()
    {
        return $this->belongsTo(Artistas::class);
    }

    public function canciones()
    {
        return $this->hasMany(Canciones::class);
    }
}
