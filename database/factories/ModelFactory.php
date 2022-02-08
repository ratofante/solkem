<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Cliente::class, static function (Faker\Generator $faker) {
    return [
        'cuit' => $faker->sentence,
        'razon_social' => $faker->sentence,
        'telefono' => $faker->sentence,
        'direccion' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'usuario_id' => $faker->randomNumber(5),
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Orden::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Orden::class, static function (Faker\Generator $faker) {
    return [
        'nroOrden' => $faker->sentence,
        'detalles' => $faker->text(),
        'cliente_id' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Turno::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Sucursal::class, static function (Faker\Generator $faker) {
    return [
        'apertura' => $faker->time(),
        'cierre' => $faker->time(),
        'nombre' => $faker->sentence,
        'direccion' => $faker->sentence,
        'telefono' => $faker->sentence,
        'email' => $faker->email,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Turno::class, static function (Faker\Generator $faker) {
    return [
        'fechaHora' => $faker->dateTime,
        'paraEntrega' => $faker->boolean(),
        'orden_id' => $faker->randomNumber(5),
        'sucursal_id' => $faker->randomNumber(5),
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\EstadoOrden::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
