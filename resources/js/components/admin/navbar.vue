<template>
    <div class="navbar flex">
        <div v-if="hide" class="w-[280px] bg-indigo-300 h-screen border-r-2 border-gray-300 bg-gray-100 py-3 px-2 flex
            flex-col justify-center items-center">
            <div class="logo flex items-center">
                <img class="w-20 h-20 rounded-full" src="https://e7.pngegg.com/pngimages/777/224/png-clipart-blue-and-pink-logo-european-fashion-home-logo-purple-blue-thumbnail.png" alt="">
            </div>
            <ul class="flex flex-col w-full mt-10">
                <li class="w-full bg-indigo-600 py-1 transition
                    duration-300 hover:bg-indigo-800">
                    <a href="" class=" block uppercase text-white w-full">
                        <i class="fa-solid fa-home text-lg px-2"></i>
                        Dashboard
                    </a>
                </li>

                <!-- SLider  -->

                <li class="w-full text-white bg-indigo-800 py-1 my-2">
                    <button @click="childSideBar=!childSideBar" type="button" class=" block uppercase w-full flex justify-between">
                        <div>
                            <i class="fa-solid fa-sliders text-lg px-2"></i>
                            Category 
                        </div>
                         
                        <i class="fa-solid fa-arrow-down text-lg mr-4"></i>
                    </button>
                    
                    <ul v-if="childSideBar" class="flex flex-col w-full mt-4">
                        <li class="w-full bg-indigo-600 py-1 transition
                            duration-300 hover:bg-indigo-800">
                            <router-link to="/admin/category/index" class=" block uppercase text-white w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                category 
                            </router-link>
                        </li>
                        <li class="w-full bg-indigo-600 py-1 transition
                            duration-300 hover:bg-indigo-800">
                            <a href="" class=" block uppercase text-white w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- End Slider  -->
            </ul>
        </div>
        <div class="w-full bg-white py-3 px-2 md:px-4">
            <div class="flex justify-between">
                <div class="flex px-4">
                    <button @click="sidebarTogoller">
                        <i v-if="show" class="fa-solid fa-bars fa-2x"></i> 
                        <i v-if="hide" class="fa-solid fa-bars-staggered fa-2x"></i>
                    </button>
                    <div class="mx-2 flex items-center">
                        <input type="text" class="py-2 px-4 border-2 border-gray -200
                         focus:outline-none">
                         <i class="fa-solid fa-search bg-indigo-800 py-1 border-2 border-indigo-800
                            text-white px-2  fa-2x rounded-r-lg"></i>
                    </div>

                </div>
                
                <div class="w-full md:w-auto md:order-1">
                    <ul class="flex justify-center md:text-sm md:font-medium md:border-0 ">
                        <li>
                            <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent ">Home</a>
                        </li>
                        <li>
                            <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 ">About</a>
                        </li>
                        <li>
                            <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 ">Services</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-6">
                <router-view :key="$route.fullPath"></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return {
            show:false,
            hide:true,
            childSideBar:false,
        }
    },
    methods:{
        sidebarTogoller: function (){
            this.show = !this.show;
            this.hide = !this.hide;
        }
    }
}

</script>