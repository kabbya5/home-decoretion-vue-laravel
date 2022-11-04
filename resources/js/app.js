import './bootstrap';
import {createApp} from 'vue';

import App from './components/App.vue';
import router from './router';

const app = createApp({});
app.component('App',App);
app.use(router).mount('#app');
