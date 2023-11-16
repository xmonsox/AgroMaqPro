import './bootstrap';

import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

window.Vue = require('vue');

//Usuarios
Vue.component('general', require('./components/Usuarios/General.vue').default);
Vue.component('editar', require('./components/Usuarios/Editar.vue').default);

//Proveedor
Vue.component('showsuppliers', require('./components/Proveedores/ShowSuppliers.vue').default);
Vue.component('updatesuppliers', require('./components/Proveedores/UpdateSuppliers.vue').default);

//Repuestos
Vue.component('showrepuestos', require('./components/Repuestos/ShowRepuestos.vue').default);
Vue.component('updaterepuestos', require('./components/Repuestos/UpdateRepuestos.vue').default);

//Repuestos
Vue.component('showmachinery', require('./components/Machinery/Machinery.vue').default);
Vue.component('updaterepuestos', require('./components/Repuestos/UpdateRepuestos.vue').default);



const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
});
