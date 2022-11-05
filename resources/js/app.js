import './bootstrap';
import {createApp} from 'vue';

import App from './components/App.vue';
import router from './router';
import AdminIndex from './view/admin/index.vue';

const app = createApp({});
app.component('App',App);
app.component('AdminIndex',AdminIndex);
app.use(router).mount('#app');
