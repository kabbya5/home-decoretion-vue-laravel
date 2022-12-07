<template>
    <div class="navbar flex">
        <div v-if="showsideNav" class="fixed z-10 w-[280px] bg-gray-200/60 h-screen border-r-2 border-gray-300 bg-gray-100 py-3 px-2 flex
            flex-col">
            <div class="logo flex items-center justify-center">
                <img class="w-20 h-20 rounded-full" src="https://e7.pngegg.com/pngimages/777/224/png-clipart-blue-and-pink-logo-european-fashion-home-logo-purple-blue-thumbnail.png" alt="">
            </div>
            <ul class="flex flex-col w-full mt-10">
                <li class="w-full  py-1 transition
                    duration-300 hover:bg-gray-300">
                    <router-link to="/admin/dashboard" class=" block uppercase text-gray-800 w-full router-link-active">
                        <i class="fa-solid fa-home text-lg px-2"></i>
                        Dashboard
                    </router-link>
                </li>

                <!-- Catgory  -->

                <li class="w-full text-gray-600  py-1 my-2 transition
                    duration-300 hover:bg-gray-300" :class="{'active': link=='category'}">
                    <button @click="activelink(link =='category'?null:'category')" type="button" class=" block uppercase w-full flex justify-between">
                        <div>
                            <i class="fa-solid fa-sliders text-lg px-2"></i>
                            Category 
                        </div>
                         
                        <i class="fa-solid fa-arrow-down text-lg mr-4"></i>
                    </button>
                    
                    <ul v-show="link=='category'" class="flex flex-col w-full mt-4">
                        <li class="w-full  py-1 transition my-1
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/category/index" class="py-1 block uppercase text-gray-500 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                category 
                            </router-link>
                        </li>
                        <li class="w-full   transition 
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/subcategory/index" class="py-1 block uppercase text-gray-600 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                sub category 
                            </router-link>
                        </li>
                        <li class="w-full   transition 
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/brand/index" class="py-1 block uppercase text-gray-600 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                Brand
                            </router-link>
                        </li>
                    </ul>
                </li>

                <!-- SLider  -->
                <li class="w-full  py-1 transition
                    duration-300 hover:bg-gray-300">
                    <router-link to="/admin/slider/index" @click="activelink(slider)"
                        class=" block uppercase text-gray-600 w-full"
                        :class="{'active': activeLink=='slider'}">
                        <i class="fa-solid fa-home text-lg px-2"></i>
                        Slider
                    </router-link>
                </li>

                <!-- End Slider  -->

                <!-- product  -->

                <li class="w-full text-gray-800  py-1 my-2 transition
                    duration-300 hover:bg-gray-300" :class="{'active': link=='product'}">
                    <button @click="activelink(link=='product' ?null:'product')" type="button" class=" block uppercase w-full flex justify-between">
                        <div>
                            <i class="fa-solid fa-box-open text-lg px-2"></i>
                            product
                        </div>
                         
                        <i class="fa-solid fa-arrow-down text-lg mr-4"></i>
                    </button>
                    
                    <ul v-show="link=='product'" class="flex flex-col w-full mt-4">
                        <li class="w-full  py-1 transition my-1
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/product/index" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-cart-plus text-lg px-2"></i>
                                all products 
                            </router-link>
                        </li>
                        <li class="w-full  py-1 transition my-1
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/product/image/index" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-photo-film text-lg px-2"></i>
                                product Image
                            </router-link>
                        </li>
                        <li class="w-full   transition 
                            duration-300 hover:bg-gray-300">
                            <router-link :to="{name:'adminPrdouctCreate'}" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                Create Product 
                            </router-link>

                        </li>
                        <li class="w-full   transition 
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/product/test" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                Test new here 
                            </router-link>
                            
                        </li>
                        <li class="w-full  py-1 transition my-1
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/product/color/index" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-palette text-lg px-2"></i>
                                color
                            </router-link>
                        </li>
                        <li class="w-full   transition 
                            duration-300 hover:bg-gray-300">
                            <router-link to="/admin/brand/index" class="py-1 block uppercase text-gray-800 w-full">
                                <i class="fa-solid fa-home text-lg px-2"></i>
                                Brand
                            </router-link>
                        </li>
                    </ul>
                </li>

                <!-- End Product  -->

                <!-- Site-setting  -->
                <li class="w-full  py-1 transition
                    duration-300 hover:bg-gray-300">
                    <router-link to="/admin/site/setting/index" @click="activelink(slider)"
                        class=" block uppercase text-gray-600 w-full"
                        :class="{'active': activeLink=='slider'}">
                        <i class="fa-solid fa-gear text-lg px-2"></i>
                        Site setting 
                    </router-link>
                </li>

                <!-- End Site Setting  -->
            </ul>
        </div>
        <div class="w-full bg-white py-3 px-2 md:px-4" 
            :class="{'ml-[280px]':showsideNav}">
            <div class="flex justify-between">
                <div class="flex px-4">
                    <button @click="showsideNav=!showsideNav">
                        <i v-if="showsideNav" class="fa-solid fa-bars fa-2x"></i> 
                        <i v-else class="fa-solid fa-bars-staggered fa-2x"></i>
                    </button>
                    <div class="mx-2 flex items-center">
                        <input type="text" class="py-2 px-4 border-2 border-gray -200
                         focus:outline-none">
                         <i class="fa-solid fa-search bg-indigo-800 py-1 border-2 border-indigo-800
                            text-gray-800 px-2  fa-2x rounded-r-lg"></i>
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
            showsideNav:true,
            show:true,
            hide:true,
            childSideBar:false,
            navCats:[],
            link:'',
        }
    },
    methods:{
        sidebarTogoller: function (){
            this.show = !this.show;
            this.hide = !this.hide;
        },
        activelink(name){;
            this.link = name;
        }
    },
   
}

</script>
<style scoped>
    .router-link-active, .router-link-exact-active{
        background: rgb(209 213 219);
        color:rgb(63 63 70);
    }
    .active{
        background: rgb(229 231 235);
    }
</style>
