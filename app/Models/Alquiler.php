<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alquiler extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'alquileres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_dato_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Uno a muchos
    public function peliculas_datos_alquileres()
    {
        return $this->hasMany(PeliculaDatoAlquiler::class, 'alquiler_id', 'id');
    }

    // Muchos a uno
    public function cliente_dato()
    {
        return $this->belongsTo(ClienteDato::class, 'cliente_dato_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $cliente_dato_id = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($cliente_dato_id != null)
        {
            $query
            ->where('cliente_dato_id', $cliente_dato_id);
        }

        return $query;
    }
}
