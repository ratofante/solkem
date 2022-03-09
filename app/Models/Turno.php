<?php

namespace App\Models;

use App\Events\TurnoUpdate;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'Turno';

    protected $fillable = [
        'fechaHora',
        'paraEntrega',
        'orden_id',
        'sucursal_id',
    ];

    protected $dispatchesEvents = [
        'updated' => TurnoUpdate::class,
    ];

    protected $dates = [
        'fechaHora',
    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/turnos/'.$this->getKey());
    }
    /******** RELATIONS */
    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
