<template>
    <div class="flex flex-row justify-between items-center pb-2">
        <router-link to="/admin/subcategory/index" class="px-4 py-1 uppercase bg-white text-green-800 border-2 border-green-800
            transition duration-300 hover:bg-green-800 hover:text-white">
            All subcatgories
        </router-link>

        <router-link to="/admin/subcetegory/trashed" class="px-4 py-1 mx-4 uppercase text-red-800 border-2 border-red-800
            transition duration-300 hover:bg-red-800 hover:text-white">
                Trashed Category
        </router-link>
    </div>
</template>
<script>
export default{
    data(){
        return{
            show:{
                
            }
        }
    }
}
</script>
<style scoped>
    .router-link-active , .router-link-exact-active{
        background: rgb(26, 130, 24);
        color: aliceblue;
        border:transparent;
    }
</style>
