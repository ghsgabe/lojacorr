require('./bootstrap');

window.Vue = require('vue');

Vue.component('form-component',     require('./components/FormComponent.vue').default);
Vue.component('formedit-component', require('./components/FormEditComponent.vue').default);
Vue.component('formpass-component', require('./components/FormPassComponent.vue').default);
Vue.component('register-component', require('./components/RegisterComponent.vue').default);
Vue.component('table-component',    require('./components/TableComponent.vue').default);
Vue.component('users-component',    require('./components/UsersComponent.vue').default);
Vue.component('delete-component',   require('./components/ConfirmDelete.vue').default);

const app = new Vue({
    el: '#app',
});