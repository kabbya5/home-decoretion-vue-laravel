<template>
    <div>
        <div class="my-8">
            <div class="grid grid-cols-12 gap-4">
                <div v-for="product in products" :key="product" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 transition duration-300 hover:bg-gray-200"
                    @mouseenter="(show_product_cart_view_button=product.id)"
                    @mouseleave="(show_product_cart_view_button=false)">
                    <div class="h-[300px] w-full relative">
                        <router-link :to="{name:'product-detail',params:{slug:product.slug}}"> 
                            <img v-if="product.image_url" class="block object-cover h-full w-full" :src="product.image_url" :alt="product.product_title">
                        </router-link>
                    
                        <!-- produt-status -->
                        <span v-if="product.sale_status" class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> {{product.sale_status}}</span>
                        <span v-if="product.free_shipping" class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 
                            Free Shipping
                        </span>
                        <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[50%] translate-x-[-60%] bottom-[-10px]"> {{ product.discount_status_or_new }} </span>

                        <!-- action div  -->
                        <div v-if="(show_product_cart_view_button==product.id)" class=" absolute top-[20%] right-2">
                            <div class="flex flex-col">
                                <button @click="addToCart(product.slug)" @mouseenter="(show_product_cart_view_actionTitel='cart'+product.id)"
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
                        <router-link :to="{name:'categoryShopPage',params:{catSlug:product.category.slug}}" class="w-ful uppercase text-gray-600 transition duration-300 hover:font-bold text-sm">
                            {{ product.category.categoryName }}
                        </router-link><br>
                        <router-link :to="{name:'product-detail',params:{slug:product.slug}}" class="w-ful text-gray-600 font-bold h-10 text-md">
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

        <div v-if="quickViewModal" class="quickview-modal w-full h-screen bg-gray-300/60 fixed top-0 left-0 z-50 overflow-auto">
            <div class="flex items-center justify-center h-full px-4 mt-20">
                <div class="bg-white relative w-[450px] md:w-[1000px] mb-20">
                    <button @click="quickViewModal=!quickViewModal"
                    class="absolute -top-4 -right-3 w-10 h-10 rounded-full bg-white
                        trasition duration-300 hover:text-white hover:bg-black shadow-md">
                    <i class="fa-solid fa-xmark"></i>

                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 w-full h-80">
                                    <img :src="product.image_url" :alt="product.product_title"
                                    class="w-full h-full object-cover">
                                </div>
                                <div v-for="image in images" :key="image.id" class="col-span-1 w-full h-48">
                                    <img :src="image.product_img" :alt="image.product_img_name"
                                    class="w-full h-full object-cover">
                                </div>
                            </div>  
                        </div>
                        <div class="col-span-2 md:col-span-1 py-4 px-4">
                            <div class="title flex justify-between items-center">
                                <router-link :to="{name:'product-detail',params:{slug:product.slug}}" class="text-gray-500 font-semibold text-xl transition-all duration-300 hover:text-gray-700">
                                    {{ product.product_title }}
                                </router-link>
                                <button @mouseenter="show_product_cart_view_actionTitel='cart'+product.id"
                                    @mouseleave="show_product_cart_view_actionTitel=false" 
                                    @click="addToCart(product.slug)"
                                    class="relative mr-4 w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 border-2 border-gray-200 hover:bg-black hover:text-white"> 
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span v-if="show_product_cart_view_actionTitel=='cart'+product.id" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                </button>
                            </div>
                           
                           <p class="my-2 text-sm text-gray-600"> 
                                {{ product.short_text }}
                            </p>

                            <div class="flex items-center text-gray-600 my-2"> 
                                <i class="fa-regular fa-eye text-2xl"></i> 
                                <span class="mx-2 font-bold text-gray-600"> {{ product.view_count }} </span>
                                people are viewed
                            </div>

                            <div class="discount flex items-center">
                                <div v-if="product.discount_price" class="flex items-center">
                                     <del> {{ product.price }} TK </del>
                                    <span class="mx-4 text-red-500 font-bold text-xl"> {{ product.discount_price }}  <span v-if="selectItemPrice" class="mx-4 text-red-500 font-bold text-xl">  +  {{ selectItemPrice }} </span> TK </span>   
                                </div>
                                <div v-else class="flex items-center">
                                    <span class="mx-4 text-red-500 font-bold text-xl"> {{ product.price  }}  <span v-if="selectItemPrice" class="mx-4 text-red-500 font-bold text-xl">  +  {{ selectItemPrice }} </span> TK </span>   
                                </div>

                                <span class="bg-orange-500 px-3 py-1 rounded-full text-white flex items-center justify-center font-bold">
                                    {{ product.discount_status_or_new }}    
                                </span>
                            
                            </div>
                            <div v-if="product.is_furniture" class="flex items-center text-gray-600 my-2"> 
                                <i class="fa-solid fa-weight-scale text-2xl"></i> 
                                <span class="mx-2 font-bold text-gray-600"> {{ product.weight }} Kg </span>
                                
                            </div>
                            <div v-else class="flex items-center text-gray-600 my-2"> 
                                <i class="fa-regular fa-lightbulb text-2xl"></i> 
                                <span class="mx-2 font-bold text-gray-600"> {{ product.weight }} Watt </span>
                            </div>
                            
                            <!-- form section  -->

                            <form class="w-full"> 
                                <div v-if="product.product_sizes.length > 0" class="flex flex-col">
                                    <p v-if="product.is_furniture" class="text-gray-600 my-2">
                                        Select Size : 
                                        <span v-if="selectItemPrice" class="px-4 text-red-500 font-bold">
                                            Extra Payment {{ selectItemPrice }} TK need for this size 
                                        </span>   
                                        <span v-else class="px-4 text-gray-500 font-bold">
                                             {{ product.product_sizes[product.product_sizes.length - 1].size_title }}
                                        </span> 
                                    </p>
                                    <p v-else class="text-gray-600 my-1">
                                        Select Watt : 
                                        <span v-if="selectItemPrice" class="px-4 text-red-500 font-bold">
                                            Extra Payment {{ selectItemPrice }} TK  need for this size 
                                        </span> 
                                        <span v-else class="px-4 text-gray-500 font-bold">
                                            {{  product.product_sizes[product.product_sizes.length - 1].size_title }}
                                       </span>  
                                    </p> 
                                    <select  class="border-2 border-gray focus:outline-none py-2" @change="sizeOptionChange" v-model="productForm.size"> 
                                        <option v-for="size in product.product_sizes" :key="size.id" :value="size.size_title" :data-price="size.size_extra_payment">  {{ size.size_title   }} </option>
                                    </select>
                                </div>

                                <div v-if="product.product_colors.length > 0" class="flex flex-col my-2">
                                    <p class="text-gray-600 my-1"> Color : 
                                        {{ productForm.color ? productForm.color:product.product_colors[product.product_colors.length - 1].name }} 

                                    </p>
                                    <select class="border-2 border-gray focus:outline-none py-1" v-model="productForm.color"> 
                                        <option v-for="color in product.product_colors" :key="color.id" :value="color.name" class=""> {{ color.name }} </option>
                                    </select>
                                </div>   


                                <div class="flex flex-col">
                                    <p class="text-gray-600 my-4 font-bold"> Quanitity : {{ productForm.quanitity? 'Only' +' ' +  productForm.quanitity: 'Only' +' ' + 1 }} </p>
                                    <select v-model="productForm.quanitity" class="border-2 border-gray focus:outline-none py-1"> 
                                        <option v-for="n in 5" :key="n" :value="n"> Only  {{ n }} </option>
                                    </select>
                                </div>

                                <button class="mt-6 capitalize w-full py-2 text-xl rounded-md bg-green-500 text-white transition duration-300 hover:bg-green-700">
                                    buy now 
                                </button>
                            </form>
                            <button @click="addToCart(product.slug)" class="mt-6 capitalize w-full py-2 text-xl rounded-md bg-orange-500 text-white transition duration-300 hover:bg-orange-700">
                                add to cart
                            </button>
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <Notification v-if="notification.message" :notification="notification" />
    </div>
</template>
<script>
import Notification from "../view/admin/NotificationAdmin.vue"
export default{
    components:{Notification},
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

            // from 

            productForm:{
                size:'',
            },
            selectItemPrice:'',

            notification:{
                type:'',
                message:'',
            }

        }
    },
    methods:{
        quickViewProductModal(product){
            this.quickViewModal = true;
            let length = product.all_images.length;
            this.firstImage = product.all_images.slice(0,1);
            this.images = product.all_images.slice(1,length);
            this.product = product;
            this.selectItemPrice = null;
            this.productForm = {};
        },

        sizeOptionChange (event){
            this.selectItemPrice = event.target.options[event.target.options.selectedIndex].getAttribute('data-price');
        },
        addToCart(slug){
            axios.post('/cart/add/'+slug,{
                size: this.productForm.size,
                color:this.productForm.color,
                quanitity: this.productForm.quanitity,
                size_extra_payment:this.selectItemPrice,
            })
            .then(res => {
                this.notification.message = "The product has been add to cart successfully !";
                this.notification.type = "success";
                this.$router.go()
            })
        }
    }
}
</script>