require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import 'animate.css';

import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'

import BootstrapVue from "bootstrap-vue"
import Accordion from '../js/components/frontend/Accordion'

import 'bootstrap-vue/dist/bootstrap-vue.css'

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import swal from 'sweetalert2';
window.swal = swal;


const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.toast = toast;

Vue.use(BootstrapVue);
window.Fire = new Vue();
Vue.use(VueRouter);
Vue.component('accordion', Accordion)
const routes = [
    //Admin Url
    { path: '/api/', component: require('./components/frontend/Home.vue').default },
    { path: '/api/color', component: require('./components/frontend/Color.vue').default },
    { path: '/api/menu', name:"menu", component: require('./components/frontend/menu/Menu.vue').default },
    { path: '/api/checkout-order/:id', name:"checkout", component: require('./components/frontend/Checkout.vue').default },

]
const router = new VueRouter({
    routes,
	mode: 'history',
});

const app = new Vue({
    el: '#app',
    router
});
