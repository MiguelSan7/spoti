<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripciones extends Model
{
    use HasFactory;
    protected $table = 'suscripciones';

    public function user()
    {
        return $this->hasMany(User::class);
    }

}
