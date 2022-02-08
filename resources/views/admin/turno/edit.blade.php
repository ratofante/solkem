@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.turno.actions.edit', ['name' => $turno->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <turno-form
                :action="'{{ $turno->resource_url }}'"
                :data="{{ $turno->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.turno.actions.edit', ['name' => $turno->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.turno.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </turno-form>

        </div>
    
</div>

@endsection