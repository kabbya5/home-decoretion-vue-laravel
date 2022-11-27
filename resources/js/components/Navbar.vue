<template>
    <div class="w-full">
        <header class="">
            <!-- TOP NAV -->
            <nav class="py-3 px-1 z-10 bg-white md:px-4 fixed top-0 w-full border-b-2 border-gray-200" id="top-nav">
                <div class="flex justify-between items-center">
                    <a href="" class="flex items-center">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-10" alt="Flowbite Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap">Flowbite</span>
                    </a>
                    <div >
                        <ul>
                            <li class="border-2 px-2 w-full md:w-96 xl:w-[600px]">
                                <form action="" class="w-full">
                                    <div class="flex items-center">
                                        <input type="search" class="px-4 text-green-800 font-bold bg-transparent w-full py-2 
                                            focus:outline-none"
                                            placeholder="Search..">
                                            <i class="fa-solid fa-magnifying-glass text-green-800 font-bold text-2xl"></i>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        
                    </div>
                    <div class="hidden md:block">
                        <ul class="flex items-center md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                           
                            <li>
                                <router-link to="/user/cart" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span class="absolute top-[-20px] right-[-20px] bg-red-800 w-8 h-8 flex items-center justify-center text-sm rounded-full text-green-800">
                                            22
                                        </span>
                                    </i>
                                </router-link>
                            </li>
                            <li class="">
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"> 
                                    <i class="fa-solid fa-cart-shopping fa-2x relative">
                                        <span class="absolute top-[-20px] right-[-20px] bg-red-800 w-8 h-8 flex items-center justify-center text-sm rounded-full text-white">
                                            22
                                        </span>
                                    </i>
                                </a>
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

            <nav class="py-2 px-1 mt-[70px] md:px-4 hidden md:block" id="bottom-nav">
                <div class="flex flex-wrap justify-between items-center mx-auto">
                    <div class="justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                        <ul class="flex flex-col md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                            <li>
                                <router-link to="/"  class="block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    Home
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/email/verification"  class="block py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">
                                    email/verification
                                </router-link>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
                            </li>
                            <li>
                                <router-link to="/login" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    login / register
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="justify-between items-center w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                        <ul class="flex flex-col items-center md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 ">
                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">
                                    <i class="fa-regular fa-user"></i>
                                </a>
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
                                            22
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
                                {{ menuBtn }} 
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
                                    <a href="" class="text-green-800 font-bold ml-4">
                                        {{cat.categoryName}}
                                    </a>
                                    

                                    <button v-if="cat.subcategories.length >0" 
                                        class="absolute right-2 px-3 bg-slate-200/60 h-full">
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>

                                    <ul v-if="showSubcategory === cat.id" class="subcat-ul flex flex-col bg-gray-100 z-10 px-2 py-6 
                                        border-2 border-gray-200 shadow-md">
                                        <li  v-for="subcat in cat.subcategories" :key="subcat.id"
                                            @mouseenter="showChildcategory = subcat.id" 
                                            @mouseleave="showChildcategory = false"
                                            class="pl-2 py-2  border-2 bg-white flex justify"> 
                                            <a href="">
                                                {{ subcat.subCatName }}
                                            </a>

                                            <button v-if="subcat.childcategories.length >0" 
                                                class="absolute right-2 px-3 bg-slate-200/60">
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>

                                    
                                            <ul v-if="showChildcategory === subcat.id" 
                                            class="px-4 absolute left-[90%] bg-gray-100 z-50 w-[90%] py-4 top[-10px]">
                                                <li v-for="childcat in subcat.childcategories" :key="childcat.id"
                                                    class="my-1 py-2 px-2 border-2 border-gray-200">
                                                    <a href="">
                                                        {{ childcat.childCatName }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul> 
                                </li>
                            </ul> 
                        </div>
                        <div v-else class="px-4 my-3">
                            <h4 class="text-center font-bold text-gray-600 "> All Menu </h4>
                            <div class="w-full md:w-auto md:order-1">
                                <ul class="flex flex-col justify-center md:mt-0 md:text-sm md:font-medium md:border-0 ">
                                    <li>
                                        <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold  rounded md:bg-transparent md:p-0">Home</a>
                                    </li>
                                    <li>
                                        <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">About</a>
                                    </li>
                                    <li>
                                        <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Services</a>
                                    </li>
                                    <li>
                                        <a href="#" class="py-2 pr-4 pl-3 text-green-800 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0">Contact</a>
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
        }
    },
    methods:{
        menuBtnToggler: function () {
            this.menuBtn = this.menuBtn == 'category' ? 'menu' : 'category';
        },
        getSubcategory(cat){   
            this.showSubcategory = this.showSubcategory == true ? false :true;
        },
        
    },
    mounted(){
        axios.get('/api/navbar/category')
        .then(res => {
            this.navCats = res.data;
        })
    }
}
</script>