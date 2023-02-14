<template>
    <div class="mt-[90px] md:mt-0 md:py-10 text-center">
        <h2 class="text-gray-800 font-bold capitalize text-2xl">
            wishlist 
        </h2>

        <div class="my-6">
            <router-link :to="{name:'home'}" class="text-gray-600 font-semibold">
                Home  /
            </router-link>
            <router-link :to="{name:'wishlist'}" class="text-gray-600 font-semibold">
                Whislist
            </router-link>
        </div>

        <div class="my-4">
            <h2 class="text-gray-900 font-bold text-[18px] mx-4 text-left"> Your wishlist items </h2>
            <div class="my-8 overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product 
                            </th>
                            <th scope="col" class="py-3 px-6">
                                price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                created date
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="wishlist in wishlists" :key="wishlist" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex items-center w-96">
                                    <div class="w-32 h-32">
                                        <img  class="w-full h-full object-fit" :src="'/'+wishlist.product.image_url" :alt="wishlist.product_title">
                                    </div>
                                    <router-link :to="{name:'product-detail',params:{slug:wishlist.product.slug}}" class="text-gray-900 font-semibold text-lg mx-4 w-60"> {{wishlist.product.product_title}}</router-link>
                                </div>
                            </th>
                            <td class="py-4 px-6 text-lg font-semibold text-slate-700">
                                <div v-if="wishlist.product.discount_price" class="flex items-center my-4">
                                    <del> {{ wishlist.product.price }} TK </del>
                                   <span class="mx-4 text-red-500 font-bold text-xl"> {{ wishlist.product.discount_price }}  TK </span>   
                               </div>
                               <div v-else class="flex items-center my-4">
                                   <span class="mx-4 text-red-500 font-bold text-xl"> {{ wishlist.product.price  }}  TK </span>   
                               </div>
                            </td>
                            <td class="py-4 px-6 text-lg font-semibold text-slate-700">
                                <div class="flex h-10 w-[130px] items-center">
                                    {{ wishlist.created_date }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <router-link :to="{name:'product-detail',params:{slug:wishlist.product.slug}}" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </router-link> 
                                <button @click="removeWhislist(wishlist.id)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <NotificationAdminVue v-if="notification.message" :notification="notification" />

    </div>
</template>

<script>
import NotificationAdminVue from './admin/NotificationAdmin.vue';
export default{
    components:{NotificationAdminVue},
    data(){
        return{
            wishlists:[],
            notification:{
                type:'',
                messaeg:'',
            }
        }
        
    },
    methods:{
        removeWhislist(id){
            axios.delete('/user/wishlists/'+id)
            .then(res => {
                this.notification.type ='success',
                this.notification.message = 'Product has been delete succesfully !';
                this.reloadPage();
            })
        },
        reloadPage(){
            setTimeout(() => this.notification = {}, 30000)
            axios.get('/user/wishlists')
            .then(res =>{
                this.wishlists = res.data;
            })
        }
    },
    created(){
        axios.get('/user/wishlists')
        .then(res => {
            this.wishlists = res.data;
        })
    }
}
</script>