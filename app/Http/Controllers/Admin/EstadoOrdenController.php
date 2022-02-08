<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EstadoOrden\BulkDestroyEstadoOrden;
use App\Http\Requests\Admin\EstadoOrden\DestroyEstadoOrden;
use App\Http\Requests\Admin\EstadoOrden\IndexEstadoOrden;
use App\Http\Requests\Admin\EstadoOrden\StoreEstadoOrden;
use App\Http\Requests\Admin\EstadoOrden\UpdateEstadoOrden;
use App\Models\EstadoOrden;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EstadoOrdenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEstadoOrden $request
     * @return array|Factory|View
     */
    public function index(IndexEstadoOrden $request)
    {
        if(auth()->user()->getRoleNames()->get(0) === "Empresa")
        {
            $data = AdminListing::create(EstadoOrden::class)->processRequestAndGet(
                // pass the request with params
                $request,
                // set columns to query
                ['id', 'usuario_id', 'orden_id', 'estado_id'],

                // set columns to searchIn
                ['id', 'usuario_id', 'orden_id', 'estado_id'],

                function($query) {
                    $query->with(['orden']);
                    $query->join('orden', 'estado_orden.orden_id', "=", 'orden.id');

                    $query->with(['admin_users']);
                    $query->join('admin_users', 'estado_orden.usuario_id', "=", 'admin_users.id');

                    $query->where('admin_users.id',auth()->user()->id);
                }
            );
            return view('admin.estado-orden.index', ['data' => $data]);
        }
        else
        {
            // create and AdminListing instance for a specific model and
            $data = AdminListing::create(EstadoOrden::class)->processRequestAndGet(
                // pass the request with params
                $request,

                // set columns to query
                ['id', 'usuario_id', 'orden_id', 'estado_id'],

                // set columns to searchIn
                ['id', 'usuario_id', 'orden_id', 'estado_id'],

                function($query) {
                    $query->with(['admin_users']);
                    $query->join('admin_users', 'estado_orden.usuario_id', "=", 'admin_users.id');

                    $query->with(['orden']);
                    $query->join('orden', 'estado_orden.orden_id', "=", 'orden.id');
                }
            );
            //var_dump($data);die;
            if ($request->ajax()) {
                if ($request->has('bulk')) {
                    return [
                        'bulkItems' => $data->pluck('id')
                    ];
                }
                return ['data' => $data];
            }

            return view('admin.estado-orden.index', ['data' => $data]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.estado-orden.create');

        return view('admin.estado-orden.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEstadoOrden $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEstadoOrden $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the EstadoOrden
        $estadoOrden = EstadoOrden::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/estado-ordens'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/estado-ordens');
    }

    /**
     * Display the specified resource.
     *
     * @param EstadoOrden $estadoOrden
     * @throws AuthorizationException
     * @return void
     */
    public function show(EstadoOrden $estadoOrden)
    {
        $this->authorize('admin.estado-orden.show', $estadoOrden);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EstadoOrden $estadoOrden
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(EstadoOrden $estadoOrden)
    {
        $this->authorize('admin.estado-orden.edit', $estadoOrden);


        return view('admin.estado-orden.edit', [
            'estadoOrden' => $estadoOrden,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEstadoOrden $request
     * @param EstadoOrden $estadoOrden
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEstadoOrden $request, EstadoOrden $estadoOrden)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values EstadoOrden
        $estadoOrden->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/estado-ordens'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/estado-ordens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEstadoOrden $request
     * @param EstadoOrden $estadoOrden
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEstadoOrden $request, EstadoOrden $estadoOrden)
    {
        $estadoOrden->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEstadoOrden $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEstadoOrden $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    EstadoOrden::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
