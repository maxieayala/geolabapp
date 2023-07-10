<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Muestra
 *
 * @property int $id
 * @property int $sondeo_id
 * @property string $desde
 * @property string $hasta
 * @property string $descripcionvisual
 */
class Muestra extends Model
{
    use HasFactory;

    protected $table = 'muestras';

    protected $fillable = [
        'sondeo_id',
        'desde',
        'hasta',
        'descripcionvisual',
    ];

    /**
     * Get the sondeo that owns the muestra.
     *
     *  @return BelongsTo
     */
    public function sondeo()
    {
        return $this->belongsTo(Sondeo::class);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    /**
     * Get muestra name_link attribute.
     *
     * @return string
     */
    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'descripcionvisual' => $this->descripcionvisual, 'type' => __('muestra.muestra'),
        ]);
        $link = '<a href="'.route('muestras.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->descripcionvisual;
        $link .= '</a>';

        return $link;
    }

    /**
     * muestra belongs to User model relation.
     *
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
