<?php

namespace App\Models;

use App\Models\Opciones\Catalogo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $query = Catalogo::where('id', $this->tipocliente_id);
        $first_catalogo = $query->first();

        return $first_catalogo;
    }

    // customerOrders
    public function Proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }
}
