<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artistas extends Model
{
    use HasFactory;
    protected $table = 'artistas';

    public function albumes()
    {
        return $this->hasMany(Albumes::class);
    }
}
