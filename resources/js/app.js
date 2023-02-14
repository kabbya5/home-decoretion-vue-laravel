import './bootstrap';
import {createApp} from 'vue';

import store from './store/';


import App from './components/App.vue';
import router from './router';

import Admin from './view/admin/Index.vue';

const app = createApp({});
app.component('App',App);
app.component('Admin',Admin);
app.use(router);
app.use(store);
app.mount('#app');






