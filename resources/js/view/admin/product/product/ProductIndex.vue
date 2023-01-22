<template>
    <div>
        <NotificationAdmin v-if="notification.message" :notification="notification" />
        <div class="header flex justify-between items-center">
            <div class="flex items-center">
                <button @click="allProductsShow" class="px-4 py-1 bg-green-500 rounded-md text-white font-bold uppercase transition duration-300 hover:bg-cyan-800">
                     all 
                </button> 
                <button @click="trashedProudcts" class="mx-4 px-4 py-1 bg-orange-500 rounded-md text-white font-bold uppercase transition duration-300 hover:bg-cyan-800">
                    trashed
               </button>
                <router-link :to="{name:'adminPrdouctCreate'}" 
                class="mx-4  py-1 px-5 text-white bg-cyan-500 capitalize rounded-md transition duration-300 hover:bg-cyan-800"> 
                    <i class="fa-solid fa-plus"></i> 
                </router-link>
            </div>
            <div class="flex items-center mx-4  w-80">
                <input type="search" placeholder="secrch product" @keyup="productFilter"
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
                        <th v-if="(showProductsType=='all')" scope="col" class="py-3 px-6">
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
                                    <img v-for="img in product.images" :key="img.id"  :src="img.img" :alt="img.product_img_name"
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
                        <td v-if="(showProductsType=='all')" class="py-4 px-6">
                            {{ product.published }}
                        </td>
                        <td v-if="(showProductsType=='all')" class="py-4 px-6">
                            <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"  class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </router-link> 
                            <button @click="deleteProdcut(product.id)" class="py-1 my-2 px-2 bg-red-700 text-white">  
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                        <td v-if="(showProductsType=='trashed')" class="py-4 px-6">
                            <button @click="trashRestore(product.id)" class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-solid fa-rotate-left"></i>
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
import NotificationAdmin from '../../NotificationAdmin.vue';
export default{
    components:{NotificationAdmin,},
    data(){
        return{
            showProductsType:'all',
            showProducts:[],
            showProductLength:5,
            allProducts:[],
            allProductLength:'',
            btnMessage:"load more",

            notification:{
                type:'',
                message:'',
                deleteId:'',
            }
        }
    },

    methods:{
        loadMore(){
            this.btnMessage = 'looding...';
            this.showProductLength = this.showProductLength + 10;
            this.showProducts = this.allProducts.slice(0, this.showProductLength);
            this.btnMessage = 'load more';
        },
        allProductsShow(){
            this.showProductsType = 'all';
            this.reloadPage();
        },
        trashedProudcts(){
            this.showProductsType = 'trashed';
            axios.get('/admin/product/trashed')
            .then(res =>{
                this.allProducts = res.data;
                this.showProducts = this.allProducts.slice(0,5);
                this.allProductLength = res.data.length;
            })
        },
        deleteProdcut(id){
            axios.delete('/admin/product/delete/'+id)
            .then(res =>{
                this.notification.type='delete';
                this.notification.message = 'Do you Want To delete Product';
                this.notification.deleteId = id;
                this.showProducts = this.showProducts.filter(product => product.id !== id );
            })    
        },
        trashRestore(id){
            axios.post('/admin/product/restore/'+id)
            .then(res =>{
                this.notification.type='success';
                this.notification.message='successfully Restored ! ';
                this.showProducts = this.showProducts.filter(product => product.id !== id);
            })
        },
        restore(id){
            axios.post('/admin/product/restore/'+id)
            .then(res =>{
                this.notification.type='success';
                this.notification.message='successfully Restored ! ';
                this.reloadPage();
            })
        },
        reloadPage(){
            axios.get('/admin/products')
            .then( res =>{
                this.allProducts = res.data;
                this.showProducts = this.allProducts.slice(0,5);
                this.allProductLength = res.data.length;
                
            })
        },
        productFilter(e){
            let productTitle = e.target.value.toLowerCase();
            this.allProducts = this.allProducts.filter(
                product => product.product_title.toLowerCase().includes(productTitle)
            );
            this.showProducts = this.allProducts;
            if(!productTitle){
                this.reloadPage();
            }else if(!this.showProducts.length){
                this.reloadPage;
            }
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