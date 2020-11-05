import VueSweetalert2 from 'vue-sweetalert2';
import VueMask from 'v-mask';
import VueRecaptcha from 'vue-recaptcha';

import { http } from './config';
import FormComponent from './components/Form/FormComponent.vue';


Vue.use(VueSweetalert2);
Vue.use(VueMask);

const app = new Vue({
    components: {
        VueRecaptcha,
        FormComponent
    },

    data: {
        title: 'Cadastro de Clientes'
    },
}).$mount('#app')
