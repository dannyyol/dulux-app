require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import 'animate.css';

import SequentialEntrance from 'vue-sequential-entrance'
import 'vue-sequential-entrance/vue-sequential-entrance.css'

import BootstrapVue from "bootstrap-vue"
// import Accordion from '../js/components/frontend/Accordion'

import 'bootstrap-vue/dist/bootstrap-vue.css'

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import swal from 'sweetalert2';

import { Datetime } from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
 
Vue.use(BootstrapVue)

Vue.use(Datetime)
 
Vue.use(Datetime)
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


Vue.filter('str_limit', function (value, size) {
  if (!value) return '';
  value = value.toString();

  if (value.length <= size) {
    return value;
  }
  return value.substr(0, size) + '...';
});

Vue.use(BootstrapVue);
window.Fire = new Vue();
Vue.use(VueRouter);
// Vue.component('accordion', Accordion)
const routes = [
    //Admin Url
    { path: '/', component: require('./components/frontend/Home.vue').default },
    { path: '/color', component: require('./components/frontend/Color.vue').default },
    { path: '/menu/category/:cId/colour/:id', name: "menu", component: require('./components/frontend/Menu.vue').default },
    // { path: '/api/filter', name:"filter", component: require('./components/frontend/Modals/Filter.vue').default },
    { path: '/checkout-order/:id', name:"checkout", props:true, component: require('./components/frontend/Checkout.vue').default },

]
const router = new VueRouter({
    routes,
    mode: 'history',
    base: "/api/"
});

const app = new Vue({
    el: '#app',
    router
});
