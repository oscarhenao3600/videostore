<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeliculaDato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peliculas_datos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pelicula_dato_nombre',
        'pelicula_dato_sinopsis',
        'pelicula_dato_unitario',
        'pelicula_dato_fecha_estreno',
        'pelicula_tipo_id',
    ];

    protected $dates = [
        'pelicula_dato_fecha_estreno',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Uno a muchos
    public function peliculas_datos_alquileres()
    {
        return $this->hasMany(PeliculaDatoAlquiler::class, 'pelicula_dato_id', 'id');
    }

    public function peliculas_generos_datos()
    {
        return $this->hasMany(PeliculaGeneroDato::class, 'pelicula_dato_id', 'id');
    }

    // Muchos a uno
    public function pelicula_tipo()
    {
        return $this->belongsTo(PeliculaTipo::class, 'pelicula_tipo_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $pelicula_dato_nombre = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($pelicula_dato_nombre != null)
        {
            $query
            ->where('pelicula_dato_nombre', 'LIKE', $pelicula_dato_nombre);
        }

        return $query
                ->orderBy('pelicula_dato_nombre', 'ASC')
                ->orderBy('pelicula_tipo_id', 'ASC');
    }
}
