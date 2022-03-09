<?php

namespace App\Http\Controllers;

use App\Models\EstadoOrden;
use App\Models\Orden;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CambioEstadoController extends Controller
{
     public function cambioEstado(Request $request)
    {
        var_dump($request->input('detalles'));
        echo "<br>";
        var_dump($request->input('orden_id'));
        echo "<br>";
        var_dump($request->input('usuario_id'));
        echo "<br>";
        var_dump($request->input('estado'));
        echo "<br>";

        if($request->input('detalles') !== null)
        {
            Orden::where('id', $request->input('orden_id'))
                ->update([
                    'detalles' => $request->input('detalles')
                ]);
        }
        switch ($request->input('estado')) {
            case 'completo':
                $estado = 2;
                break;
            case 'parcial':
                $estado = 3;
                break;
            default:
                $estado = 1;
                break;
        }

        $actual = 1;
        EstadoOrden::where('id', $request->input('id'))
                    ->update([
                        'actual' => 0
                    ]);

        EstadoOrden::create([
            'usuario_id' => $request->input('usuario_id'),
            'orden_id' => $request->input('orden_id'),
            'estado_id' => $estado,
            'actual' => $actual
        ]);

        return redirect('/admin/turnos');
    }
}
