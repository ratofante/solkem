import AppForm from '../app-components/Form/AppForm';

Vue.component('sucursal-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                apertura:  '' ,
                cierre:  '' ,
                nombre:  '' ,
                direccion:  '' ,
                telefono:  '' ,
                email:  '' ,
                
            }
        }
    }

});