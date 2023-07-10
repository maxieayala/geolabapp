<?php

namespace App\Models;

use App\Models\proyecto\ProyectoDetalleAdjunto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Proyecto
 *
 * @property int $id
 * @property string $nombre
 * @property string $direccion
 * @property string $ubicacion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $nombre_contacto
 * @property string $telefono_contacto
 * @property string $status
 * @property int $cliente_id
 *
 * @mixins \Eloquent
 */
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

    /**
     * @return BelongsTo
     */
    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * @return HasMany
     */
    public function proyectoDetalleAdjuntos()
    {
        return $this->hasMany(ProyectoDetalleAdjunto::class);
    }
}
