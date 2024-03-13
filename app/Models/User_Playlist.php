<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Playlist extends Model
{
    use HasFactory;
    protected $table = 'user_playlist';

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function playlist()
    {
        return $this->belongsToMany(Playlist::class);
    }


}
