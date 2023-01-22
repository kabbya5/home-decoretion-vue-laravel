<template>
    <div class="px-2 lg:px-0">
        <!-- Banner  -->
        <Slider class="mt-20 md:mt-0" :sliders="sliders"> 

        </Slider>
        <!-- End banner  -->

        <!-- Entery  -->
        <div class="entery container mx-auto my-4">
            <div class="grid grid-cols-4 gap-4 border-2 border-gray-200 py-6">
                <div v-for="entry in entries" :key="entry.id" class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i :class="entry.icon" class="fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> {{entry.title}}</h2>
                            <p class="pt-2 text-gray-500"> {{entry.text}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-center">
                <h4 class="text-black uppercase font-bold text-left text-xl xl:text-[30px]">
                    All Popular Category 
                </h4>
            </div>

            <div class="grid grid-cols-6 gap-2">
                <div class="bg-white h-[200px] md:h-full lg:h-[405px] col-span-2 md:row-span-2 md:col-span-2 xl:col-span-2">
                    <router-link v-if="firstCategory.slug" :to="{name:'categoryShopPage',params:{catSlug:firstCategory.slug}}">
                        <div class="h-full relative overflow-hidden">
                            <img class="block object-cover boject-center w-full h-full brightness-75
                                transition duration-300 hover:scale-[1.2]" 
                                :src="firstCategory.img"  :alt="firstCategory.categoryImgName">
                            <p class="text-2xl font-bold absolute bottom-3 w-full left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                                {{ firstCategory.categoryName }}
                            </p>
                        </div>
                    </router-link>
                    
                </div>
                <div v-for="category in showCategories" :key="category.id" class="h-[200px] bg-white col-span-2 md:col-span-2 xl:col-span-1">
                    <router-link v-if="category.slug" :to="{name:'categoryShopPage',params:{catSlug:category.slug}}">
                        <div class="h-full w-full relative overflow-hidden">
                            <img class="block object-cover boject-center w-full h-full 
                                transition duration-300 -z-1 hover:scale-[1.2] hover:brightness-75" 
                                :src="category.img"  :alt="category.categoryImgName">
                            <p class="text-2xl w-full font-bold absolute bottom-3 left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                                {{ category.categoryName }}
                            </p>
                        </div>
                    </router-link>
                    
                </div>
            </div>
            <div v-if="moreCategoies" @click="loadMoreButton">
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

        <!-- Popular tags  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-left">
                <h4 class="text-black uppercase font-bold text-xl xl:text-[30px]">
                    All Popular Tags
                </h4>
            </div>

            <div class="grid grid-cols-6 gap-4">
                <div v-for="tag in tags" :key="tag.id" class="bg-white col-span-3 md:col-span-2 xl:col-span-1">
                    <router-link v-if="tag.slug" :to="{name:'tagShopPage',params:{tagSlug:tag.slug}}">
                        <div class="h-[200px]  w-full relative overflow-hidden">
                            <img class="block object-cover boject-center w-full h-full 
                                transition duration-300 -z-1 hover:scale-[1.2] hover:brightness-75" 
                                :src="tag.image.img"  :alt="tag.tag_name">
                        </div>
                        <div class="flex items-center justify-between my-1">
                            <p class="text-md font-[600] text-gray-700">
                                {{ tag.tag_name }}
                            </p>

                            <span >
                                {{ tag.products.length }} items
                            </span>
                        </div>
                    </router-link>
                    
                </div>
            </div>
        </div>

        <!-- end subcategoery  -->

        <!-- Week Sale Product  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 flex justifiy-between">
                <h4 class="text-black text-[24px] uppercase font-bold md:text-[30px]">
                    Best Week Sale Products 
                </h4>
            </div>

            <Product :products="bestWeekSaleProducts" />
            
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
                <Product :products="resentProducts" />
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
        loading:false,
        // slider 
        sliders:[],
        //entry section 
        entries:[],
        // category
        categories:[],
        firstCategory:'',
        showCategories:[],
        // window widht 
        //tags 
        tags:[],
        windowWidth: window.innerWidth,  
        // week_sale_product 
        bestWeekSaleProducts:[],

        //resent products
        resentProducts:[],
        
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
  mounted() {
    if (localStorage.getItem('reloaded')) {
        localStorage.removeItem('reloaded');
        this.loading = false;
    } else {
        this.loading = true;
        localStorage.setItem('reloaded', '1');
        location.reload();
        
    }
  },
  created(){
    
    axios.get('/get/hom/page/content')
    .then(res =>{
        this.sliders = res.data['sliders'];
        this.entries = res.data['entrySection'];
        this.tags = res.data['popularTags'];
        this.bestWeekSaleProducts = res.data['bestWeekSaleproducts'];
        this.resentProducts = res.data['resentProducts'];
        
    });
    axios.get('/get/cateogry/index/' + this.windowWidth)
    .then(res => {
        this.categories = res.data['categories']
        this.firstCategory = res.data['firstCategory'];
        this.showCategories = res.data['showCategories'];
        this.moreCategoies = (Object.keys(res.data['categories']).length - Object.keys(res.data['showCategories']).length);
    });
  }
};
</script>
