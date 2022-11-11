<template>
    <div>
        <!-- Banner  -->
        <div class="w-full my-4" id="hero">
            <div class="owl-carousel owl-theme">
                <div v-for="n in 5" :key="n" class="py-4 item">
                    <div class="w-full mx-auto lg:w-2/3 flex flex-col-reverse items-center justify-center md:flex-row">
                        <div class="w-full md:w-1/2 my-6 ml-2 flex flex-col items-center justify-center">
                            <h2 class="slider-title font-bold uppercase">
                                Contrary to popular belief type and scrambled
                            </h2>
                            <p class="text-center mt-4 font-semibold">
                                printer took a galley of type and scrambled it to make 
                                printer took a galley of type and scrambled it to make 
                            </p>
                            <button type="button" class="btn uppercase my-6 px-4 py-2 text-sm rounded-md 
                            border-2 font-bold border-green-800 text-green-800
                            trnasition duration-300 hover:bg-green-800 hover:text-white">
                                SHOW NOW    
                            </button>
                        </div>
                        <div class="img w-full md:w-1/2 mt-[70px] md:my-4 mr-4 px-2 md:px-4 flex justify-center">
                            <img class="w-full" :src="img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End banner  -->

        <!-- Entery  -->
        <div class="entery container mx-auto my-4">
            <div class="grid grid-cols-4 gap-4 border-2 border-gray-200 py-6">
                <div class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> nd web page editors now use</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> nd web page editors now use</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> nd web page editors now use</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> nd web page editors now use</p>
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
                    <div class="h-full relative overflow-hidden">
                        <img class="block object-cover boject-center w-full h-full brightness-75
                            transition duration-300 hover:scale-[1.2]" 
                            :src="firstCategory.categoryImg"  :alt="firstCategory.categoryImgName">
                        <p class="text-2xl font-bold absolute bottom-3 w-full left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                            {{ firstCategory.categoryName }}
                        </p>
                    </div>
                </div>
                <div v-for="category in categories" :key="category.id" class="h-[200px] bg-white col-span-2 md:col-span-2 xl:col-span-1">
                    <div class="h-full w-full relative overflow-hidden">
                        <img class="block object-cover boject-center w-full h-full 
                            transition duration-300 -z-1 hover:scale-[1.2] hover:brightness-75" 
                            :src="category.categoryImg"  :alt="category.categoryImgName">
                        <p class="text-2xl w-full font-bold absolute bottom-3 left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                            {{ category.categoryName }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- END Category  -->

        <!-- Resent Product  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-center">
                <h4 class="text-black uppercase font-bold text-[30px]">
                    Resent ALL Popular Product 
                    <span v-if="loading" class="text-yellow-600 text-sm font-bold text-right"> loding... </span>
                </h4>
            </div>
            <div class="my-8">
                <div class="grid grid-cols-12 gap-4">
                    <div v-for="n in 10" :key="n" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                        <div class="h-[80%] w-full relative">
                            <img class="block object-cover h-full w-full" :src="img" alt="">
                            <!-- produt-status -->
                            <span class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> sole !</span>
                            <span class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 30%</span>

                            <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> New </span>
                        </div>
                        <div class="product detail my-4 px-2">
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-bold h-10">
                                9 Iconic Bed Decoration Ideas To ed Decoration
                            </router-link>
                            <p class="text-gray-500 fomt-semibold text-sm my-2">
                                Everything We Pizza, We Pizza With Love. Designer Fastfood. Everything We Pizza, We Pizza With Love. Designer Fastfood. 
                            </p>
                            <div class="review flex items-center text-orange-500">
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
                                
                            </div>
                        </div>
                    </div>
                    <div v-for="n in 6" :key="n" class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                        <div class="h-[80%] w-full relative">
                            <img class="block object-cover h-full w-full" :src="img" alt="">
                            <!-- produt-status -->
                            <span class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> sole !</span>
                            <span class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> free shipping</span>

                            <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> 25% </span>
                        </div>
                        <div class="product detail my-4">
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-[600] h-10">
                                Decoration deas To ed Decoration
                            </router-link>
                        </div>
                    </div>
                    <div v-for="n in 6" :key="n" class="col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                        <div class="h-[80%] w-full relative">
                            <img class="block object-cover h-full w-full" :src="img" alt="">
                            <span class="absolute bg-red-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> New </span>
                        </div>
                        <div class="product detail my-4">
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-[600] h-10">
                                oration deas To ed Decoration deas To ed Decoration
                            </router-link>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</template>
<script>


export default {
  data: function() {
    return {
        loading:false,
        categories:[],
        firstCategory:'',
        img:'https://source.unsplash.com/random'
        }; 
  },
  mounted(){
    axios.get('/api/get/cateogry/index')
    .then(res => {
        this.loading = true
        this.categories = res.data[1];
        this.firstCategory = res.data[0];
        this.loading = false
    })
  }
};
</script>
