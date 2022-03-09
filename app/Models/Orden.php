<?php

namespace App\Models;

use App\Events\NuevaOrden;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'Orden';

    protected $fillable = [
        'nroOrden',
        'detalles',
        'cliente_id',

    ];

    protected $dispatchesEvents = [
        'created' => NuevaOrden::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/ordens/'.$this->getKey());
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function estado_orden()
    {
        return $this->hasOne(EstadoOrden::class, 'orden_id')->where('actual','=','1');
    }
    public function turno()
    {
        return $this->hasOne(Turno::class, 'orden_id');
    }
}
