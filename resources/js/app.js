require('./bootstrap');

import Vue from 'vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import VueSA2 from 'vue-sweetalert2';
import Axios from 'axios';

import App from './App.vue';
import Routes from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, Axios);
Vue.use(VueSA2);

const router = new VueRouter({
    mode: 'history',
    routes: Routes,
});

const app = new Vue(Vue.util.extend({router}, App)).$mount('#app');