<template>
    <div>
        <div class="navbar flex">
            <div v-if="showsideNav" class="fixed z-10 w-[280px] bg-gray-200/60 h-screen border-r-2 border-gray-300 bg-gray-100 py-3 px-2 flex
                flex-col">
                <div class="logo flex items-center justify-center">
                    <img class="w-20 h-20 rounded-full" src="https://e7.pngegg.com/pngimages/777/224/png-clipart-blue-and-pink-logo-european-fashion-home-logo-purple-blue-thumbnail.png" alt="">
                </div>
                <ul class="flex flex-col w-full mt-10">
                    <li class="w-full  py-1 transition
                        duration-300 hover:bg-gray-300">
                        <router-link to="/admin/dashboard" class=" block uppercase text-gray-800 w-full">
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
                            <i class="fa-solid fa-film text-lg px-2"></i>
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
                                <router-link :to="{name:'adminTags'}" class="py-1 block uppercase text-gray-800 w-full">
                                    <i class="fa-solid fa-tag text-lg px-2"></i>
                                    Tags
                                </router-link>
                            </li>
                        </ul>
                    </li>
    
                    <!-- End Product  -->
    
                    <!-- Site-setting  -->
                    <li class="w-full text-gray-800  py-1 my-2 transition
                        duration-300 hover:bg-gray-300" :class="{'active': link=='setting'}">
                        <button @click="activelink(link=='setting' ?null:'setting')" type="button" class=" block uppercase w-full flex justify-between">
                            <div>
                                <i class="fa-solid fa-gear text-lg px-2"></i>
                                Site Setting
                            </div>
                             
                            <i class="fa-solid fa-arrow-down text-lg mr-4"></i>
                        </button>
                        
                        <ul v-show="link=='setting'" class="flex flex-col w-full mt-4">
                            <li class="w-full py-1 transition
                                duration-300 hover:bg-gray-300">
                                <router-link to="/admin/site/setting/index"
                                    class=" block uppercase text-gray-600 w-full">
                                    <i class="fa-solid fa-gear text-lg px-2"></i>
                                    Site setting 
                                </router-link>
                            </li>
                            <li class="w-full  py-1 transition my-1
                                duration-300 hover:bg-gray-300">
                                <router-link :to="{name:'adminSocialMediaLink'}" class="py-1 block uppercase text-gray-800 w-full">
                                    <i class="fa-solid fa-photo-film text-lg px-2"></i>
                                    Social Media links
                                </router-link>
                            </li>
                            <li class="w-full  py-1 transition my-1
                                duration-300 hover:bg-gray-300">
                                <router-link :to="{name:'adminDeliverySetting'}" class="py-1 block uppercase text-gray-800 w-full">
                                    <i class="fa-solid fa-photo-film text-lg px-2"></i>
                                    product delivery setting
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <!-- End Site Setting  -->
    
                    <!-- Page Setting  -->
                    <li class="w-full text-gray-800  py-1 my-2 transition
                        duration-300 hover:bg-gray-300" :class="{'active': link=='page-setting'}">
                        <button @click="activelink(link=='page-setting' ?null:'page-setting')" type="button" class=" block uppercase w-full flex justify-between">
                            <div>
                                <i class="fa-solid fa-gear text-lg px-2"></i>
                                page setting
                            </div>
                             
                            <i class="fa-solid fa-arrow-down text-lg mr-4"></i>
                        </button>
                        
                        <ul v-show="link=='page-setting'" class="flex flex-col w-full mt-4">
                            <li class="w-full  py-1 transition
                                duration-300 hover:bg-gray-300">
                                <router-link to="/admin/site/setting/index"
                                    class=" block uppercase text-gray-600 w-full">
                                    <i class="fa-solid fa-home text-lg px-2"></i>
                                    home page 
                                </router-link>
                            </li>
                            <li class="w-full  py-1 transition my-1
                                duration-300 hover:bg-gray-300">
                                <router-link :to="{name:'adminContactPageSetting'}" class="py-1 block uppercase text-gray-800 w-full">
                                    <i class="fa-regular fa-id-card text-lg px-2"></i>
                                    Contact Page
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <!-- coupon -->
                    
                    <li class="w-full  py-1 transition
                        duration-300 hover:bg-gray-300">
                        <router-link :to="{name:'adminCoupon'}" @click="activelink(slider)"
                            class=" block uppercase text-gray-600 w-full"
                            :class="{'active': activeLink=='slider'}">
                            <i class="fa-solid fa-percent text-lg px-2"></i>
                            coupon
                        </router-link>
                    </li>

                    <!-- coupon  -->
                </ul>
            </div>
            <div class="w-full bg-white py-3 px-2 md:px-4" 
                :class="{'ml-[280px]':showsideNav}">
                <div class="flex justify-between items-center">
                    <div class="flex px-4">
                        <button @click="showsideNav=!showsideNav">
                            <i v-if="showsideNav" class="fa-solid fa-bars fa-2x"></i> 
                            <i v-else class="fa-solid fa-bars-staggered fa-2x"></i>
                        </button>
                        <div  class="mx-2 flex items-center">
                            <input type="text" class="py-2 px-4 border-2 border-gray -200
                             focus:outline-none">
                             <i class="fa-solid fa-search bg-indigo-800 py-1 border-2 border-indigo-800
                                text-gray-800 px-2  fa-2x rounded-r-lg"></i>
                        </div>
    
                    </div>
                    
                    <div class="w-full md:w-auto md:order-1">
                        <ul class="flex items-center justify-center md:text-sm md:font-medium md:border-0 ">
                            <li class="mx-4">
                                <router-link to="/" class="py-2 pr-4 pl-3  font-bold  rounded-full">Home</router-link>
                            </li>
                            <li>
                                <router-link to="" class="py-2 pr-4 pl-3  font-bold rounded-full  ">About</router-link>
                            </li>
                            <li>
                                <button @click="notificationShowSideBar = !notificationShowSideBar" to="" class="relative w-10 h-10 bg-gray-200  font-bold rounded-full hover:bg-gray-300 "
                                    :class="{'text-red-500':notifications}">
                                    <i class="fa-regular fa-bell text-2xl"></i>
                                    <span v-if="notifications" class="absolute bottom-[80%] right-0 bg-orange-500 text-white rounded-full w-5 h-5"> {{ notifications.length }} </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-6">
                    <router-view :key="$route.fullPath"></router-view>
                </div>

                <!-- notification sidebar -->
                <div v-if="notificationShowSideBar" class="fixed top-0 right-0 z-50 bg-gray-200 w-96">
                    <button @click="notificationShowSideBar = !notificationShowSideBar" 
                    class="flex items-center justify-center mx-4 my-2 text-left border-2 border-gray-200 
                    rounded-full w-10 h-10 bg-white">
                        <i class="fa-solid fa-xmark  text-2xl"></i>
                    </button>

        
                    <div class="nontification my-10 px-4">
                        <div v-for="notification in notifications" :key="notification.id" class="flex my-4">
                            <div v-if="notification.data.contact_subject" class="w-20 h-20  rounded-full relative">
                                <img class="absolute w-full h-full rounded-full object-cover" src="https://thumbs.dreamstime.com/b/profile-picture-smiling-caucasian-male-employee-close-up-young-businessman-show-leadership-qualities-headshot-portrait-happy-204044575.jpg" alt="">
                                <i class="absolute bottom-0 right-0 text-xl bg-white rounded-full 
                                    w-7 h-7 flex justify-center
                                 items-center fa-regular fa-envelope z-10"></i>
                            </div>
                            <div class="px-2">
                                <p class="text-gray-600 font-bold">{{ notification.data.contact_subject }} </p>
                                <p v-if="notification.data.contact_message" class="w-64 text-sm text-gray-600 font-md">
                                    {{ notification.data.contact_message.substring(0,70) +('....')  }} 
                                </p>
                                <span class="text-blue-800 font-semibold"> {{ notification.created_data }} </span>
                            </div>
                        </div>
                        
                        <!-- <div v-for="notification in notifications" :key="notification.id"  class="">
                            <div v-if="notification.data.contact_subject" class="v-if">
                                {{ notification.data.contact_subject }}
                            </div>
                        </div> -->
                    </div>
                </div>
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

            notifications:[],
            notificationShowSideBar:false,
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
    mounted(){
        axios.get('/notifications')
        .then(res =>{
            this.notifications = res.data;
        })
    }
   
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
