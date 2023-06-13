<?php

namespace App\Models;

use App\Models\Opciones\Catalogo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
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

    public function gettipocliente()
    {
        return Catalogo::where('id', $this->tipocliente_id)->pluck('nombre')->first();
    }

    // customerOrders
    public function Proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }
}
