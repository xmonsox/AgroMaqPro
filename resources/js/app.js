import './bootstrap';

import Vue from 'vue';

window.Vue = require('vue');

Vue.component('general', require('./components/General.vue').default);
Vue.component('editar', require('./components/Editar.vue').default);

const app = new Vue({
    el: '#app',
});
