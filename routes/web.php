<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [CalendarController::class, 'index']);
Route::post('/calendar-crud-ajax', [CalendarController::class, 'calendarEvents']);

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('clientes')->name('clientes/')->group(static function() {
            Route::get('/',                                             'ClienteController@index')->name('index');
            Route::get('/create',                                       'ClienteController@create')->name('create');
            Route::post('/',                                            'ClienteController@store')->name('store');
            Route::get('/{cliente}/edit',                               'ClienteController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ClienteController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{cliente}',                                   'ClienteController@update')->name('update');
            Route::delete('/{cliente}',                                 'ClienteController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('ordens')->name('ordens/')->group(static function() {
            Route::get('/',                                             'OrdenController@index')->name('index');
            Route::get('/create',                                       'OrdenController@create')->name('create');
            Route::post('/',                                            'OrdenController@store')->name('store');
            Route::get('/{orden}/edit',                                 'OrdenController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'OrdenController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{orden}',                                     'OrdenController@update')->name('update');
            Route::delete('/{orden}',                                   'OrdenController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('turnos')->name('turnos/')->group(static function() {
            Route::get('/',                                             'TurnoController@index')->name('index');
            Route::get('/create',                                       'TurnoController@create')->name('create');
            Route::post('/',                                            'TurnoController@store')->name('store');
            Route::get('/{turno}/edit',                                 'TurnoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TurnoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{turno}',                                     'TurnoController@update')->name('update');
            Route::delete('/{turno}',                                   'TurnoController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('sucursals')->name('sucursals/')->group(static function() {
            Route::get('/',                                             'SucursalController@index')->name('index');
            Route::get('/create',                                       'SucursalController@create')->name('create');
            Route::post('/',                                            'SucursalController@store')->name('store');
            Route::get('/{sucursal}/edit',                              'SucursalController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SucursalController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{sucursal}',                                  'SucursalController@update')->name('update');
            Route::delete('/{sucursal}',                                'SucursalController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('estado-ordens')->name('estado-ordens/')->group(static function() {
            Route::get('/',                                             'EstadoOrdenController@index')->name('index');
            Route::get('/create',                                       'EstadoOrdenController@create')->name('create');
            Route::post('/',                                            'EstadoOrdenController@store')->name('store');
            Route::get('/{estadoOrden}/edit',                           'EstadoOrdenController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'EstadoOrdenController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{estadoOrden}',                               'EstadoOrdenController@update')->name('update');
            Route::delete('/{estadoOrden}',                             'EstadoOrdenController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('turnos')->name('turnos/')->group(static function() {
            Route::get('/',                                             'TurnoController@index')->name('index');
            Route::get('/create',                                       'TurnoController@create')->name('create');
            Route::post('/',                                            'TurnoController@store')->name('store');
            Route::get('/{turno}/edit',                                 'TurnoController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TurnoController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{turno}',                                     'TurnoController@update')->name('update');
            Route::delete('/{turno}',                                   'TurnoController@destroy')->name('destroy');
            Route::get('/export',                                       'TurnoController@export')->name('export');
        });
    });
});
