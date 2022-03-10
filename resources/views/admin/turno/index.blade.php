@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.turno.actions.index'))

@section('body')
    <turno-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/turnos') }}'"
        :timezone="'America/Argentina/Buenos_Aires'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.turno.actions.index') }}

                        @can('admin.turno.create')
                        <a class="btn btn-primary btn-sm pull-right m-b-0 ml-2" href="{{ url('admin/turnos/export') }}" role="button"><i class="fa fa-file-excel-o"></i>&nbsp; {{ trans('admin.turno.actions.export') }}</a>

                        <a class="btn btn-primary btn-sm pull-right m-b-0 mr-2" href="/calendar" role="button">
                            <i class="fa fa-calendar"></i> &nbsp;
                            Calendario
                        </a>
                        @endcan

                    </div>
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">

                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        @can('admin.turno.create')
                                        <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th>
                                        @endcan


                                        <th is='sortable' :column="'fechaHora'">{{ trans('admin.turno.columns.fechaHora') }}</th>
                                        <th is='sortable' :column="'orden_id'">{{ trans('admin.turno.columns.orden_id') }}</th>
                                        <th is='sortable' :column="'paraEntrega'">{{ trans('admin.turno.columns.paraEntrega') }}</th>

                                        @cannot('admin.turno.create')
                                            <th>Detalle del Pedido</th>
                                        @endcannot

                                        <th :column="'sucursal_id'">{{ trans('admin.turno.columns.sucursal_id') }}</th>



                                        @can('admin.turno.create')
                                            <th :column="'estado_orden.estado_id'">Estado del Pedido</th>
                                            <th></th>
                                        @endcan
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="7">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/turnos')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>
                                            </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/turnos/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        @can('admin.turno.create')
                                        <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td>
                                        @endcan


                                        <td>@{{ item.fechaHora | datetime}}</td>
                                        <td>@{{ item.orden.nroOrden }}</td>

                                        <td v-if="item.paraEntrega=='1'">Para entrega</td>
                                        <td v-else>Retiro en sucursal</td>



                                        @cannot('admin.turno.create')
                                            <td>@{{ item.orden.detalles }}</td>
                                        @endcannot

                                        <td v-if="item.paraEntrega=='1'" class="fixTd">@{{ item.orden.cliente.direccion }}</td>
                                        <td v-else class="fixTd">@{{ item.sucursal.nombre }}</td>


                                        @can('admin.turno.create')
                                        <td v-if="item.orden.estado_orden.estado_id===1" class="fixTd">
                                            <a class="btn btn-warning btn-sm m-b-0" style="width:95px" :href="item.resource_url + '/control-estado'" role="button">
                                                Incompleto
                                                <i class="fa fa-edit"></i>&nbsp;
                                            </a>
                                        </td>
                                        <td v-else-if="item.orden.estado_orden.estado_id===3" class="fixTd">
                                            <a class="btn btn-secondary btn-sm m-b-0 text-dark" :href="item.resource_url + '/control-estado'" role="button">
                                                Parcial
                                                <i class="fa fa-edit text-dark"></i>&nbsp;
                                            </a>
                                        </td>
                                        <td v-else class="fixTd">
                                            <a class="btn btn-success btn-sm m-b-0" :href="item.resource_url + '/control-estado'" role="button">
                                                Listo
                                                <i class="fa fa-check-circle ml-2"></i>&nbsp;
                                            </a>
                                        </td>
                                        <td class="fixTd">
                                            <div class="row no-gutters" style="width:138px; align-items:center">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info mb-0" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i>Asignar fecha</a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    <button type="submit" class="btn btn-sm btn-danger" style="margin-bottom: 0px;" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @endcan
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/turnos/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.turno.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </turno-listing>
@endsection


