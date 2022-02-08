<?php

namespace App\Listeners;

use App\Events\NuevoUsuario;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class AsignarRoles
{
    protected $permisos = [
        1, 25, 26, 28, 31, 39, 40, 42, 45
    ];
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NuevoUsuario  $event
     * @return void
     */
    public function handle(NuevoUsuario $event)
    {
        $data = [];
        foreach($this->permisos as $permiso)
        {
            array_push($data, [
                'permission_id' => $permiso,
                'model_type' => 'Brackets\AdminAuth\Models\AdminUser',
                'model_id' => $event->usuario->id
            ]);
        }
        DB::table('model_has_permissions')->insert($data);
    }
}
