<?php

namespace App\Models\Opciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogos';

    protected $fillable = ['nombre', 'id_padre'];

    public function parent()
    {
        return $this->belongsTo(Catalogo::class, 'id_padre');
    }

    public function children()
    {
        return $this->hasMany(Catalogo::class, 'id_padre');
    }

}
