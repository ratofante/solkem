<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenerarClienteController extends Controller
{
    protected $permisos = [
        1, 25, 26, 28, 31, 39, 40, 42, 45
    ];

    public function index() {
        return view('generar-cliente.index');
    }

    public function store (Request $request) {

        $data = $request->input();

        //Creamos usuario, guardamos ¿la respuesta?
        $usuario = AdminUser::create([
            'first_name' => $data['nombre'],
            'last_name' => $data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activated' => 1,
            'forbidden' => 0,
            'language' => 'en'
        ]);

        //Usamos la respuesta para pasar el usuario_id y crear nuevo cliente
        Cliente::create([
            'cuit' => $data['cuit'],
            'razon_social' => $data['razon_social'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
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

        // return view('generar-cliente.index', [
        //     'data' => $data,
        // ]);
    }
}
