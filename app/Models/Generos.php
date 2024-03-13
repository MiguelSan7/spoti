<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generos extends Model
{
    use HasFactory;
    protected $table = 'generos';

    public function canciones()
    {
        return $this->hasOne(Canciones::class);
    }
}
