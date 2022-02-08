<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sucursal\BulkDestroySucursal;
use App\Http\Requests\Admin\Sucursal\DestroySucursal;
use App\Http\Requests\Admin\Sucursal\IndexSucursal;
use App\Http\Requests\Admin\Sucursal\StoreSucursal;
use App\Http\Requests\Admin\Sucursal\UpdateSucursal;
use App\Models\Sucursal;
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

class SucursalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSucursal $request
     * @return array|Factory|View
     */
    public function index(IndexSucursal $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Sucursal::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'apertura', 'cierre', 'nombre', 'direccion', 'telefono', 'email'],

            // set columns to searchIn
            ['id', 'nombre', 'direccion', 'telefono', 'email']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.sucursal.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.sucursal.create');

        return view('admin.sucursal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSucursal $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSucursal $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Sucursal
        $sucursal = Sucursal::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/sucursals'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/sucursals');
    }

    /**
     * Display the specified resource.
     *
     * @param Sucursal $sucursal
     * @throws AuthorizationException
     * @return void
     */
    public function show(Sucursal $sucursal)
    {
        $this->authorize('admin.sucursal.show', $sucursal);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sucursal $sucursal
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Sucursal $sucursal)
    {
        $this->authorize('admin.sucursal.edit', $sucursal);


        return view('admin.sucursal.edit', [
            'sucursal' => $sucursal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSucursal $request
     * @param Sucursal $sucursal
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSucursal $request, Sucursal $sucursal)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Sucursal
        $sucursal->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/sucursals'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/sucursals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroySucursal $request
     * @param Sucursal $sucursal
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySucursal $request, Sucursal $sucursal)
    {
        $sucursal->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroySucursal $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySucursal $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Sucursal::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
