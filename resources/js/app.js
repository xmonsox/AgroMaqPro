import './bootstrap';

import Vue from 'vue';

window.Vue = require('vue');

//Usuarios
Vue.component('general', require('./components/Usuarios/General.vue').default);
Vue.component('editar', require('./components/Usuarios/Editar.vue').default);

//Proveedor
Vue.component('showsuppliers', require('./components/Proveedores/ShowSuppliers.vue').default);
Vue.component('updatesuppliers', require('./components/Proveedores/UpdateSuppliers.vue').default);

// Vue.component('editar', require('./components/Usuarios/Editar.vue').default);

const app = new Vue({
    el: '#app',
});
