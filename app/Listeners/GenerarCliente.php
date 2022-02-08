<?php

namespace App\Listeners;

use App\Events\NuevoUsuario;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class GenerarCliente
{
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
        //Chequeamos si el rol es 2 "empresa".
        $rol = DB::table('model_has_roles')->select('role_id')->where("model_id","=","2")->get();

        Cliente::create([
            'cuit' => 'incompleto',
            'razon_social' => $event->usuario->first_name." ".$event->usuario->last_name,
            'telefono' => 'incompleto',
            'direccion' => 'incompleto',
            'usuario_id' => $event->usuario->id
        ]);

        /*if($rol[0]->role_id === 2){

        }*/
    }
}
