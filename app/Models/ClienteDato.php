<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteDato extends Model
{
    use HasFactory;

    protected $table = 'clientes_datos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_dato_num_identificacion',
        'cliente_dato_nombres',
        'cliente_dato_apellidos',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Uno a muchos
    public function alquileres()
    {
        return $this->hasMany(Alquiler::class, 'cliente_dato_id', 'id');
    }

    public function scopeGetInfo($query, $id = null, $cliente_dato_num_identificacion = null, $cliente_dato_nombres = null, $cliente_dato_apellidos = null)
    {
        if($id != null)
        {
            $query
            ->where('id', $id);
        }

        if($cliente_dato_num_identificacion != null)
        {
            $query
            ->where('cliente_dato_num_identificacion', $cliente_dato_num_identificacion);
        }

        if($cliente_dato_nombres != null)
        {
            $query
            ->where('cliente_dato_nombres', 'LIKE', $cliente_dato_nombres);
        }

        if($cliente_dato_apellidos != null)
        {
            $query
            ->where('cliente_dato_apellidos', 'LIKE', $cliente_dato_apellidos);
        }

        return $query
                ->orderBy('cliente_dato_nombres', 'ASC')
                ->orderBy('cliente_dato_apellidos', 'ASC');
    }

}
