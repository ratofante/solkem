<?php

namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'Cliente';

    protected $fillable = [
        'cuit',
        'razon_social',
        'telefono',
        'direccion',
        'usuario_id',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/clientes/'.$this->getKey());
    }
    public function orden()
    {
        $this->hasMany('orden');
    }
    public function admin_users()
    {
        return $this->belongsTo(AdminUser::class);
    }
}
