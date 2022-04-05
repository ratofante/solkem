<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class GenerarClienteController extends Controller
{
    protected $permisos = [
        1, 25, 26, 28, 31, 39, 40, 42, 45
    ];

    public function index() {
        return view('generar-cliente.index');
    }

    public function store (Request $request) {

        //Validamos los inputs. validate() devuelve un array con los nombres de los inputs.
        $validated = $request->validate([
            'cuit' => ['required','numeric'],
            'razon_social' => ['required', 'max:100'],
            'telefono' => ['required'],
            'direccion' => ['required'],
            'nombre' => ['required', 'alpha', 'max:50'],
            'apellido' => ['required', 'alpha', 'max:50'],
            'email' => ['required','email:rfc,dns'],
            'password' => ['required', Password::min(10)->numbers()]
        ]);
        //Data validada, continuamos ..

        //Creamos usuario, guardamos ¿la respuesta?
        $usuario = AdminUser::create([
            'first_name' => $validated['nombre'],
            'last_name' => $validated['apellido'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'activated' => 1,
            'forbidden' => 0,
            'language' => 'en'
        ]);

        //Usamos la respuesta para pasar el usuario_id y crear nuevo cliente
        Cliente::create([
            'cuit' => $validated['cuit'],
            'razon_social' => $validated['razon_social'],
            'telefono' => $validated['telefono'],
            'direccion' => $validated['direccion'],
            'usuario_id' => $usuario->id
        ]);

        //Generamos permisos para el usuario Rol 'Empresa'
        $permisos = [];
        foreach($this->permisos as $permiso) {
            array_push($permisos, [
                'permission_id' => $permiso,
                'model_type' => 'Brackets\AdminAuth\Models\AdminUser',
                'model_id' => $usuario->id
            ]);
        }

        //¿será necesario insertar en model has roles?
        DB::table('model_has_permissions')->insert($permisos);

        return view('admin.cliente.index');
    }
}
