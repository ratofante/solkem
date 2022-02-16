<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    protected $fillable = [
        'estado'
    ];

    public function estado_orden()
    {
        return $this->hasOne(EstadoOrden::class, 'orden_id');
    }
}
