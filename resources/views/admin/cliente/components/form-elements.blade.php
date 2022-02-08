<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cuit'), 'has-success': fields.cuit && fields.cuit.valid }">
    <label for="cuit" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cliente.columns.cuit') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cuit" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cuit'), 'form-control-success': fields.cuit && fields.cuit.valid}" id="cuit" name="cuit" placeholder="{{ trans('admin.cliente.columns.cuit') }}">
        <div v-if="errors.has('cuit')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cuit') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('razon_social'), 'has-success': fields.razon_social && fields.razon_social.valid }">
    <label for="razon_social" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cliente.columns.razon_social') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.razon_social" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('razon_social'), 'form-control-success': fields.razon_social && fields.razon_social.valid}" id="razon_social" name="razon_social" placeholder="{{ trans('admin.cliente.columns.razon_social') }}">
        <div v-if="errors.has('razon_social')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('razon_social') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('telefono'), 'has-success': fields.telefono && fields.telefono.valid }">
    <label for="telefono" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cliente.columns.telefono') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.telefono" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('telefono'), 'form-control-success': fields.telefono && fields.telefono.valid}" id="telefono" name="telefono" placeholder="{{ trans('admin.cliente.columns.telefono') }}">
        <div v-if="errors.has('telefono')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('telefono') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('direccion'), 'has-success': fields.direccion && fields.direccion.valid }">
    <label for="direccion" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cliente.columns.direccion') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.direccion" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('direccion'), 'form-control-success': fields.direccion && fields.direccion.valid}" id="direccion" name="direccion" placeholder="{{ trans('admin.cliente.columns.direccion') }}">
        <div v-if="errors.has('direccion')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('direccion') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('usuario_id'), 'has-success': fields.usuario_id && fields.usuario_id.valid }">
    <label for="usuario_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.cliente.columns.usuario_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.usuario_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('usuario_id'), 'form-control-success': fields.usuario_id && fields.usuario_id.valid}" id="usuario_id" name="usuario_id" placeholder="{{ trans('admin.cliente.columns.usuario_id') }}">
        <div v-if="errors.has('usuario_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('usuario_id') }}</div>
    </div>
</div>


