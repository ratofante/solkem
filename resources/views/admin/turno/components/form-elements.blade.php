<div class="form-group row align-items-center" :class="{'has-danger': errors.has('fechaHora'), 'has-success': fields.fechaHora && fields.fechaHora.valid }">
    <label for="fechaHora" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.turno.columns.fechaHora') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.fechaHora" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('fechaHora'), 'form-control-success': fields.fechaHora && fields.fechaHora.valid}" id="fechaHora" name="fechaHora" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('fechaHora')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('fechaHora') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('paraEntrega'), 'has-success': fields.paraEntrega && fields.paraEntrega.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="paraEntrega" type="checkbox" v-model="form.paraEntrega" v-validate="''" data-vv-name="paraEntrega"  name="paraEntrega_fake_element">
        <label class="form-check-label" for="paraEntrega">
            Marcar para entrega
        </label>
        <input type="hidden" name="paraEntrega" :value="form.paraEntrega">
        <div v-if="errors.has('paraEntrega')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('paraEntrega') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('orden_id'), 'has-success': fields.orden_id && fields.orden_id.valid }">
    <label for="orden_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.turno.columns.orden_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.orden_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('orden_id'), 'form-control-success': fields.orden_id && fields.orden_id.valid}" id="orden_id" name="orden_id" placeholder="{{ trans('admin.turno.columns.orden_id') }}">
        <div v-if="errors.has('orden_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('orden_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sucursal_id'), 'has-success': fields.sucursal_id && fields.sucursal_id.valid }">
    <label for="sucursal_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.turno.columns.sucursal_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select name="sucursal_id" id="sucursal_id" v-model="form.sucursal_id" class="form-control">
            @foreach ($sucursales as $sucursal)
                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
        </div>
</div>


