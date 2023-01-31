<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaGenero extends Model
{
    use HasFactory;

    protected $table = 'peliculas_generos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pelicula_genero_nombre',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Uno a muchos
    public function peliculas_generos_datos()
    {
        return $this->hasMany(PeliculaGeneroDato::class, 'pelicula_genero_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $pelicula_genero_nombre = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($pelicula_genero_nombre != null)
        {
            $query
            ->where('pelicula_genero_nombre', $pelicula_genero_nombre);
        }

        return $query->orderBy('pelicula_genero_nombre', 'ASC');
    }
}
