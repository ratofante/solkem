<?php

namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;

class EstadoOrden extends Model
{
    protected $table = 'estado_orden';

    protected $fillable = [
        'id','usuario_id','orden_id','estado_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/estado-ordens/'.$this->getKey());
    }
    public function orden() {
        return $this->belongsTo(Orden::class, 'orden_id');
    }
    public function admin_users() {
        return $this->belongsTo(AdminUser::class, 'usuario_id');
    }
    public function estado() {
        return $this->belongsTo(Estado::class,'estado_id');
    }
}
