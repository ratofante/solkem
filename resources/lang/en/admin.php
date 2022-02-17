<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'cliente' => [
        'title' => 'Cliente',

        'actions' => [
            'index' => 'Cliente',
            'create' => 'New Cliente',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'cuit' => 'Cuit',
            'razon_social' => 'Razon social',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'usuario_id' => 'Usuario',
            
        ],
    ],

    'orden' => [
        'title' => 'Orden',

        'actions' => [
            'index' => 'Orden',
            'create' => 'New Orden',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'orden' => [
        'title' => 'Orden',

        'actions' => [
            'index' => 'Orden',
            'create' => 'New Orden',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'nroOrden' => 'NroOrden',
            'detalles' => 'Detalles',
            'cliente_id' => 'Cliente',
            
        ],
    ],

    'turno' => [
        'title' => 'Turno',

        'actions' => [
            'index' => 'Turno',
            'create' => 'New Turno',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'sucursal' => [
        'title' => 'Sucursal',

        'actions' => [
            'index' => 'Sucursal',
            'create' => 'New Sucursal',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'apertura' => 'Apertura',
            'cierre' => 'Cierre',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'email' => 'Email',
            
        ],
    ],

    'turno' => [
        'title' => 'Turno',

        'actions' => [
            'index' => 'Turno',
            'create' => 'New Turno',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'fechaHora' => 'FechaHora',
            'paraEntrega' => 'ParaEntrega',
            'orden_id' => 'Orden',
            'sucursal_id' => 'Sucursal',
            
        ],
    ],

    'estado-orden' => [
        'title' => 'Estadoorden',

        'actions' => [
            'index' => 'Estadoorden',
            'create' => 'New Estadoorden',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'turno' => [
        'title' => 'Turno',

        'actions' => [
            'index' => 'Turno',
            'create' => 'New Turno',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'fechaHora' => 'FechaHora',
            'paraEntrega' => 'ParaEntrega',
            'orden_id' => 'Orden',
            'sucursal_id' => 'Sucursal',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];