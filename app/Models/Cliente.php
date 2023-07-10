<?php

namespace App\Models;

use App\Models\Opciones\Catalogo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Cliente
 *
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property int $tipocliente_id
 * @property string $ruc
 * @property string $direccion
 *
 * @mixins \Eloquent
 */
class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'tipocliente_id',
        'ruc',
        'direccion',
    ];

    /**
     * Get the user that owns the Cliente
     *
     * @return object
     */
    public function gettipoCliente()
    {
        $tipo = $this->tipocliente_id;
        $query = Catalogo::where('id', $tipo);
        $first_catalogo = $query->first();

        return $first_catalogo;
    }

    /**
     * Get all of the proyectos for the Cliente
     *
     * @return hasMany
     */
    public function Proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }
}
