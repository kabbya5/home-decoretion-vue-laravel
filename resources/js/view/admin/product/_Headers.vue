<template>
    <div class="flex justify-between">
        <div class="flex justify-between">
            <router-link to="/admin/product/image/index" class="mx-4 text-green-800 border-2 border-green-800 px-4 py-1 capitalize font-semibold 
                transition duration-300 hover:text-white hover:bg-green-800">
                 All Images 
            </router-link>
            <router-link :to="{name:'adminTrashedIamge'}" class="mx-4 text-orange-800 border-2 border-orange-800 px-4 py-1 capitalize font-semibold 
                transition duration-300 hover:text-white hover:bg-orange-800">
                 Trashed Images
            </router-link>
        </div>
    </div>
</template>

<style scoped>
    .router-link-active , .router-link-exact-active{
        background: rgb(26, 130, 24);
        color: aliceblue;
        border:transparent;
    }
</style>