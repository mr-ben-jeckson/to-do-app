import Vue from 'vue'

import Toaster from 'v-toaster'

import 'v-toaster/dist/v-toaster.css'

Vue.use(Toaster, {timeout: 5000})

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('products', require('./components/Products.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));

const app = new Vue({
    el: '#app'
});
