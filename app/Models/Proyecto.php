<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'ubicacion',
        'fecha_inicio',
        'fecha_fin',
        'nombre_contacto',
        'telefono_contacto',
        'status',
        'cliente_id',
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function proyectoDetalleAdjuntos()
    {
        return $this->hasMany(ProyectoDetalleAdjunto::class);
    }
}
