<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $primaryKey = 'id';

    protected $fillable = ['categoria'];

    // Relación con Peliculas
    public function peliculas()
    {
        return $this->hasMany(Pelicula::class, 'id_categoria');
    }
}
