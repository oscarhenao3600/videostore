<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaDatoAlquiler extends Model
{
    use HasFactory;

    protected $table = 'peliculas_datos_alquileres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alquiler_id',
        'pelicula_dato_id',
        'pelicula_dato_alquiler_fecha_inicio',
        'pelicula_dato_alquiler_fecha_fin',
        'pelicula_dato_alquiler_valor_pagar',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Muchos a uno
    public function alquilere()
    {
        return $this->belongsTo(Alquiler::class, 'alquiler_id', 'id');
    }

    public function pelicula_dato()
    {
        return $this->belongsTo(PeliculaDato::class, 'pelicula_dato_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $alquiler_id = null, $pelicula_dato_id = null, $pelicula_dato_alquiler_fecha_inicio = null, $pelicula_dato_alquiler_fecha_fin = null, $pelicula_dato_alquiler_valor_pagar = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($alquiler_id != null)
        {
            $query
            ->where('alquiler_id', $alquiler_id);
        }

        if($pelicula_dato_id != null)
        {
            $query
            ->where('pelicula_dato_id', $pelicula_dato_id);
        }

        if($pelicula_dato_alquiler_fecha_inicio != null)
        {
            $query
            ->whereDate('pelicula_dato_alquiler_fecha_inicio', $pelicula_dato_alquiler_fecha_inicio);
        }

        if($pelicula_dato_alquiler_fecha_fin != null)
        {
            $query
            ->whereDate('pelicula_dato_alquiler_fecha_fin', $pelicula_dato_alquiler_fecha_fin);
        }

        if($pelicula_dato_alquiler_valor_pagar != null)
        {
            $query
            ->where('pelicula_dato_alquiler_valor_pagar', $pelicula_dato_alquiler_valor_pagar);
        }

        return $query->orderBy('id', 'ASC');
    }
}
