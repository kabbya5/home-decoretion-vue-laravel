<template>
    <div>
        <div class="header flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="text-gray-700 font-bold uppercase"> all products</h2> 
                <router-link :to="{name:'adminPrdouctCreate'}" 
                class="mx-4  py-1 px-5 text-white bg-cyan-500 capitalize rounded-md transition duration-300 hover:bg-cyan-800"> 
                    create new Prodduct  
                </router-link>
            </div>
            <div class="flex items-center mx-4  w-80">
                <input type="search" placeholder="secrch product"
                class="py-1 px-2 border-2 border-gray-200 focus:outline-none w-full">
                <i class="fa-solid fa-search bg-gray-300 h-9 flex items-center justify-center px-4 cursor-pointer"></i>
            </div>
        </div>

        <!-- product Table  -->
        
        <div class="my-10 overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Product name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Category
                        </th>
                        <th scope="col" class="py-3 px-6">
                            price
                        </th>
                        <th scope="col" class="py-3 px-6">
                            quantity
                        </th>
                        <th scope="col" class="py-3 px-6">
                            published_at
                        </th>
                        <th scope="col" class="py-3 px-6">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in showProducts" :key="product.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            <div class="flex items-center">
                                <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"
                                class="underline">
                                     {{ product.product_title }} 
                                </router-link>
                                <div class="flex mx-4">
                                    <img v-for="img in product.images" :key="img.id"  :src="img.product_img" :alt="img.product_img_name"
                                    class="w-12 h-10 rounded-full -ml-2 transition duration-300 hover:scale-[1.2]">
                                </div>
                            </div>   
                        </th>
                        <td class="py-4 px-6">
                            {{product.category.categoryName}}
                        </td>
                        <td class="py-4 px-6">
                           {{ product.discount_price ? product.discount_price : product.price }} TK
                        </td>
                        <td class="py-4 px-6">
                            {{ product.quantity }}
                        </td>
                        <td class="py-4 px-6">
                            {{ product.date }}
                        </td>
                        <td class="py-4 px-6">
                            <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"  class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </router-link> 
                            <button  class="py-1 px-2 bg-red-700 text-white">  
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- more button  -->

        <div @click="loadMore">
            <div v-if="(showProductLength <= allProductLength)" class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allProductLength - showProductLength }} products More
            </div>
            <div v-if="showProductLength <= allProductLength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

    </div>
</template>
<script>
export default{
    data(){
        return{
            showProducts:[],
            showProductLength:5,
            allProducts:[],
            allProductLength:'',
            btnMessage:"load more",
        }
    },

    methods:{
        loadMore(){
            this.btnMessage = 'looding...';
            this.showProductLength = this.showProductLength + 10;
            this.showProducts = this.allProducts.slice(0, this.showProductLength);
            this.btnMessage = 'load more';
        }
    },
    mounted(){
        axios.get('/admin/products')
        .then( res =>{
            this.allProducts = res.data;
            this.showProducts = this.allProducts.slice(0,5);
            this.allProductLength = res.data.length;
            
        })
    },

    created(){
       
    }
}
</script>