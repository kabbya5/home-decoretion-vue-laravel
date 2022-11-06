<template>
    <div>
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
}