<template>
    <div>
        <metainfo>
            <template v-slot:title="{ content }">{{ content ? `${content} | SITE_NAME` : `SITE_NAME` }}</template>
        </metainfo>
        <Navbar/>
        <router-view :key="$route.fullPath"> </router-view>     
    </div>
</template>
<script>
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue'
import Index from '../view/Index.vue'
export default{
    name: "App",
    components:{
        Navbar,
        Index,
        Sidebar,
    },
    created(){
        document.title = 'home/project';
    }
}
</script>