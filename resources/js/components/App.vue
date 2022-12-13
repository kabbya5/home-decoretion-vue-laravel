<template>
    <div>
        <Navbar/>
        <router-view :key="$route.fullPath"> </router-view>   
        <FooterVue />  
    </div>
</template>
<script>
import Navbar from './Navbar.vue';
import FooterVue from './Footer.vue';
export default{
    name: "App",
    components:{
        Navbar,
        FooterVue,
    },
}
</script>