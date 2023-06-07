<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sondeo extends Model
{
    use HasFactory;

    protected $fillable = [
        'coordenada_x',
        'coordenada_y',
        'estacion',
        'banda',
        'tipo_sondeo_id',
        'proyecto_id',
        'fecha',
        'metodos_perforacion',
        'instrumentacion',
    ];


    public function muestras()
    {
        return $this->hasMany(Muestra::class);
    }
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

}
