@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.estado-orden.actions.edit', ['name' => $estadoOrden->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <estado-orden-form
                :action="'{{ $estadoOrden->resource_url }}'"
                :data="{{ $estadoOrden->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.estado-orden.actions.edit', ['name' => $estadoOrden->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.estado-orden.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </estado-orden-form>

        </div>
    
</div>

@endsection