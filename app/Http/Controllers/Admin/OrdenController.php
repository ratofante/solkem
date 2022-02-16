<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orden\BulkDestroyOrden;
use App\Http\Requests\Admin\Orden\DestroyOrden;
use App\Http\Requests\Admin\Orden\IndexOrden;
use App\Http\Requests\Admin\Orden\StoreOrden;
use App\Http\Requests\Admin\Orden\UpdateOrden;
use App\Models\Cliente;
use App\Models\Orden;
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

class OrdenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexOrden $request
     * @return array|Factory|View
     */
    public function index(IndexOrden $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Orden::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nroOrden', 'cliente_id', 'detalles'],

            // set columns to searchIn
            ['id', 'nroOrden', 'detalles', 'cliente_id'],

            function($query) {
                $query->with(['cliente']);
                $query->join('cliente', 'cliente.id', '=', 'orden.cliente_id');

                $query->with(['estado_orden']);
                $query->join('estado_orden', 'orden.id', '=', 'estado_orden.orden_id');
                $query->join('estado', 'estado_orden.estado_id','=','estado.id');
                //$query->where('estado_orden.estado_id', '=', 'estado.id');

            }
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }
        //var_dump($data);die;
        return view('admin.orden.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.orden.create');

        return view('admin.orden.create',[
            'clientes' => Cliente::select('id','razon_social')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrden $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreOrden $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Orden
        $orden = Orden::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/ordens'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/ordens');
    }

    /**
     * Display the specified resource.
     *
     * @param Orden $orden
     * @throws AuthorizationException
     * @return void
     */
    public function show(Orden $orden)
    {
        $this->authorize('admin.orden.show', $orden);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Orden $orden
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Orden $orden)
    {
        $this->authorize('admin.orden.edit', $orden);


        return view('admin.orden.edit', [
            'orden' => $orden,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrden $request
     * @param Orden $orden
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateOrden $request, Orden $orden)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Orden
        $orden->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/ordens'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/ordens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyOrden $request
     * @param Orden $orden
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyOrden $request, Orden $orden)
    {
        $orden->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyOrden $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyOrden $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Orden::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
