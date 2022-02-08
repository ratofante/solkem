import AppForm from '../app-components/Form/AppForm';

Vue.component('cliente-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                cuit:  '' ,
                razon_social:  '' ,
                telefono:  '' ,
                direccion:  '' ,
                usuario_id:  '' ,
                
            }
        }
    }

});