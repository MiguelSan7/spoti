<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancion_Playlist extends Model
{
    use HasFactory;
    protected $table = 'cancion_playlist';

    public function cancion()
    {
        return $this->belongsToMany(Canciones::class);
    }
    public function playlist()
    {
        return $this->belongsToMany(Playlists::class);
    }
}
