<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table = 'directores';

    protected $primaryKey = 'id';

    protected $fillable = ['director'];

    // Corrección en la relación con Peliculas
    public function peliculas()
    {
        return $this->hasMany(Pelicula::class, 'id_director');
    }
}