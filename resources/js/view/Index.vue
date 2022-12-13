<template>
    <div>
        <!-- Banner  -->
        <Slider class="mt-20 lg:mt-0" :sliders="sliders"> 

        </Slider>
        <!-- End banner  -->

        <!-- Entery  -->
        <div class="entery container mx-auto my-4">
            <div class="grid grid-cols-4 gap-4 border-2 border-gray-200 py-6">
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> Upto 400 tk</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-sack-dollar fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Money guarantee</h2>
                            <p class="pt-2 text-gray-500">  within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-headphones fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Online support </h2>
                            <p class="pt-2 text-gray-500">  available 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-money-check-dollar fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Pay with Multiple </h2>
                            <p class="pt-2 text-gray-500">  Credit Cards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-center">
                <h4 class="text-black uppercase font-bold text-[30px]">
                    All Popular Category 
                    <span v-if="loading" class="text-yellow-600 text-sm font-bold text-right"> loding... </span>
                </h4>
            </div>

            <div class="grid grid-cols-6 gap-2">
                <div class="bg-white h-[200px] md:h-full lg:h-[405px] col-span-2 md:row-span-2 md:col-span-2 xl:col-span-2">
                    <router-link :to="{name:'categoryShopPage',params:{catSlug:firstCategory.slug}}">
                        <div class="h-full relative overflow-hidden">
                            <img class="block object-cover boject-center w-full h-full brightness-75
                                transition duration-300 hover:scale-[1.2]" 
                                :src="firstCategory.categoryImg"  :alt="firstCategory.categoryImgName">
                            <p class="text-2xl font-bold absolute bottom-3 w-full left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                                {{ firstCategory.categoryName }}
                            </p>
                        </div>
                    </router-link>
                    
                </div>
                <div v-for="category in showCategories" :key="category.id" class="h-[200px] bg-white col-span-2 md:col-span-2 xl:col-span-1">
                    <router-link :to="{name:'categoryShopPage',params:{catSlug:category.slug}}">
                        <div class="h-full w-full relative overflow-hidden">
                            <img class="block object-cover boject-center w-full h-full 
                                transition duration-300 -z-1 hover:scale-[1.2] hover:brightness-75" 
                                :src="category.categoryImg"  :alt="category.categoryImgName">
                            <p class="text-2xl w-full font-bold absolute bottom-3 left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                                {{ category.categoryName }}
                            </p>
                        </div>
                    </router-link>
                    
                </div>
            </div>
            <div @click="loadMoreButton">
                <div v-if="loadMore" class="text-right pt-3 text-gray-500 capitalize font-semibold">
                    {{ moreCategoies }}  More categories 
                </div>
                <div v-if="loadMore" class="flex justify-center my-4">
                    <button  class="uppercase bg-slate-900 px-4 py-2 rounded-lg text-white
                    transition duration-300 hover:bg-indigo-600">
                        {{ loadMoreButtonMessage }}
                        <i class="fa-solid fa-repeat ml-1"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- END Category  -->

        <!-- Week Sale Product  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 flex justifiy-between">
                <h4 class="text-black text-[24px] uppercase font-bold md:text-[30px]">
                    Best Week Sale Products 
                </h4>
            </div>

            <Product :products="weekSaleProduct" />
            
        </div>

        <!-- Recomadation  -->

        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 flex flex-col justify-center items-center lg:flex-row lg:justify-between border-b-2 border-slate-200 px-2 md:px-4">
                <h4 class="text-black uppercase font-semibold text-[18px] pb-2">
                    Recomadation products
                </h4>
                <div class="flex">
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> New arrivals </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> Best rated </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> all </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                </div>
            </div>
            <div class="my-8">
                <div class="grid grid-cols-12 gap-4">
                    <div v-for="n in 12" :key="n" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 transition duration-300 hover:bg-white">
                        <div class="h-[300px] w-full relative">
                            <img class="block object-cover h-full w-full" :src="img" alt="">
                            <!-- produt-status -->
                            <span class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> sole !</span>
                            <span class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 30%</span>
                            <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> New </span>

                            <!-- action div  -->
                            <div class="absolute top-[20%] right-2">
                                <div class="flex flex-col">
                                    <button @mouseenter="show_product_cart_view_actionTitel='cart'+n"
                                        @mouseleave="show_product_cart_view_actionTitel=false" class="relative bg-white my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span v-if="show_product_cart_view_actionTitel=='cart'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                    </button>
                                    <button @mouseenter="show_product_cart_view_actionTitel='qickView'+n"
                                        @mouseleave="show_product_cart_view_actionTitel=false" class="relative bg-white  w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-regular fa-eye"></i>
                                        <span v-if="show_product_cart_view_actionTitel=='qickView'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Quick view </span> 
                                    </button>
                                    <button @mouseenter="show_product_cart_view_actionTitel='compair'+n"
                                        @mouseleave="show_product_cart_view_actionTitel=false" class="relative bg-white  my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-right-left"></i>
                                        <span v-if="show_product_cart_view_actionTitel=='compair'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Compair </span> 
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product detail my-4 px-2">
                            <router-link to="/product/detalids" class="w-ful uppercase text-gray-600 transition duration-300 hover:font-bold text-sm">
                                table
                            </router-link><br>
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-bold h-10 text-sm">
                                9 Iconic Bed Decoration Ideas To ed Decoration
                            </router-link>
                            <div class="review flex items-center text-orange-500 text-sm my-2 -ml-2">
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star-half"></i>
                                <span>
                                    (10)
                                </span>
                            </div>
                            <div class="price">
                                <del class="text-gray-400 font-semibold"> 400 Tk</del>
                                <span class="mx-2 text-orange-500"> 300 taka </span>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <!-- page loading  -->

        <LoadingVue v-if="loading" :loading="'loading...'" />

    </div>
</template>
<script>
import Slider from '../components/Slider.vue';
import Product from '../components/Product.vue';
import Footer from '../components/Footer.vue';
import LoadingVue from '../components/Loading.vue';

export default {
    components:{Slider,Product,Footer, LoadingVue},
  data: function() {
    return {
        loading:true,
        // slider 
        sliders:[],
        // category
        categories:[],
        firstCategory:'',
        showCategories:[],
        // window widht 
        windowWidth: window.innerWidth,  
        // week_sale_product 
        weekSaleProduct:[],
        
        // loadmore 
        loadMore: true,
        moreCategoies:'',
        loadMoreButtonMessage:'Load More'
    }; 
  },
  methods:{
    loadMoreButton(){
        this.showCategories = this.categories;
        this.loadMore = false;
    }
  },
  mounted(){
   
  },
  created(){
    this.img = 'https://media.istockphoto.com/id/1182454657/photo/bohemian-living-room-interior-3d-render.jpg?s=612x612&w=0&k=20&c=qw37MGIiTL_jML3_Tbm4bM-jNLCrocSWj7DanhBr_bY=';
    axios.get('/get/sliders')
    .then(res => this.sliders = res.data);
    axios.get('/get/cateogry/index/' + this.windowWidth)
    .then(res => {
        this.categories = res.data['categories']
        let categoriesLength = res.data['categories'].length;

        this.firstCategory = res.data['firstCategory'];
        this.showCategories = res.data['showCategories'];
        this.moreCategoies = (Object.keys(res.data['categories']).length - Object.keys(res.data['showCategories']).length);

    });
    axios.get('/get/week/products')
    .then(res =>{
        this.weekSaleProduct = res.data;
        this.loading = false;
    })
    
  }
};
</script>
