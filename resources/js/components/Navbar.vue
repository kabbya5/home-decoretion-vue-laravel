<template>
    <div class="w-full">
        <header class="mb-[90px] lg:mb-0">
            <!-- RESPONSIVE NAV  -->
            <nav class="py-4 lg:hidden px-1 bg-white md:px-4 fixed top-0 z-10 w-full " id="top-nav">
                <div class="flex-col justify-between items-center">
                    <div class="flex justify-between items-center">
                        <router-link :to="{name:'home'}" href="" class="flex items-center">
                            <img :src="siteSetting.title_image" class="mr-3 h-10" :alt="siteSetting.page_title" />
                            <span class="hidden md:block self-center text-xl font-semibold whitespace-nowrap">{{ siteSetting.page_title }}</span>
                        </router-link>
                        <div class="lg:hidden">
                            <ul class="flex items-center md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">    
                                <li>
                                    <router-link v-if="wishlistCount" :to="{name:'wishlist'}" class="block py-2 pr-4 pl-3 text-black  font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                        <i class="fa-regular fa-heart fa-2x relative">
                                            <span class="absolute top-[-21px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                                {{ wishlistCount }}
                                            </span>
                                        </i>
                                    </router-link>
                                </li>
                                <li class="">
                                    <router-link :to="{name:'cart-content'}" class="block py-2 pr-4 pl-3 text-black font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"> 
                                        <i class="fa-solid fa-cart-shopping fa-2x relative">
                                            <span  class="absolute top-[-20px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                                {{ cart.count }}
                                            </span>
                                        </i>
                                        {{ cart.subtotal }} TK 
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="flex">
                            <button @click='showSearchInput = !showSearchInput' type="button" class="inline-flex justify-center items-center mr-8  
                                transition duration-300 text-gray-500 font-bold hover:text-gray-900">
                                <i class="fa-solid fa-magnifying-glass text-gray-500 font-bold text-2xl"></i>
                            </button>
                            <button @click='responsiveNav = !responsiveNav' type="button" class="inline-flex justify-center items-center mr-2 
                                transition duration-300 text-gray-500 font-bold hover:text-gray-900">
                                <i class="fa-solid fa-bars fa-2x"></i>
                            </button>
                        </div>
                        
                    </div>
                    
                    <div v-if="showSearchInput" class="my-4">
                        <ul>
                            <li class="border-2 px-2 mx-auto w-full md:w-96 xl:w-[600px] relative">
                                <form @mouseenter="(search=true)" @mouseleave="(search=false)" class="w-full">
                                    <div class="flex items-center">
                                        <input v-model="searchKeyword" type="search" class="px-4 text-gray-500 font-bold bg-transparent w-full py-2 
                                            focus:outline-none"
                                            placeholder="Search..">
                                            <i class="fa-solid fa-magnifying-glass text-gray-500 font-bold text-2xl"></i>
                                    </div>
                                    <div v-if="search" class="absolute w-full bg-white -mx-2 px-2">
                                        <ul v-if="(tags.length > 0)" class="overflow-x-auto">
                                            <li v-for="tag in tags" :key="tag.id" class="my-2"> 
                                               <router-link :to="{name:'tagShopPage',params:{tagSlug:tag.slug}}" class="border-b-2 border-gray-200 flex items-center py-2">
                                                    <img v-if="tag.image" class="w-20 h-20 mx-4 rounded-md" :src="tag.image.product_img" :alt="tag.tag_name">
                                                    {{ tag.tag_name }}
                                               </router-link>
                                            </li>    
                                        </ul>
                                    </div>
                                </form>
                            </li>
                        </ul>    
                    </div>
                </div>
            </nav>
            <div v-if="responsiveNav" id="responsive-nav" class="fixed z-[100] top-0 left-0 shadow-md bg-slate-200/60 z-50 w-full overflow-auto">
                <div class="w-[330px] bg-white">
                    <button @click='responsiveNav = !responsiveNav' type="button" class="mx-2 my-2 w-full text-right
                        transition duration-300 text-black hover:text-red-900"> 
                        <i class="fa-solid fa-xmark fa-2x mr-4"></i>
                    </button>
                    <div class="flex flex-col justify-center my-3">
                        <ul class="flex justify-around items-center md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                        
                            <li>
                                <router-link @click="responsiveNav =!responsiveNav" :to="{name:'wishlist'}" class="block py-2 pr-4 pl-3 text-black  font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-heart fa-2x relative">
                                        <span class="absolute top-[-21px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            {{ wishlistCount }}
                                        </span>
                                    </i>
                                </router-link>
                            </li>
                            <li>
                                <router-link @click="responsiveNav =!responsiveNav" :to="{name:'cart-content'}" class="block py-2 pr-4 pl-3 text-black font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"> 
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span  class="absolute top-[-20px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            {{ cart.count }}
                                        </span>
                                    </i> 
                                </router-link>
                            </li>
                            <li v-if="currentUser" class="mb-2">
                                <router-link @click="responsiveNav =!responsiveNav" :to="{name:'user-dashboard',params:{userSlug:currentUser.slug}}" class="relative block flex items-center justify-center w-10 h-10 bg-gray-200  font-bold rounded-full hover:bg-gray-300"
                                > 
                                    <img v-if="currentUser.profile_img" :src="'/' + currentUser.profile_img" :alt="currentUser.user_name" class="w-full h-full rounded-full">
                                    <i v-else  class="fa-regular fa-user text-2xl"></i>
                                    <span v-if="notifications" class="absolute bottom-[80%] right-0 bg-orange-500 text-white rounded-full w-5 h-5"> {{ notifications.length }} </span>
                                </router-link>
                            </li>

                            
                        </ul>
                        <div class="button flex justify-center border-b-2 border-gray-200 my-4 py-6">
                            <button v-on:click="menuBtnToggler" type="boutton" class="bg-green-800 text-white uppercase px-4 py-1 transition duration-300 hover:bg-green-600">
                                {{ menuBtn=='category' ? 'menu':'category' }} 
                            </button>
                        </div>
                        <div v-if="menuBtn =='category'" class="bg-gray-100 h-screen px-2 py-2">
                            <h4 class="text-center font-bold text-gray-600 uppercase mb-4">
                                All Category 
                            </h4>
                            <ul class="mx-1 overflew-auto absolute w-[300px] h-full">
                                <li v-for="cat in navCats" :key="cat.id" 
                                    @click="showResponsiveSubcategory =showResponsiveSubcategory==cat.id?'false':cat.id"                  
                                    class="cat-li  border-b-2 border-gray-200  py-2">
                                        <div class="flex items-center">
                                            <img :src="'/'+cat.categoryImg" :alt="cat.categoryImgName"
                                            class="w-8 h-8 rounded-full">
                                            <router-link v-if="cat.slug" @click="responsiveNav =!responsiveNav" :to="{name:'categoryShopPage',params:{catSlug:cat.slug}}" class="ml-4 capitalize">
                                                {{cat.categoryName}}
                                            </router-link>
                                            
                                            <button v-if="cat.subcategories.length >0" 
                                                class="text-right right-2 px-4 bg-slate-200/60 h-full">
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>
                                        </div>

                                    <ul v-if="(showResponsiveSubcategory === cat.id && cat.subcategories.length > 0)" class="subcat-ul  flex flex-col bg-gray-100  py-2">
                                        <li  v-for="subcat in cat.subcategories" :key="subcat.id"
                                            @mouseenter="showChildcategory = subcat.id" 
                                            @mouseleave="showChildcategory = false"
                                            class="pl-2 py-2 font-bold "> 
                                            <router-link @click="responsiveNav =!responsiveNav" :to="{name:'subCategoryShopPage',params:{subCatSlug:subcat.slug}}" class="ml-4 capitalize">
                                                {{subcat.subCatName}}
                                            </router-link>

                                            <ul v-if="(subcat.childcategories.length > 0)" 
                                                class="px-2 bg-gray-100 z-50 py-1">
                                                    <li  v-for="childcat in subcat.childcategories" :key="childcat.id"
                                                        class="px-2 font-semibold text-gray-500">
                                                        <router-link @click="responsiveNav =!responsiveNav" :to="{name:'childCategoryShopPage',params:{childCatSlug:childcat.slug}}" class="ml-4 capitalize">
                                                            {{ childcat.childCatName }}
                                                        </router-link>
                                                    </li>
                                                </ul>
                                        </li>
                                   
                                    </ul>
                                   
                                </li>
                            </ul>
                        </div>
                        <div v-if="menuBtn =='menu'" class="px-4 my-3">
                            <h4 class="text-center font-bold text-gray-600 uppercase mb-4">
                                All  Menu
                            </h4>
                            <div class="w-full md:w-auto md:order-1">
                                <ul class="responsive-nav my-4 h-screen">
                                    <li class="my-4">
                                        <router-link @click="responsiveNav =!responsiveNav" :to="{name:'home'}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                            Home
                                        </router-link>
                                    </li>
                                    <li class="my-4">
                                        <router-link @click="responsiveNav =!responsiveNav" :to="{name:'other-page',params:{slug:'somthing'}}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                            new-page 
                                        </router-link>
                                    </li>
                                    <li class="my-4">
                                        <router-link @click="responsiveNav =!responsiveNav" :to="{name:'shop-page'}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                            Shop page
                                        </router-link>
                                    </li>
                                    <li v-if="!currentUser">
                                        <router-link @click="responsiveNav =!responsiveNav"  to="/login"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                            Login/Register
                                        </router-link>
                                    </li>
                                    <li v-if="currentUser">
                                        <router-link @click="responsiveNav =!responsiveNav" :to="{name:'resent-view-product',params:{slug:currentUser.slug}}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                            Resent view
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- end  -->

            <!-- laptop -->
            
            <!-- TOP NAV -->
            <nav class="py-4 hidden lg:block  px-1 z-50 bg-white md:px-4 fixed top-0 w-full border-b-2 border-gray-200" id="top-nav">
                <div class="flex justify-between items-center">
                    <router-link :to="{name:'home'}" href="" class="flex items-center">
                        <img :src="siteSetting.title_image" class="mr-3 h-10" :alt="siteSetting.page_title" />
                        <span class="hidden md:block self-center text-xl font-semibold whitespace-nowrap">{{ siteSetting.page_title }}</span>
                    </router-link>
                    <div>
                        <ul>
                            <li class="border-2 px-2 w-full md:w-96 xl:w-[600px] relative">
                                <form @mouseenter="(search=true)" @mouseleave="(search=false)" class="w-full">
                                    <div class="flex items-center">
                                        <input v-model="searchKeyword" type="search" class="px-4 text-gray-500 font-bold bg-transparent w-full py-2 
                                            focus:outline-none"
                                            placeholder="Search..">
                                            <i class="fa-solid fa-magnifying-glass text-gray-500 font-bold text-2xl"></i>
                                    </div>
                                    <div v-if="search" class="absolute w-full bg-white -mx-2 px-2">
                                        <ul v-if="(tags.length > 0)" class="overflow-x-auto">
                                            <li v-for="tag in tags" :key="tag.id" class="my-2"> 
                                               <router-link :to="{name:'tagShopPage',params:{tagSlug:tag.slug}}" class="border-b-2 border-gray-200 flex items-center py-2">
                                                    <img v-if="tag.image" class="w-20 h-20 mx-4 rounded-md" :src="tag.image.product_img" :alt="tag.tag_name">
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
                                <router-link v-if="wishlistCount" :to="{name:'wishlist'}" class="block py-2 pr-4 pl-3 text-black  font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-heart fa-2x relative">
                                        <span class="absolute top-[-21px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            {{ wishlistCount }}
                                        </span>
                                    </i>
                                </router-link>
                            </li>
                            <li class="">
                                <router-link :to="{name:'cart-content'}" class="block py-2 pr-4 pl-3 text-black font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"> 
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span  class="absolute top-[-20px] right-[-20px] bg-orange-600 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            {{ cart.count }}
                                        </span>
                                    </i>
                                    {{ cart.subtotal }} TK 
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <button @click='responsiveNav = !responsiveNav' type="button" class="inline-flex justify-center items-center mr-2 
                        transition duration-300 text-gray-500 font-bold hover:text-gray-900">
                        <i class="fa-solid fa-bars fa-2x"></i>
                    </button>
                </div>
            </nav>
            <!-- BOTTOM NAV -->

            <div class="xl:container xl:mx-auto">
                <nav class="hidden px-1 overflow-hidden lg:mt-[90px]  md:px-4 lg:block" id="bottom-nav">
                    <div class="flex flex-wrap justify-between items-center mx-auto">
                        <div class="justify-between items-center w-full md:flex md:w-auto md:order-1">
                            <ul class="mid-nav my-4 flex flex-col md:flex-row md:space-x-4 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                                <li>
                                    <router-link :to="{name:'home'}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        Home
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name:'other-page',params:{slug:'somthing'}}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        new-page 
                                    </router-link>
                                </li>
                                <li v-for="cat in navCats" :key="cat.id" 
                                @mouseenter="showSubcategory = cat.id" 
                                @mouseleave="showSubcategory = false"
                                class="relative z-40">

                                    <router-link :to="{name:'categoryShopPage',params:{catSlug:cat.slug}}"  class="text-xl block py-2 pl-2 text-slate-500 font-bold capitalize">
                                       {{ cat.categoryName }}
                                    </router-link>

                                    <div v-if="(showSubcategory === cat.id && cat.subcategories.length > 0)" class="child-category absolute top-[100%] w-screen z-10 border-t-2 border-gray-200">
                                        <div class="flex mb-10 bg-white px-4">
                                            <div class="py-9 fixed left-0 right-2 w-screen">
                                            <ul class="subcat-ul  flex  bg-gray-100  py-2">
                                                <li  v-for="subcat in cat.subcategories" :key="subcat.id"
                                                    class="pl-2 py-2 font-bold text-black"> 
                                                    <router-link @click="responsiveNav = false" :to="{name:'subCategoryShopPage',params:{subCatSlug:subcat.slug}}" class="ml-4 capitalize">
                                                        {{subcat.subCatName}}
                                                    </router-link>
                                                    <ul class="childcat-ul px-2 bg-gray-100 z-50 py-2">
                                                            <li  v-for="childcat in subcat.childcategories" :key="childcat.id"
                                                                class="my-1 py-2 px-2">
                                                                <router-link @click="responsiveNav = false" :to="{name:'childCategoryShopPage',params:{childCatSlug:childcat.slug}}" class="ml-4 capitalize">
                                                                    {{ childcat.childCatName }}
                                                                </router-link>
                                                            </li>
                                                    </ul>
                                                </li>
                                           
                                            </ul>
                                           
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                
                                <li>
                                    <router-link :to="{name:'shop-page'}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        Shop page
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name:'contact'}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        Contact
                                    </router-link>
                                </li>
    
                                <li v-if="!currentUser">
                                    <router-link  to="/login"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        Login/Register
                                    </router-link>
                                </li>
                                <li v-if="currentUser">
                                    <router-link  :to="{name:'resent-view-product',params:{slug:currentUser.slug}}"  class="text-xl block py-2 pr-4 pl-3 text-gray-500 font-bold  capitalize">
                                        Resent view
                                    </router-link>
                                </li>
                            </ul>
                            
                        </div>
                        <div class="mid-nav justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                            <ul class="flex flex-col items-center md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                                <li v-if="notifications">
                                    <router-link :to="{name:'orders', params:{slug:currentUser.slug}}" class="relative block py-1 pl-3 pr-4 text-white rounded hover:text-gray-100"> 
                                        <i class="fa-solid fa-bell fa-2x"></i>
                                        <span class="bg-[#FE0000] text-white w-[17px] h-[17px] rounded-full absolute flex items-center justify-center top-0 right-3"> {{ notifications }} </span>
                                    </router-link>
                                </li>
                                <li v-if="currentUser" class="mb-2">
                                    <router-link :to="{name:'user-dashboard',params:{userSlug:currentUser.slug}}" class="flex items-center justify-center w-10 h-10 bg-gray-200  font-bold rounded-full hover:bg-gray-300"
                                    > 
                                        <img v-if="currentUser.profile_img" :src="'/' + currentUser.profile_img" :alt="currentUser.user_name" class="w-full h-full rounded-full">
                                        <i v-else  class="fa-regular fa-user text-2xl"></i>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>  
        </header>
    </div>    
