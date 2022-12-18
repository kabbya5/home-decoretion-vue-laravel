<template>
    <div class="w-full">
        <header class="">
            <!-- TOP NAV -->
            <nav class="py-4  px-1 z-50 bg-white md:px-4 fixed top-0 w-full border-b-2 border-gray-200" id="top-nav">
                <div class="flex justify-between items-center">
                    <router-link :to="{name:'home'}" href="" class="flex items-center">
                        <img :src="siteSetting.title_image" class="mr-3 h-10" :alt="siteSetting.page_title" />
                        <span class="hidden md:block self-center text-xl font-semibold whitespace-nowrap">{{ siteSetting.page_title }}</span>
                    </router-link>
                    <div >
                        <ul>
                            <li class="border-2 px-2 w-full md:w-96 xl:w-[600px] relative">
                                <form @mouseenter="(search=true)" @mouseleave="(search=false)" class="w-full">
                                    <div class="flex items-center">
                                        <input v-model="searchKeyword" type="search" class="px-4 text-green-800 font-bold bg-transparent w-full py-2 
                                            focus:outline-none"
                                            placeholder="Search..">
                                            <i class="fa-solid fa-magnifying-glass text-green-800 font-bold text-2xl"></i>
                                    </div>
                                    <div v-if="search" class="absolute w-full bg-white -mx-2 px-2">
                                        <ul v-if="(tags.length > 0)" class="overflow-x-auto">
                                            <li v-for="tag in tags" :key="tag.id"> 
                                               <router-link :to="{name:'tagShopPage',params:{tagSlug:tag.slug}}" class="border-b-2 border-gray-200 flex items-center">
                                                    <img v-if="tag.image" class="w-10 h-10 mx-2" :src="tag.image.product_img" :alt="tag.tag_name">
                                                    {{ tag.tag_name }}
                                               </router-link>
                                            </li>    
                                        </ul>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="hidden lg:block">
                        <ul class="flex items-center md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                           
                            <li>
                                <router-link to="/user/cart" class="block py-2 pr-4 pl-3 text-black  font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-heart fa-2x relative">
                                        <span class="absolute top-[-21px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            
                                        </span>
                                    </i>
                                </router-link>
                            </li>
                            <li class="">
                                <router-link :to="{name:'cart-content'}" class="block py-2 pr-4 pl-3 text-black font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"> 
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span class="absolute top-[-20px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            {{ cart.count }}
                                        </span>
                                    </i>
                                    {{ cart.subtotal }} TK
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <button @click='responsiveNav = !responsiveNav' type="button" class="inline-flex justify-center items-center mr-2 
                        transition duration-300 text-green-800 font-bold hover:text-gray-900">
                        <i class="fa-solid fa-bars fa-2x"></i>
                    </button>
                </div>
            </nav>

            <!-- BOTTOM NAV -->

            <nav class="py-2 px-1 mt-[90px] md:px-4 hidden md:block" id="bottom-nav">
                <div class="flex flex-wrap justify-between items-center mx-auto">
                    <div class="justify-between items-center w-full md:flex md:w-auto md:order-1">
                        <ul class="mid-nav my-4 flex flex-col md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                            <li>
                                <router-link to="/"  class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    Home
                                </router-link>
                            </li>
                            <li>
                                <a href="#" class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
                            </li>
                            <li>
                                <router-link :to="{name:'contact'}"  class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    Contact
                                </router-link>
                            </li>
                            <li>
                                <router-link v-if="!currentUser.slug" to="/login"  class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    Login/Register
                                </router-link>
                            </li>
                            <li>
                                <router-link v-if="currentUser.slug" :to="{name:'resent-view-product',params:{slug:currentUser.slug}}"  class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    Resent view
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="mid-nav justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                        <ul class="flex flex-col items-center md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                            <!-- <li>
                                <router-link to="/login" class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    <i class="fa-regular fa-user text-2xl"></i>
                                </router-link>
                            </li> -->
                            <li v-if="currentUser.slug" class="mb-2">
                                <router-link :to="{name:'userDashboard',params:{userSlug:currentUser.slug?currentUser.slug:' '}}" class="relative block flex items-center justify-center w-10 h-10 bg-gray-200  font-bold rounded-full hover:bg-gray-300"
                                    >
                                    <!-- :class="{'text-red-500':notifications} -->
                                    <img v-if="currentUser.image" :src="currentUser.image" alt="currentUser.slug" class="w-full h-full rounded-full">
                                    <i v-else  class="fa-regular fa-user text-2xl"></i>
                                    <!-- <span v-if="notifications" class="absolute bottom-[80%] right-0 bg-orange-500 text-white rounded-full w-5 h-5"> {{ notifications.length }} </span> -->
                                </router-link>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- RESPONSIVE NAV  -->

            <div v-if="responsiveNav" id="responsive-nav" class="fixed shadow-md bg-slate-200/60 z-50 w-full">
                <div class="w-[330px] bg-white">
                    <button @click='responsiveNav = !responsiveNav' type="button" class="mx-2 my-2 w-full text-right
                        transition duration-300 text-black hover:text-red-900"> 
                        <i class="fa-solid fa-xmark fa-2x mr-4"></i>
                    </button>
                    <div class="flex flex-col justify-center my-3">
                        <ul class="flex  justify-around items-center md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                            <li class="px-2 py-1">
                                <a href="#" class="block py-2 pr-4 pl-3 text-gray-600 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span class="absolute top-[-20px] right-[-20px] bg-red-800 w-8 h-8 flex items-center justify-center text-sm rounded-full text-green-800">
                                            22
                                        </span>
                                    </i>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-gray-600 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-heart fa-2x relative">
                                        <span class="absolute top-[-20px] right-[-20px] bg-red-800 w-8 h-8 flex items-center justify-center text-sm rounded-full text-green-800">
                                            {{ cart.count }}
                                        </span>
                                    </i>
                                </a>
                            </li>
                            <li class="mb-[15px]">
                                <a href="#" class="block py-2 pr-4 pl-3 text-gray-600 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-user fa-2x">
                                        
                                    </i>
                                </a>
                            </li>
                        </ul>
                        <div class="button flex justify-center border-b-2 border-gray-200 my-4 pb-3">
                            <button v-on:click="menuBtnToggler" type="boutton" class="bg-green-800 text-white uppercase px-4 py-1 transition duration-300 hover:bg-green-600">
                                {{ menuBtn=='category' ? 'menu':'category' }} 
                            </button>
                        </div>
                        <div v-if="menuBtn =='category'" class="bg-gray-100 h-screen px-2 py-2">
                            <h4 class="text-center font-bold text-gray-600 uppercase mb-4">
                                All Category 
                            </h4>
                            <ul class="flex flex-col uppercase">
                                <li v-for="cat in navCats" :key="cat.id" 
                                    @mouseenter="showSubcategory = cat.id" 
                                    @mouseleave="showSubcategory = false"                 
                                    class="cat-li flex px-4 py-1 border-2 
                                        border-slate-200 items-center">

                                    <img :src="cat.categoryImg" :alt="cat.categoryImgName"
                                        class="w-10 h-10 rounded-md">
                                    <router-link @click="responsiveNav =!responsiveNav" :to="{name:'categoryShopPage',params:{catSlug:cat.slug}}" class="text-green-800 font-bold ml-4">
                                        {{cat.categoryName}}
                                    </router-link>
                                    

                                    <button v-if="cat.subcategories.length >0" 
                                        class="absolute right-2 px-3 bg-slate-200/60 h-full">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>

                                    <ul v-if="(showSubcategory === cat.id && cat.subcategories.length > 0)" class="subcat-ul flex flex-col bg-gray-100 z-10 px-2 py-6 
                                        border-2 border-gray-200 shadow-md">
                                        <li  v-for="subcat in cat.subcategories" :key="subcat.id"
                                            @mouseenter="showChildcategory = subcat.id" 
                                            @mouseleave="showChildcategory = false"
                                            class="pl-2 py-2  border-2 bg-white flex justify"> 
                                            <router-link @click="responsiveNav =!responsiveNav" :to="{name:'subCategoryShopPage',params:{subCatSlug:subcat.slug}}" class="text-green-800 font-bold ml-4">
                                                {{subcat.subCatName}}
                                            </router-link>

                                            <button v-if="subcat.childcategories.length >0" 
                                                class="absolute right-2 px-3 bg-slate-200/60">
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>

                                    
                                            <ul v-if="(showChildcategory === subcat.id && subcat.childcategories.length > 0)" 
                                            class="px-4 absolute left-[90%] bg-gray-100 z-50 w-[100%] py-4 top[-10px]">
                                                <li  v-for="childcat in subcat.childcategories" :key="childcat.id"
                                                    class="my-1 py-2 px-2 border-2 border-gray-200">
                                                    <router-link @click="responsiveNav =!responsiveNav" :to="{name:'childCategoryShopPage',params:{childCatSlug:childcat.slug}}" class="text-green-800 font-bold ml-4">
                                                        {{ childcat.childCatName }}
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                            </ul> 
                        </div>
                        <div  class="px-4 my-3">
                            <h4 class="text-center font-bold text-gray-600 uppercase mb-4">
                                All  Menu
                            </h4>
                            <div class="w-full md:w-auto md:order-1">
                                <ul class="responsive-nav my-4 h-screen">
                                    <li class="my-4">
                                        <router-link to="/"  class="text-xl  py-2 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                            Home
                                        </router-link>
                                    </li>
                                    <li class="my-4">
                                        <router-link to="/email/verification"  class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                            email/verification
                                        </router-link>
                                    </li>
                                    <li class="my-4">
                                        <a href="#" class="text-xl py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-xl block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
                                    </li>
                                    <li>
                                        <router-link to="/login" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                            login / register
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </header>
    </div>    
