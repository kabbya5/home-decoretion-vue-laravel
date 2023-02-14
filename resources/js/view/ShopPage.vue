<template>
    <div class="my-8 container mx-auto">
        <div class="header mx-2 md:mx-0 mt-[90px] md:mt-0 flex items-center"> 
            <router-link to="/" class="capitalize mx-4 text-gray-700">
                home
            </router-link>
            <i class="fa solid fa-chevron-right"></i>
            <button  class="capitalize mx-4 text-gray-700">
                shop
            </button>
            
        </div>
        <div class="flex">
            <div class="overflow-y-hidden min-w-[250px] my-10 mr-4 hidden lg:block">
                <h2 class="capitalize mx-2 hidden lg:block lg:mx-0 text-gray-700 font-bold text-[20px]"> FIlter</h2>
                <!-- //popular category  -->
                <div v-if="categories.length > 0" class="header w-full border-2 border-gray-200 mt-2 bg-wihte">
                    <div class="flex justify-between bg-gray-600">
                        <h3 class="uppercase text-white font-bold px-2 py-2">
                            popular categories
                        </h3>
                        <i class="fa-solid fa-arrow-right flex items-center
                            px-4 bg-gray-800 text-white"></i>
                    </div>
                    <div class="categories my-4 pr-2 bg-white text-gray-600 font-semibold">
                        <div v-for="cat in categories" :key="cat.id" class="flex justify-between border px-4 py-1">
                            <router-link :to="{name:'categoryShopPage',params:{catSlug:cat.slug}}" class="capitalize text-gray-600 duration-300 transition hover:text-gray-800 hover:underline"> {{ cat.categoryName }} </router-link>
                            <span class="text-gray-400"> ({{ cat.products.length }}) </span>
                        </div>
                    </div>
                </div>

                <!-- popular products  -->
                <div v-if="popularProducts.length > 0" class="header w-full border-2 border-gray-200 mt-2 bg-wihte">
                    <div class="flex justify-between bg-gray-600">
                        <h3 class="uppercase text-white font-bold px-2 py-2">
                            popular products
                        </h3>
                        <i class="fa-solid fa-arrow-right flex items-center
                            px-4 bg-gray-800 text-white"></i>
                    </div>
                    <div class="categories my-4 pr-2 bg-white text-gray-600 font-semibold">
                        <div v-for="product in popularProducts" :key="product.id" class="flex justify-between items-center border px-4 py-1">
                            <router-link :to="{name:'product-detail',params:{slug:product.slug}}" class="capitalize text-gray-600 duration-300 transition hover:text-gray-800 hover:underline"> {{ product.product_title }} </router-link>
                            <img class="w-10 h-10 rounded-full" :src="'/'+product.image_url" :alt="product.product_title">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:ml-8">

                <div class="my-8">
                    <div class="flex flex-wrap shop-nav">
                        <button class="capitalize mx-2 my-2 text-slate-600 font-semibold transiton duration-300 hover:text-black"
                            :class="{'active':acitveNav == 'all'}"> all Prdoucts 
                        </button>

                        <button class="capitalize mx-2 my-2 text-slate-600 font-semibold transiton duration-300 hover:text-black"
                            :class="{'active':acitveNav == 'new-arrivals'}"> New arrivals  
                        </button>

                        <button class="capitalize mx-2 my-2 text-slate-600 font-semibold transiton duration-300 hover:text-black"
                            :class="{'active':acitveNav == 'best-sellers'}"> Best sales  
                        </button>

                        <button class="capitalize mx-2 my-2 text-slate-600 font-semibold transiton duration-300 hover:text-black"
                            :class="{'active':acitveNav == 'popular-products'}"> popular products  
                        </button>

                        <button class="capitalize mx-2 my-2 text-slate-600 font-semibold transiton duration-300 hover:text-black"
                            :class="{'active':acitveNav == 'free-shipping-products '}"> free shipping products  
                        </button>
        
                    </div>
                </div>

                <span class="px-4 text-xl text-gray-600"> showing {{showProducts.length}}   of {{allProductsLength}}  products</span>
                <ProductVue :products="showProducts" />

                <div v-if="(allProductsLength >= showProductsLength)"  @click="loadMore('product')">
                    <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                        {{(allProductsLength - showProductsLength)}} more products
                    </div>
                    <div v-if="(allProductsLength >= showProductsLength)" class="flex justify-center my-4">
                        <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                        transition duration-300 hover:bg-indigo-600">
                            {{ loadMorebtnMessage }}
                            <i class="fa-solid fa-repeat ml-1"></i>
                        </button>
                    </div>
                </div>

                <!-- relatedTags -->
                <div v-if="relatedTags.length > 0"  class="my-10">
                    <h2 class="capitalize text-gray-700 text-xl my-4 font-bold"> related Tag </h2>
                    <div class="grid grid-cols-12 gap-4">
                        <div v-for="tag in relatedTags" :key="tag.id" class="col-span-6 md:col-span-4 lg:col-span-3 xl:col-span-2">
                            <router-link @click="tags={}" :to="{name:'tagShopPage',params:{tagSlug:tag.slug}}" 
                            class="underline border-b-2 border-gray-200 flex items-center">
                                # {{ tag.tag_name }}
                           </router-link>
                        </div>
                    </div>
                </div>

                <!-- relatedProducts  -->
                <div v-if="relatedProducts.length >0">
                    <div class="flex justify-between">
                        <h2 class="capitalize text-gray-700 text-xl my-4 font-bold"> related Products</h2>
                        <span class="px-4 text-xl text-gray-600 uppercase"> all ({{ relatedProducts.length }}) </span>
                    </div>
                    
                    <ProductVue :products="showRelatedProducts" />
                </div>

                <div v-if="(relatedProducts.length >= showRelatedProductsLength)"  @click="loadMore('relatedProduct')">
                    <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                        {{(relatedProducts.length  - showRelatedProductsLength)}} more products
                    </div>
                    <div v-if="(relatedProducts.length >= showRelatedProductsLength)" class="flex justify-center my-4">
                        <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                        transition duration-300 hover:bg-indigo-600">
                            {{ loadMorebtnMessage }}
                            <i class="fa-solid fa-repeat ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- load more  -->

        <LoadingVue v-if="loading" :loading="'loading...'"> </LoadingVue>

        <!-- //Footer  -->

        
    </div>
