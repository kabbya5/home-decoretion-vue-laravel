<template>
    <div class="px-2 lg:container lg:mx-auto my-20 md:my-0">
        <div class="flex flex-wrap mb-4 mt-20 md:mt-8">
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                Home 
                <i class="fa-solid fa-chevron-right"></i>
            </router-link>
            <router-link v-if="product.category" :to="{name:'categoryShopPage',params:{catSlug:product.category.slug}}" 
            class="underline capitalize mx-2 text-gray-600 font-semibold"> 
                {{ product.category.categoryName }}
                <i class="fa-solid fa-chevron-right"></i>
            </router-link>
            <router-link v-if="product.subcategory"   
            :to="{name:'subCategoryShopPage',params:{subCatSlug:product.subcategory.slug}}" 
            class="underline capitalize mx-2 text-gray-600 font-semibold"> 
                {{ product.subcategory.subCatName }}
                <i class="fa-solid fa-chevron-right"></i>
            </router-link>
            <router-link v-if="product.childcategory" :to="{name:'childCategoryShopPage',params:{childCatSlug:product.childcategory.slug}}" 
            class="underline capitalize mx-2 text-gray-600 font-semibold"> 
                {{ product.childcategory.childCatName }}
                <i class="fa-solid fa-chevron-right"></i>
            </router-link>
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                {{ product.product_title }} 
            </router-link>
        </div>
        <div class="quickview-modal w-full">
            <div class="flex items-center justify-center h-full px-4 mt-20">
                <div class="bg-white relative w-full md:w-[1000px] mb-20">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 w-full h-80">
                                    <img :src="product.image_url" :alt="product.product_title"
                                    class="w-full h-full object-cover">
                                </div>
                                <div v-for="image in productImages" :key="image.id" class="col-span-1 w-full h-48">
                                    <img :src="image.product_img" :alt="image.product_img_name"
                                    class="w-full h-full object-cove transition duration-400 hover:scale-[1.5]">
                                </div>
                            </div>  
                        </div>
                        <div class="col-span-2 md:col-span-1 px-4">
                            <div class="title flex justify-between items-center">
                               <button class="text-gray-500 font-semibold text-xl transition-all duration-300 hover:text-gray-700">
                                    {{ product.product_title }}
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

                            <form class="w-full" @submit.prevent="buyProduct()"> 
                                <div v-if="product.product_sizes > 0" class="flex flex-col">
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
                                        <span v-else-if="product.product_sizes.length >0" class="px-4 text-gray-500 font-bold">
                                            {{  product.product_sizes[product.product_sizes.length - 1].size_title }}
                                       </span>  
                                    </p> 
                                    <select @change="sizeOptionHandel" class="border-2 border-gray focus:outline-none py-2" v-model="productForm.size"> 
                                        <option  v-for="size in product.product_sizes" :key="size.id"  :value="size.size_title" :data-price="size.size_extra_payment">  {{ size.size_title   }} </option>
                                    </select>
                                </div>

                                <div v-if="product.product_colors > 0" class="flex flex-col my-2">
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

                                <button type="submit" class="mt-6 capitalize w-full py-2 text-xl rounded-md bg-green-500 text-white transition duration-300 hover:bg-green-700">
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
        <NotificationAdminVue v-if="notification.message" :notification="notification" />
    </div>
</template>
<script>
import NotificationAdminVue from './admin/NotificationAdmin.vue';
export default {
    components:{NotificationAdminVue},
  data: function() {
    return {
        product:{ },
        productImages:'',
        // from 
        productForm:{
            size:'',
        },
        selectItemPrice:'',

        notification:{
            type:'',
            message:'',
        }
    }; 
  },
  methods:{
    sizeOptionHandel(event){
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
            this.$router.go();
        })
    },
    buyProduct(){
        axios.post('/cart/add/'+ this.product.slug,{
            size: this.productForm.size,
            color:this.productForm.color,
            quanitity: this.productForm.quanitity,
            size_extra_payment:this.selectItemPrice,
        })
        .then(res => {
            this.$router.push('/dhdk');
        })
    }
  },
  created(){
    let slug = this.$route.params.slug;
    axios.get('/product/' + slug)
    .then( res =>{
        this.product = res.data;
        let length = this.product.all_images.length;
        this.productImages = this.product.all_images.slice(1,length)
    })
  }
};

</script>