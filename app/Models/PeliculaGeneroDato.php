<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaGeneroDato extends Model
{
    use HasFactory;

    protected $table = 'peliculas_generos_datos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pelicula_dato_id',
        'pelicula_genero_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Muchos a uno
    public function pelicula_dato()
    {
        return $this->belongsTo(PeliculaDato::class, 'pelicula_dato_id', 'id');
    }

    public function pelicula_genero()
    {
        return $this->belongsTo(PeliculaGenero::class, 'pelicula_genero_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $pelicula_dato_id = null, $pelicula_genero_id = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($pelicula_dato_id != null)
        {
            $query
            ->where('pelicula_dato_id', $pelicula_dato_id);
        }

        if($pelicula_genero_id != null)
        {
            $query
            ->where('pelicula_genero_id', $pelicula_genero_id);
        }

        return $query;
    }
}
