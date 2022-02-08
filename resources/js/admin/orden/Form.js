import AppForm from '../app-components/Form/AppForm';

Vue.component('orden-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                nroOrden:  '' ,
                detalles:  '' ,
                cliente_id:  '' ,
                
            }
        }
    }

});