<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaTipo extends Model
{
    use HasFactory;

    protected $table = 'peliculas_tipos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pelicula_tipo_nombre',
        'pelicula_tipo_dia_adicional_desde',
        'pelicula_tipo_porcent_dia_adicional',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Uno a muchos
    public function peliculas_datos()
    {
        return $this->hasMany(PeliculaDato::class, 'pelicula_tipo_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $pelicula_tipo_nombre = null, $pelicula_tipo_dia_adicional_desde = null, $pelicula_tipo_porcent_dia_adicional = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($pelicula_tipo_nombre != null)
        {
            $query
            ->where('pelicula_tipo_nombre', $pelicula_tipo_nombre);
        }

        if($pelicula_tipo_dia_adicional_desde != null)
        {
            $query
            ->whereDate('pelicula_tipo_dia_adicional_desde', $pelicula_tipo_dia_adicional_desde);
        }

        if($pelicula_tipo_porcent_dia_adicional != null)
        {
            $query
            ->where('pelicula_tipo_porcent_dia_adicional', $pelicula_tipo_porcent_dia_adicional);
        }

        return $query->orderBy('pelicula_tipo_nombre', 'ASC');
    }
}