</template>
<script>
import { mapGetters } from 'vuex';
export default{
    name:'Navbar',
    data(){
        return{
            showSearchInput:false,
            responsiveNav:false,
            menuBtn:'category',
            showSubcategory:'',
            showResponsiveSubcategory:'',
            showChildcategory:'',
            navCats:[],
            subcategories:[],

            //search 
            search:false,
            searchKeyword:'',
            tags:[],   
            
        }
    },
    computed:{
        ...mapGetters({
            currentUser:'currentUser',
            cart:'cart',
            wishlistCount:'wishlistCount',
            siteSetting:'siteSetting',
            notifications:'notifications',
        })
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
        this.$store.dispatch('fetchNavbarContent');
    },
}
</script>
<style scoped>
    .mid-nav a{
        color:rgb(64, 72, 79);
        font-weight: 500;
    }
    .mid-nav .subcat-ul a{
        color:rgb(32, 33, 34);
        font-weight: 600;
        font-size: 20px;
    }
    .mid-nav .subcat-ul .childcat-ul a{
        color:rgb(32, 33, 34);
        font-weight: 600;
        font-size: 16px;
    }
    .mid-nav .router-link-active,
    .mid-nav a:hover,
    .mid-nav .childcat-ul a:hover{
        color:rgb(105, 120, 6);
        transition-duration: 3s all;
    }
  
    

</style>>
