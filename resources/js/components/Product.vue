<template>
    <div>
        <div class="my-8">
            <div class="grid grid-cols-12 gap-4">
                <div v-for="product in products" :key="product" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 transition duration-300 hover:bg-gray-200"
                    @mouseenter="(show_product_cart_view_button=product.id)"
                    @mouseleave="(show_product_cart_view_button=false)">
                    <div class="h-[300px] w-full relative">
                        <router-link to="/product-detail"> 
                            <img v-if="product.images[0]" class="block object-cover h-full w-full" :src="product.images[0].product_img" alt="">
                        </router-link>
                    
                        <!-- produt-status -->
                        <span v-if="product.sale_status" class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> {{product.sale_status}}</span>
                        <span v-if="product.free_shipping" class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 
                            Free Shipping
                        </span>
                        <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> {{ product.discount_status_or_new }} </span>

                        <!-- action div  -->
                        <div v-if="(show_product_cart_view_button==product.id)" class=" absolute top-[20%] right-2">
                            <div class="flex flex-col">
                                <button @click="addToCard()" @mouseenter="(show_product_cart_view_actionTitel='cart'+product.id)"
                                    @mouseleave="show_product_cart_view_actionTitel=false" 
                                    class="relative bg-white my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 hover:bg-black hover:text-white"> 
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span v-if="(show_product_cart_view_actionTitel=='cart'+product.id)" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                </button>
                                <button @mouseenter="(show_product_cart_view_actionTitel='qickView'+product.id)"
                                    @mouseleave="show_product_cart_view_actionTitel=false"
                                    @click="quickViewProductModal(product)"
                                    class="relative bg-white  w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 hover:bg-black hover:text-white"> 
                                    <i class="fa-regular fa-eye"></i>
                                    <span v-if="show_product_cart_view_actionTitel=='qickView'+product.id" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Quick view </span> 
                                </button>
                                <button @mouseenter="show_product_cart_view_actionTitel='compair'+product.id"
                                    @mouseleave="show_product_cart_view_actionTitel=false" class="relative bg-white  my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 hover:bg-black hover:text-white"> 
                                    <i class="fa-solid fa-right-left"></i>
                                    <span v-if="show_product_cart_view_actionTitel=='compair'+product.id" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Compair </span> 
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="product detail my-4 px-2">
                        <router-link to="/product/detalids" class="w-ful uppercase text-gray-600 transition duration-300 hover:font-bold text-sm">
                            {{ product.category.categoryName }}
                        </router-link><br>
                        <router-link to="/product/detalids" class="w-ful text-gray-600 font-bold h-10 text-md">
                            {{ product.product_title }}
                        </router-link>
                        <div class="text-gray-600 my-2 text-sm ">
                            {{ product.short_text.substring(0,100) +('....') }}
                        </div>
                      
                        <div v-if="product.discount_price" class="price">
                            <del class="text-gray-400 font-semibold"> {{product.price}} TK </del>
                            <span class="mx-2 text-orange-500"> {{product.discount_price}} TK </span>
                        </div>
                        <div v-else class="price">
                            <span class="mx-2 text-orange-500"> {{product.price}} TK </span>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <!-- Quick view product modal  -->
        <div v-if="quickViewModal" class="quickview-modal w-full h-screen bg-gray-300/60 fixed top-0 z-50 overflow-auto">
            <div class="flex items-center justify-center h-full px-4">
                <div class="bg-white relative w-[450px] md:w-[1000px]">
                    <button @click="quickViewModal=!quickViewModal"
                    class="absolute -top-4 -right-3 w-10 h-10 rounded-full bg-white
                        trasition duration-300 hover:text-white hover:bg-black shadow-md">
                    <i class="fa-solid fa-xmark"></i>

                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 w-full h-80">
                                    <img :src="firstImage[0].product_img" :alt="firstImage[0].product_img"
                                    class="w-full h-full object-cover">
                                </div>
                                <div v-for="image in images" :key="image.id" class="col-span-1">
                                    <img :src="image.product_img" :alt="image.product_img_name"
                                    class="w-full h-full object-cover">
                                </div>
                            </div>  
                        </div>
                        <div class="col-span-2 md:col-span-1 py-4 px-4">
                            <div class="title flex justify-between items-center">
                                <router-link to="/hdosl/lkd" class="text-gray-500 font-semibold text-xl transition-all duration-300 hover:text-gray-700">
                                    {{ product.product_title }}
                                </router-link>
                                <button @mouseenter="show_product_cart_view_actionTitel='cart'+product.id"
                                    @mouseleave="show_product_cart_view_actionTitel=false" 
                                    class="relative mr-4 w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 border-2 border-gray-200 hover:bg-black hover:text-white"> 
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span v-if="show_product_cart_view_actionTitel=='cart'+product.id" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                </button>
                            </div>
                           
                           <p class="my-2 text-sm text-gray-600"> 
                                {{ product.short_text }}
                            </p>

                            <div class="discount flex items-center">
                                <div v-if="product.discount_price" class="flex items-center">
                                     <del> {{ product.price }} TK </del>
                                    <span class="mx-4 text-red-500 font-bold text-xl"> {{ product.discount_price }} TK </span>
                                </div>
                                <span class="bg-orange-500 px-2 py-1 rounded-full text-white flex items-center justify-center font-bold">
                                    {{ product.discount_status_or_new }}    
                                </span>
                            </div>
                            <div class="flex items-center text-gray-600 my-2"> 
                                <i class="fa-regular fa-eye font-2xl"></i> 
                                <span class="mx-2 font-bold text-gray-600"> 30 </span>
                                people are vieied
                            </div>
                            <!-- form section  -->

                            <form class="w-full"> 
                                <div class="flex justify-between">
                                    <div class="flex flex-col w-1/3">
                                        <p class="text-gray-600 my-1"> Quanitity : </p>
                                        <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                            <option value="1" class=""> Only one </option>
                                            <option value="2"> Only two </option>
                                            <option value="3"> Only three </option>
                                            <option value="4"> Only four </option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col w-1/3">
                                        <p class="text-gray-600 my-1"> Size : </p>
                                        <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                            <option value="ml" class=""> ML</option>
                                            <option value="xl"> XL </option>
                                            <option value="xxl"> XXL </option>
                                        </select>
                                    </div>
                                    <div class="flex flex-col w-1/3">
                                        <p class="text-gray-600 my-1"> Color : </p>
                                        <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                            <option value="1" class=""> RED </option>
                                            <option value="2"> BLUE </option>
                                            <option value="3"> Green </option>
                                        </select>
                                    </div>   
                                </div>

                                <button class="mt-4 capitalize w-full py-2 text-xl rounded-md bg-orange-500 text-white transition duration-300 hover:bg-orange-700">
                                    buy now 
                                </button>
                            </form>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['products'],
    data (){
        return {
            quickViewModal: false,
            show_product_cart_view_button:false,
            show_product_cart_view_actionTitel:false,
            // quickViewProductModal
            product:[],
            firstImage:'',
            images:'',
        }
    },
    methods:{
        quickViewProductModal(product){
            this.quickViewModal = true;
            let length = product.images.length;
            this.firstImage = product.images.slice(0,1);
            this.images = product.images.slice(1,length);
            this.product = product;
            console.log(this.firstImage);
        }
    }
}
</script>