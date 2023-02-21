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
            <router-link :to="{name:'product-detail',params:{slug:product.slug}}" class="capitalize mx-2 text-gray-600 font-semibold"> 
                {{ product.product_title }} 
            </router-link>
        </div>
        <div class="w-full">
            <div class="flex items-center justify-center h-full px-4 mt-20">
                <div class="bg-white relative w-full md:w-[1000px] mb-20">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 w-full h-80">
                                    <img :src="'/'+product.image_url" :alt="product.product_title"
                                    class="w-full h-full object-cover">
                                </div>
                                <div v-if="product.video_link" class="col-span-2">
                                    <button @click="productVideo =!productVideo" 
                                        class="text-gray-900 font-semibold border-2 border-gray-200 rounded-md
                                        px-4 py-2 trasiton duration-300 hover:bg-orange-700 hover:text-white"
                                        :class="{'bg-orange-700 text-white':productVideo}"> 
                                        Video
                                    </button>
                                    <button @click="productVideo =!productVideo" 
                                        class="text-gray-900 font-semibold border-2 border-gray-200 rounded-md
                                        px-4 py-2 trasiton duration-300 hover:bg-orange-700 hover:text-white"
                                        :class="{'bg-orange-700 text-white':!productVideo}"> 
                                        Images
                                    </button>
                                </div>
                                <div class="col-span-2">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div v-if="productVideo" class="col-span-2 row-span-2">
                                            <iframe width="100%" height="315" :src="product.video_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                        <div v-else v-for="image in productImages" :key="image.id" class="col-span-1 w-full h-48">
                                            <img :src="image.img" :alt="image.product_img_name"
                                            class="w-full h-full object-cove transition duration-400 hover:scale-[1.5]">
                                        </div>
                                    </div>
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
                                <div v-if="product.product_sizes && product.product_sizes.length > 0" class="flex flex-col">
                                    <p v-if="product.is_furniture" class="text-gray-600 my-2">
                                        Select Size : 
                                        <span v-if="selectItemPrice" class="px-4 text-red-500 font-bold">
                                            Extra Payment {{ selectItemPrice }} TK need for this size 
                                        </span>   
                                        <span v-else class="px-4 text-gray-500 font-bold">
                                             {{ product.product_sizes[0].size_title }}
                                        </span> 
                                    </p>
                                    <p v-else class="text-gray-600 my-1">
                                        Select Watt : 
                                        <span v-if="selectItemPrice" class="px-4 text-red-500 font-bold">
                                            Extra Payment {{ selectItemPrice }} TK  need for this size 
                                        </span> 
                                        <span v-else-if="product.product_sizes.length >0" class="px-4 text-gray-500 font-bold">
                                            {{  product.product_sizes[0].size_title }}
                                       </span>  
                                    </p> 
                                    <select @change="sizeOptionHandel" class="border-2 border-gray focus:outline-none py-2" v-model="productForm.size"> 
                                        <option  v-for="size in product.product_sizes" :key="size.id"  :value="size.size_title" :data-price="size.size_extra_payment">  {{ size.size_title   }} </option>
                                    </select>
                                </div>
                                <div v-if="product.product_colors && product.product_colors.length > 0" class="flex flex-col my-2">
                                    <p class="text-gray-600 my-1"> Color : 
                                        {{ productForm.color ? productForm.color:product.product_colors[0].name }} 

                                    </p>
                                    <select class="border-2 border-gray focus:outline-none py-1" v-model="productForm.color"> 
                                        <option v-for="color in product.product_colors" :key="color.id" :value="color.name" class=""> {{ color.name }} </option>
                                    </select>
                                </div>   


                                <div class="flex flex-col">
                                    <p class="text-gray-600 my-4 font-bold"> quantity : {{ productForm.quantity? 'Only' +' ' +  productForm.quantity: 'Only' +' ' + 1 }} </p>
                                    <select v-model="productForm.quantity" class="border-2 border-gray focus:outline-none py-1"> 
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
        <div class="my-10">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-8">
                    <div class="flex">
                        <button @click="showReturnPolicy =!showReturnPolicy" 
                            class="text-gray-900 font-semibold border-2 border-gray-200 rounded-md
                            px-4 py-2 trasiton duration-300 hover:bg-orange-700 hover:text-white"
                            :class="{'bg-orange-700 text-white':!showReturnPolicy}"> 
                            Description 
                        </button>
                        <button @click="showReturnPolicy =!showReturnPolicy" 
                            class="text-gray-900 font-semibold border-2 border-gray-200 rounded-md
                            px-4 py-2 trasiton duration-300 hover:bg-orange-700 hover:text-white"
                            :class="{'bg-orange-700 text-white':showReturnPolicy}"> 
                            Return policy
                        </button>
                    </div>
                    <div class="my-6 px-4">
                        <div v-if="!showReturnPolicy">
                            <div class="ql-snow">
                              <p class="ql-editor" v-html="product.description"></p>
                            </div>
                        </div>
                        <div v-else>
                            <div class="ql-snow">
                              <p class="ql-editor" v-html="returnPolicy"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4">
                    <div v-if="relatedProducts && relatedProducts.length > 0" class="header w-full border-2 border-gray-200 mt-2 bg-wihte">
                        <div class="flex justify-between bg-gray-600">
                            <h3 class="uppercase text-white font-bold px-2 py-2">
                                Related product
                            </h3>
                            <i class="fa-solid fa-arrow-right flex items-center
                                px-4 bg-gray-800 text-white"></i>
                        </div>
                        <div class="categories my-10  pr-2 bg-white text-gray-600 font-semibold">
                            <div v-for="relatedProduct in relatedProducts" :key="relatedProduct.id" class="flex justify-between items-center border px-4">
                                <div class="flex w-full">
                                    <div class="w-full">
                                        <router-link :to="{name:'product-detail',params:{slug:relatedProduct.slug}}"  class="capitalize text-gray-600 duration-300 transition hover:text-gray-800 hover:underline"> {{ relatedProduct.product_title }} </router-link>
                                        <div v-if="relatedProduct.discount_price" class="flex items-center my-4">
                                            <del> {{ relatedProduct.price }} TK </del>
                                           <span class="mx-4 text-red-500 font-bold text-xl"> {{ relatedProduct.discount_price }} TK </span>   
                                       </div>
                                       <div v-else class="flex items-center my-4">
                                           <span class="mx-4 text-red-500 font-bold text-xl"> {{ relatedProduct.price  }}  TK </span>   
                                       </div>
                                    </div>
                                    <div class="">
                                        <img class="w-20 h-20 rounded-md" :src="'/'+ relatedProduct.image_url" :alt="relatedProduct.product_title">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div v-if="resentViewProducts && resentViewProducts.length > 0" class="header w-full border-2 border-gray-200 mt-2 bg-wihte">
                        <div class="flex justify-between bg-gray-600">
                            <h3 class="uppercase text-white font-bold px-2 py-2">
                                Resent view
                            </h3>
                            <i class="fa-solid fa-arrow-right flex items-center
                                px-4 bg-gray-800 text-white"></i>
                        </div>
                        <div class="my-4 pr-2 bg-white text-gray-600 font-semibold">
                            <div v-for="resentView in resentViewProducts" :key="resentView.id" class="flex justify-between items-center border px-4 py-1">
                                <div v-if="resentView.product" class="pt-6 flex w-full">
                                    <div class="w-full">
                                        <router-link :to="{name:'product-detail',params:{slug:resentView.product.slug}}"  class="capitalize text-gray-600 duration-300 transition hover:text-gray-800 hover:underline"> {{ resentView.product.product_title }} </router-link>
                                        <div v-if="resentView.product.discount_price" class="flex items-center my-4">
                                            <del> {{ resentView.product.price }} TK </del>
                                           <span class="mx-4 text-red-500 font-bold text-xl"> {{ resentView.product.discount_price }}  TK </span>   
                                       </div>
                                       <div v-else class="flex items-center my-4">
                                           <span class="mx-4 text-red-500 font-bold text-xl"> {{ resentView.product.price  }}  TK </span>   
                                       </div>
                                    </div>
                                    <div class="">
                                        <img class="w-20 h-20 rounded-md" :src="'/'+resentView.product.image_url" :alt="resentView.product_title">
                                    </div>
                                </div>  
                            </div>
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
            productVideo:false,
            product:{ },
            relatedProducts:[],
            returnPolicy:'',

            showReturnPolicy:false,
            resentViewProducts:[],
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
                quantity: this.productForm.quantity,
                size_extra_payment:this.selectItemPrice,
            })
            .then(res => {
                this.notification.message = "The product has been add to cart successfully !";
                this.notification.type = "success";
                this.$store.dispatch('fetchNavbarContent');
            })
        },
        buyProduct(){
            axios.post('/cart/add/'+ this.product.slug,{
                size: this.productForm.size,
                color:this.productForm.color,
                quantity: this.productForm.quantity,
                size_extra_payment:this.selectItemPrice,
            })
            .then(res => {
                this.$store.dispatch('fetchNavbarContent');
                this.$router.push({name:'checkout'});
            })
        }
  },
  created(){
    let des = document.querySelector('meta[name="description"]');
    let tags = document.querySelector('meta[name="robots"]');
    let verify = document.querySelector('meta[name="verify-v1"]');
    let shareImage = document.querySelector('meta[property="og:image"]');
    let slug = this.$route.params.slug;
    axios.get('/product/' + slug)
    .then( res =>{
        this.product = res.data['product'];

        //meta tag
        des.setAttribute('content',this.product.short_text);
        let tagsArray = [];
        this.product.tags.forEach((value,index) =>{
            tagsArray.push(value.tag_name);
        })
        tags.setAttribute('content', tagsArray);
        verify.setAttribute('content',this.product.product_title)
        shareImage.setAttribute('content','/'+this.product.image_url)
        let length = this.product.all_images.length;
        this.productImages = this.product.all_images.slice(1,length);
        this.relatedProducts = res.data['relatedProducts'];
        this.returnPolicy  = res.data['returnPolicy'];
        this.resentViewProducts = res.data['resentView'];
        
        if(this.product.video_link){
            this.productVideo = true;
        }
    });
  }
};

</script>