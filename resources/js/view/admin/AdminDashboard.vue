<template>
    <div class="">
        <div class="flex border-b-2 border-gray-200  px-4 py-2">
            <router-link to="/admin/dashboard" class="capitalize"> dashboard </router-link>
        </div>
        <div class="my-6 grid grid-cols-4 gap-4">
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="details text-white">
                     <h2> 26K <span> (-1% ) </span></h2>
                </div>
                <div class="image">
                </div>         
             </div>
             <div class="col-span-2 lg:col-span-1">
                <div class="details text-white">
                     <h2> 26K <span> (-1% ) </span></h2>
                </div>
                <div class="image">
                </div>      
             </div>
             <div class="col-span-2 lg:col-span-1">
                <div class="details text-white">
                     <h2> 26K <span> (-1% ) </span></h2>
                </div>
                <div class="image">
                </div>       
             </div>
        </div>
    </div>
</template>


<style lang="scss" scoped>

</style>>
