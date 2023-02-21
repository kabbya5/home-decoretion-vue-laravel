<template>
    <div class="mt-[90px] md:mt-0 md:py-10 container mx-auto">
        <div class="my-4 text-center">
            <h2 class="text-gray-800 font-bold capitalize text-2xl">
                Shopping Cart 
            </h2>

            <div class="my-6 md:mb-20">
                <router-link :to="{name:'home'}" class="text-gray-600 font-semibold">
                    Home  /
                </router-link>
                <router-link :to="{name:'cart-content'}" class="text-gray-600 font-semibold">
                    Shopping cart
                </router-link>
            </div>
            
        </div>
        <div class="my-4">
            <h2 class="text-gray-900 font-bold text-[18px] mx-4"> Your cart items </h2>
            <div class="my-8 overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product 
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                qty
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Total
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="(cart,index) in carts" :key="index" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex w-96">
                                    <div class="w-32 h-32">
                                        <img  class="w-full h-full object-fit" :src="'/'+cart.options.img" :alt="cart.id">
                                    </div>
                                    <router-link :to="{name:'product-detail',params:{slug:cart.id}}" class="text-gray-900 font-semibold text-lg mx-4 w-60"> {{cart.options.product_title}}</router-link>
                                </div>
                            </th>
                            <td class="py-4 px-6 text-lg font-semibold text-slate-700">
                                {{ cart.price }} TK
                            </td>
                            <td class="py-4 px-6 text-lg font-semibold text-slate-700">
                                <div class="flex h-10 w-[90px] items-center">
                                    <label for="qty" class="w-full text-gray-700 text-lg font-semibold "> qty
                                    </label>
                                    <input type="number" @change="cartUpdate" v-model="cart.qty" 
                                        :data-rowId="cart.rowId" class="w-full px-2 border-2 border-gray-200 focus:outline-none">
                                </div>
                            </td>
                            <td class="py-4 px-6 text-lg font-semibold text-slate-700">
                                {{ cart.subtotal }} TK
                            </td>
                            <td class="py-4 px-6">
                                <router-link :to="{name:'product-detail',params:{slug:cart.id}}" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </router-link> 
                                <button @click="removeCartProduct(cart.rowId)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between mx-4">
            <button @click="cartDestroy" class="px-8 py-2 rounded-md text-white bg-cyan-500 trasiton duration-300 hover:bg-cyan-800"> Clear All </button>
        </div>

        <div class="my-8 grid grid-cols-12 gap-4">
            <div class="mx-4 col-span-12 md:col-span-6 lg:col-span-8">
                <form @submit.prevent="applyCoupon">
                    <div class="flex items-center">
                        <input type="text" placeholder="Coupon Code" v-model="couponCheck.coupon_name"
                        class="px-2 py-2 border-2 border-gray-300 w-full focus:outline-none">
                        <button type="submit" class="w-40 capitalize font-bold py-2 bg-gray-200 border-2 border-gray-300">
                            apply coupon
                        </button>
                    </div>
                    
                    <p v-if="errors.coupon_name" class="text-red-500"> {{errors.coupon_name[0] }}</p>
                    <p v-if="errors.unvalid" class="text-red-500"> {{errors.unvalid }}</p>
                    <p v-if="coupon" class="my-4 text-orange-800 text-xl font-bold"> You get {{ coupon.discount }} % for {{ coupon.coupon_name }} and save {{ coupon.get_discount }} TK </p>
                </form>
                <div v-if="siteSetting.advance_payment_limit < subtotal" class="my-4 flex flex-col justify-center">
                    <div class="py-4">
                        {{ siteSetting.advance_payment_limit_message }}
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-4 my-4 md:my-0">
                <div class="px-4 border-2 border-gray-200">
                    <h2 class="text-center uppercase py-6"> total Cost </h2>
                    <div class="text-center  text-slate-500">
                        <div class="flex justify-between my-2">
                            <p> Subtotal:</p>
                            <span> {{subtotal}} TK </span>
                        </div>
                        <div v-if="coupon" class="flex text-gray-500 font-semibold justify-between my-2">
                            <p> Discount:</p>
                            <span> {{ coupon.get_discount }} TK </span>
                        </div>
                        <div class="flex justify-between text-gray-600 font-bold my-2">
                            <p> Grand Total:</p>
                            <span v-if="coupon"> {{coupon.finalDiscount}} TK </span>
                            <span v-else> {{subtotal}} TK </span>
                        </div>

                        <router-link :to="{name:'checkout'}" class="my-6 py-2 block w-full uppercase bg-green-500 text-white text-center rounded-md transiton duration-300 hover:bg-green-800">
                            Checkout 
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <LoadingVue v-if="loading" :loading="loading" />
        <NotificationAdminVue v-if="notification.message" :notification="notification" />
    </div>
</template>
<script>
    import LoadingVue from '../components/Loading.vue';
    import NotificationAdminVue from './admin/NotificationAdmin.vue';
    import Product from '../components/Product.vue';

    export default{
        components:{LoadingVue, NotificationAdminVue,Product},
        data(){
            return {
                loading:false,
                carts:{},
                resentViewProducts:{},

                siteSetting:'',
                subtotal:'',

                couponCheck:{},
                errors:{},
                coupon:'',

                notification:{
                    type:'',
                    message:'',
                }
            }      
        },
        methods:{
            cartUpdate(e){
                let rowId = e.target.getAttribute('data-rowId');
                let qty = e.target.value;
                axios.put('/update/cart/' + rowId, {qty:qty})
                .then(res => {
                    this.$store.dispatch('fetchNavbarContent');
                    this.loading = true;
                    this.reloadPage();
                    this.notification.type = 'success',
                    this.notification.message = " Successfully cart update !";
                    this.coupon = false;
                    this.loading = false;
                    setTimeout(() => this.notification ={}, 2000)
                })
            },
            
            removeCartProduct(rowId){
                axios.delete('/remove/cart/product/'+ rowId)
                .then(res =>{
                    this.notification.message = 'The product has been remove';
                    this.notification.type = 'success';
                    this.$store.dispatch('fetchNavbarContent');
                    this.reloadPage();
                })
            },
            cartDestroy(){
                axios.delete('/cart/destroy')
                .then(res => {
                    this.$route.push({name:'shopPage'});
                    this.$store.dispatch('fetchNavbarContent');
                })
            },
            applyCoupon(){
                axios.get('/coupon/check',{params:{coupon_name:this.couponCheck.coupon_name}})
                .then(res => {
                    this.coupon = res.data;
                    this.errors = {};
                    this.notification.type = 'success';
                    this.notification.message = " Successfully added Coupon !";
                    this.$store.dispatch('fetchNavbarContent');
                    this.reloadPage();
                })
                .catch(errors =>{
                    this.errors =errors.response.data.errors;
                })
            },
            reloadPage(){
                axios.get('/shopping/carts')
                .then(res => {
                    this.carts = res.data['carts'];
                    this.siteSetting = res.data['siteSetting'];
                    this.subtotal = res.data['subtotal'];
                    this.resentViewProducts = res.data['resentProduct'];
                })
            },
        },
        created(){
            axios.get('/shopping/carts')
            .then(res => {
                this.carts = res.data['carts'];
                this.siteSetting = res.data['siteSetting'];
                this.subtotal = res.data['subtotal'];
                this.resentViewProducts = res.data['resentProduct'];
            })
        }
    }
</script>