</template>
<script>
export default{
    name:'Navbar',
    data(){
        return{
            responsiveNav:false,
            menuBtn:'category',
            showSubcategory:'',
            showChildcategory:'',
            navCats:[],
            subcategories:[],
            siteSetting:[],
            //search 
            search:false,
            searchKeyword:'',
            tags:[],
            currentUser:{
                slug:'',
                image:'',
            },

            cart:'',
            
        }
    },
    watch:{
        searchKeyword(newValue, oldValue){
            this.getTags();
        }
    },
    methods:{
        menuBtnToggler: function () {
            this.menuBtn = this.menuBtn == 'category' ? 'menu' : 'category';
        },
        getSubcategory(cat){   
            this.showSubcategory = this.showSubcategory == true ? false :true;
        },
        getTags(){
            if(this.searchKeyword){
                axios.get('/search/tags/',{params:{searchTag:this.searchKeyword}})
                .then(res => this.tags = res.data)
                .catch(errors=>{

                })
            }else{
                this.tags = {};
            }
            
        },     
    },
    mounted(){
        axios.get('/navbar/category')
        .then(res => {
            this.navCats = res.data;
        }),
        axios.get('/get/navbar/site/setting')
        .then(res =>{
            this.siteSetting = res.data;
        }),
        axios.get('/cart/content')
        .then(res => {
            this.cart = res.data;
        })
    },
    created(){
        this.currentUser.slug = document.querySelector("meta[name='user-slug']").getAttribute('content');
        this.currentUser.image = document.querySelector("meta[name='user-img']").getAttribute('content');
    }
}
</script>
<style scoped>

    .mid-nav .router-link-active,.mid-nav.router-link-exact-active:after{
        width: 100%;
        height: 4px;
    }
    .mid-nav a{
        position: relative;
    }
    .mid-nav a:after{
        position: absolute;
        content: '';
        width: 0;
        height: 3px;
        background-color: #275c53;
        bottom:0;
        left: 50%;
        transform: translateX(-50%);
        transition: all 0.4s;
    }
    .mid-nav .router-link-active:after{
        bottom:-30px;
        width:100%;
    }
    .mid-nav a:hover::after{
        width: 100%;
        bottom:-5px;
    }
    
    .responsive-nav .router-link-active,.mid-nav.router-link-exact-active:after{
        width: 100%;
        height: 4px;
    }
    .responsive-nav a{
        position: relative;
    }
    .responsive-nav a:after{
        position: absolute;
        content: '';
        width: 0;
        height: 3px;
        background-color: #275c53;
        bottom:0;
        left: 50%;
        transform: translateX(-50%);
        transition: all 0.4s;
    }
    .responsive-nav .router-link-active:after,
        .responsive-nav a:hover::after{
        width: 100%;
        bottom:-4px;
    }
    

</style>>
