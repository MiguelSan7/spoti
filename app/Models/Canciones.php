<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canciones extends Model
{
    use HasFactory;
    protected $table = 'canciones';

    public function genero()
    {
        return $this->belongsTo(Generos::class);
    }

    public function album()
    {
        return $this->belongsTo(Albumes::class);
    }

    public function descargas()
    {
        return $this->hasMany(Descargas::class);
    }
    public function favoritos()
    {
        return $this->hasMany(Favoritos::class);
    }

    public function historial()
    {
        return $this->hasMany(Historial::class);
    }

    public function playList()
    {
        return $this->belongsToMany(Playlists::class, 'cancion_playlist');
    }
}
