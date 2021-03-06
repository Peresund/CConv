
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

import 'expose-loader?$!expose-loader?jQuery!jquery'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import CurrencyConverter from './components/CurrencyConverter/CurrencyConverter'
new Vue({
	el: 'CurrencyConverter',
	template: '<CurrencyConverter/>',
	components: { CurrencyConverter }
});
