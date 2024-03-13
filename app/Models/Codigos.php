<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codigos extends Model
{
    use HasFactory;
    protected $table = 'codigos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