</template>
<script>
import LoadingVue from '../components/Loading.vue';
import ProductVue from '../components/Product.vue';
export default{
    components:{LoadingVue,ProductVue,},
    data(){
        return{
            loading:true,
            showProducts:[],
            allProducts:[],
            showProductsLength:12,
            allProductsLength:'',
            //tag-proucts
            relatedTags:[],

            // category product related product
            relatedProducts:[],
            showRelatedProducts:[],
            showRelatedProductsLength:4,

            //category for filter
            categories:[],
            popularProducts:[],

            // top-nave-status 

            acitveNav:'all',

            loadMorebtnMessage:'Load More'
        }
    },
    methods:{
        loadMore:function(product){

            this.btnMessage = 'looding...'
            if(product === 'product'){
                this.showProductsLength += 12;
                this.showProducts = this.allProducts.slice(0, this.showProductsLength);
            }else{
                this.showRelatedProductsLength += 12;
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength);
            }
            
            this.btnMessage = 'load more'
            
        },
        shopPageProduct(status){
            axios.get('/get/shop/products/'+ status)
            .then(res =>{
                this.allProducts = res.data['products'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedProducts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })

        },
        catProducts(slug){   
            axios.get('/shop/category/product/'+ slug)
            .then(res =>{
                this.allProducts = res.data['catProducts'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedProducts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })
        },
        tagProductQuery(slug){
            axios.get('/shop/tag/product/'+this.$route.params.tagSlug)
            .then(res =>{
                this.allProducts = res.data['tagProducts'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedPrdoucts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })
        },
        subCatProducts(slug){
            axios.get('/shop/subcat/product/' + slug)
            .then(res =>{
                this.allProducts = res.data['subCatProducts'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedProducts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })
        },
        childCatProducts(slug){
            axios.get('/shop/childcat/product/' + slug)
            .then(res =>{
                this.allProducts = res.data['subCatProducts'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedProducts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })
        },
        sliderProducts(slug){
            axios.get('/shop/slider/product/' + slug)
            .then(res =>{
                this.allProducts = res.data['sliderProducts'];
                this.showProducts = this.allProducts.slice(0,this.showProductsLength);
                this.allProductsLength = this.allProducts.length;
                this.relatedProducts = res.data['relatedProducts'];
                this.showRelatedProducts = this.relatedProducts.slice(0,this.showRelatedProductsLength)
                this.loading = false;
            })
        }
    },
    created(){
        axios.get('/shop/page/sidebar/contents')
        .then(res => {
            this.categories = res.data['categories'];
            this.popularProducts = res.data['popularProducts'];
        })
        if(this.$route.params.tagSlug){
            this.tagProductQuery(this.$route.params.tagSlug);
            
        }else if(this.$route.params.catSlug){
            this.catProducts(this.$route.params.catSlug);
        }else if(this.$route.params.subCatSlug){
            this.subCatProducts(this.$route.params.subCatSlug);
        }else if(this.$route.params.childCatSlug){
            this.childCatProducts(this.$route.params.childCatSlug);
        }else if(this.$route.params.sliderSlug){
            this.sliderProducts(this.$route.params.sliderSlug);
        }
        else{
            this.shopPageProduct('all');
        }
        
    }
}
</script>

<style scoped>
.shop-nav button{
    font-family:sans-serif;
    font-weight: 500;
    line-height: 26px;
    color:#201e1e;
    size:16px;
}
.shop-nav .active{
    border-bottom: 2px solid #000000;
    color:#000000;
    font-weight: 600;
}
</style>