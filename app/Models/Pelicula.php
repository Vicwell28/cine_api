<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Director;
use App\Models\Categoria;

class Pelicula extends Model
{
    protected $table = 'peliculas';

    protected $primaryKey = 'identificador';

    protected $fillable = ['imagen', 'titulo', 'id_director', 'duracion', 'id_categoria', 'sinopsis'];

    // Corrección en la relación con Director
    public function director()
    {
        return $this->belongsTo(Director::class, 'id_director');
    }

    // Corrección en la relación con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
