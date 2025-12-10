<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojoc extends Model
{
    protected $fillable = ['nom', 'plataforma', 'any_estrena', 'estat', 'preu'];
    public $timestamps = false;
}
