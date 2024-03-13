<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlists extends Model
{
    use HasFactory;
    protected $table = 'playlists';

    public function canciones()
    {
        return $this->belongsToMany(Canciones::class, 'cancion_playlist');
    }
    
    public function usuario()
    {
        return $this->belongsToMany(Usuarios::class, 'user_playlist');
    }
}
