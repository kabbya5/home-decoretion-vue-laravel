import {createApp} from 'vue';
import Vuex from 'vuex';

import NavbarContent from './modules/navbarContent';

const Vue = createApp({});
Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        NavbarContent,
    }
});