import AppForm from '../app-components/Form/AppForm';

Vue.component('turno-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                fechaHora:  '' ,
                paraEntrega:  false ,
                orden_id:  '' ,
                sucursal_id:  '' ,
                
            }
        }
    }

});