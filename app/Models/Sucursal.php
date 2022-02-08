<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'Sucursal';

    protected $fillable = [
        'apertura',
        'cierre',
        'nombre',
        'direccion',
        'telefono',
        'email',
    
    ];
    
    
    protected $dates = [
    
    ];
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/sucursals/'.$this->getKey());
    }
}
