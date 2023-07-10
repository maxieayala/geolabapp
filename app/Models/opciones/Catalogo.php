<?php

namespace App\Models\Opciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Catalogo
 *
 * @property int $id
 * @property string $nombre
 * @property int $id_padre
 * @property string $descripcion
 *
 * @mixins \Eloquent
 */
class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'catalogos';

    protected $fillable = ['nombre', 'id_padre', 'descripcion'];

    /**
     * Get the sondeo that owns the muestra.
     *
     *  @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Catalogo::class, 'id_padre');
    }

    /**
     * Get the sondeo that owns the muestra.
     *
     *  @return hasMany
     */
    public function children()
    {
        return $this->hasMany(Catalogo::class, 'id_padre');
    }
}
