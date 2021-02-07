/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

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
Vue.component('offer', require('./components/OfferEditComponent.vue').default);
Vue.component('offer-items', require('./components/OfferItemsComponent.vue').default);
Vue.component('offer-state', require('./components/OfferStateComponent.vue').default);
Vue.component('configurator', require('./components/СonfiguratorComponent.vue').default);
Vue.component('configurator-w1', require('./components/СonfiguratorW1Component.vue').default);
Vue.component('new-transaction', require('./components/NewTransactionComponent.vue').default);
Vue.component('profiles', require('./components/ProfilesComponent.vue').default);
Vue.component('colors', require('./components/ColorsComponent.vue').default);
Vue.component('materials', require('./components/MaterialsComponent.vue').default);
Vue.component('contract', require('./components/ContractComponent.vue').default);
Vue.component('contact', require('./components/ContactComponent.vue').default);
Vue.component('w-table', require('./components/TableComponent.vue').default);
Vue.component('w-contact', require('./components/ContactComponent.vue').default);
Vue.component('w-checkbox', require('./components/InputCheckBox.vue').default);
Vue.component('w-input', require('./components/InputText.vue').default);
Vue.component('w-pagination', require('./components/PaginateComponent.vue').default);

Vue.component('datetime', Datetime);
Vue.component('v-select', vSelect);

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
        newContact: false,
        newTransaction: false,
        locale: 'de-DE',
        currency: 'EUR',
        tenderId: 0,
        offerId: 0,
    },
    created() {
        this.loadSettings();
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
            return new Intl.NumberFormat(this.locale, { style: 'currency', currency: this.currency }).format(n);
        }, percents(n) {
            return new Intl.NumberFormat(this.locale, { style: 'percent', signDisplay: "exceptZero" }).format(n);
        }, loadSettings(){
            axios.get('/settings').then(r => {
                console.log(r.data);
                if (typeof r.data === 'object'){
                    console.log(r.data.currency.code);
                    this.locale = r.data.currency.locale.replace('_','-');
                    this.currency = r.data.currency.code;
                }
            }).catch((error) => {
                this.fetchError(error);
            });
        }
    }
});
