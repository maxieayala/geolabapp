<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    use HasFactory;

    protected $table = 'muestras';

    protected $fillable = [
        'sondeo',
        'desde',
        'hasta',
        'descripcionvisual',
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get muestra coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitud && $this->longitud) {
            return $this->latitud.', '.$this->longitud;
        }
    }

    /**
     * Get muestra map_popup_content attribute.
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('muestra.name').':</strong><br>'.$this->name_link.'</div>';
        $mapPopupContent .= '<div class="my-2"><strong>'.__('muestra.coordinate').':</strong><br>'.$this->coordinate.'</div>';

        return $mapPopupContent;
    }
}
