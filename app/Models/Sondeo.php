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

    public function ObtenerTotalMuestras()
    {
        $total = Muestra::where(function ($query) {
            $query->where('sondeo_id', $this->id);
        })->count();

        return $total;
    }

    public static function getPaginatedData($search_query = null, $per_page = 5)
    {
        $builder = Sondeo::query()
            ->select('clientes.nombre AS nombre_cliente', 'proyectos.nombre AS nombre_proyecto', 'sondeos.*')
            ->join('proyectos', 'sondeos.proyecto_id', '=', 'proyectos.id')
            ->join('clientes', 'proyectos.cliente_id', '=', 'clientes.id');

        if ($search_query) {
            $builder->where(function ($query) use ($search_query) {
                $query->where('clientes.nombre', 'like', '%'.$search_query.'%')
                    ->orWhere('proyectos.nombre', 'like', '%'.$search_query.'%');
            });
        }

        return $builder->paginate($per_page)->withQueryString();
    }
}
