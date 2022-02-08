<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nroOrden'), 'has-success': fields.nroOrden && fields.nroOrden.valid }">
    <label for="nroOrden" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.orden.columns.nroOrden') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nroOrden" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nroOrden'), 'form-control-success': fields.nroOrden && fields.nroOrden.valid}" id="nroOrden" name="nroOrden" placeholder="{{ trans('admin.orden.columns.nroOrden') }}">
        <div v-if="errors.has('nroOrden')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nroOrden') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('detalles'), 'has-success': fields.detalles && fields.detalles.valid }">
    <label for="detalles" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.orden.columns.detalles') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea class="form-control" v-model="form.detalles" v-validate="''" id="detalles" name="detalles"></textarea>
        </div>
        <div v-if="errors.has('detalles')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('detalles') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cliente_id'), 'has-success': fields.cliente_id && fields.cliente_id.valid }">
    <label for="cliente_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.orden.columns.cliente_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">

            <select name="cliente_id" id="cliente_id" v-model="form.cliente_id" class="form-control">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                @endforeach
            </select>

        </div>
</div>


