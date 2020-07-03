require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import {routes} from './route'
import User from './helper/User'
import Notification from './helper/notification'
import Swal from 'sweetalert2'


window.Notification = Notification;
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast=Toast;

window.user=User;

Vue.use(VueRouter)
Vue.component('pagination', require('laravel-vue-pagination'));
const router = new VueRouter({
    routes,
    mode: 'history',
});

const app = new Vue({
    el: '#app',
    router
});
