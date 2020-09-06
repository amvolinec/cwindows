/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('errors', require('./components/ErrorsComponent.vue').default);
Vue.component('deals', require('./components/DealsComponent.vue').default);
Vue.component('deals-popup', require('./components/DealsPopupComponent.vue').default);
Vue.component('positions-popup', require('./components/PositionsComponent.vue').default);
Vue.component('nope-popup', require('./components/NopePopupComponent.vue').default);
Vue.component('find', require('./components/FindComponent.vue').default);
Vue.component('offer', require('./components/OfferComponent.vue').default);
Vue.component('offer-items', require('./components/OfferItemsComponent.vue').default);
Vue.component('configurator', require('./components/СonfiguratorComponent.vue').default);
Vue.component('configurator-w1', require('./components/СonfiguratorW1Component.vue').default);
Vue.component('datetime', Datetime);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        group: 0,
        task: 0,
        error: false,
        errorMessage: '',
        popup: false,
        nope: false,
        positions: false,
        configurator1: false,
        configurator2: false,
        offer: [],
        newContact: false
    },
    methods: {
        fetchError(error){
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                this.error = true;
                // let message = '';
                // error.response.data.errors.forEach( (key, value) => {
                //     message += e;
                // });
                this.errorMessage = error.response.data.message;
                console.log(error.response.status);
                console.log(error.response.headers);
            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log('Error', error.message);
            }
            console.log(error.config);
        }, format(n) {
            return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(n);
        }, percents(n) {
            return new Intl.NumberFormat('de-DE', { style: 'percent', signDisplay: "exceptZero" }).format(n);
        }
    }
});
