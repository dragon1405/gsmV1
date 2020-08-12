require('./bootstrap');
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$('#datepicker').datepicker();
window.Vue = require('vue');


Vue.component('table-users', require('./components/TableUsers.vue').default);
Vue.component('table-projects', require('./components/TableProjects.vue').default);
Vue.component('table-departments', require('./components/TableDepartments.vue').default);
Vue.component('table-reports', require('./components/TableReports.vue').default);
Vue.component('table-reportsall', require('./components/TableReports.vue').default);
Vue.component('calendar', require('./components/Calendar.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);


const app = new Vue({
    el: '#app',
});
