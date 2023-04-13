<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proyecto;
class cliente extends Model
{
    use HasFactory;
    // customerOrders
    public function Proyecto()
    {
        return $this->hasMany(Proyecto::class);
    }
}
