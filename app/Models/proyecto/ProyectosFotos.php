<?php

namespace App\Models\proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectosFotos
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $url
 * @property int $proyecto_id
 *
 * @mixins \Eloquent
 */
class ProyectosFotos extends Model
{
    use HasFactory;
}
