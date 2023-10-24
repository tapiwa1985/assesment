import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import 'vue-loading-overlay/dist/css/index.css';
import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
import PrimeVue from 'primevue/config';
import store from './store';
import '@vuepic/vue-datepicker/dist/main.css';
import "primevue/resources/themes/mdc-light-deeppurple/theme.css";
import Paginator from 'primevue/paginator';

require('@/assets/css/main.css')

createApp(App).component('Paginator', Paginator).use(router, ToastPlugin, PrimeVue).use(store).mount('#app')
