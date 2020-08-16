/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));import Vue from 'vue'
/* eslint-disable no-new */

import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(require('vue-moment'));
Vue.use(VueCurrencyFilter,
    {
        symbol : 'P',
        thousandsSeparator: ',',
        fractionCount: 2,
        fractionSeparator: '.',
        symbolPosition: 'front',
        symbolSpacing: true
    })

Vue.component('notification', require('./components/admin/Notification.vue').default);
Vue.component('checkin', require('./components/admin/AdminCheckIn.vue').default);
Vue.component('admin-bookings', require('./components/admin/AdminBookings.vue').default);
Vue.component('admin-bookings-details', require('./components/admin/AdminBookingDetail.vue').default);
Vue.component('admin-rooms', require('./components/admin/AdminRooms.vue').default);
Vue.component('admin-services', require('./components/admin/AdminServices.vue').default);
Vue.component('reserve-services', require('./components/admin/AdminReserveBangquets.vue').default);
Vue.component('admin-room-reports', require('./components/admin/AdminRoomReports.vue').default);
Vue.component('admin-bangquet-reports', require('./components/admin/AdminBangquetReports.vue').default);

Vue.component('admin-rooms-status', require('./components/admin/AdminRoomsStatus.vue').default);

Vue.component('admin-room-bookings', require('./components/admin/AdminRoomBookings.vue').default);
Vue.component('reserve-bangquets', require('./components/admin/AdminReserveBangquets.vue').default);
Vue.component('displayrooms', require('./components/client/ClientDisplayRooms.vue').default);
Vue.component('reservation', require('./components/client/ClientReservation.vue').default);
Vue.component('availablerooms', require('./components/client/ClientAvailableRooms.vue').default);
Vue.component('reservationdetail', require('./components/client/ClientReservationDetail.vue').default);
Vue.component('roomdetail', require('./components/client/ClientRoomDetail.vue').default);
Vue.component('reseravtionform', require('./components/client/ClientReservationForm.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#app',
})

