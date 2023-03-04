<template>
    <div class="">
        <div class="flex border-b-2 border-gray-200  px-4 py-2">
            <router-link to="/admin/dashboard" class="capitalize"> dashboard </router-link>
        </div>
        <div class="my-6 grid grid-cols-4 gap-4">
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <router-link :to="{name:'adminOrders'}"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fa-solid fa-cart-shopping text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> {{ orderCompare.orders  }} </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full  px-2 py-1 bg-red-600 text-white">
                                    {{ orderCompare.orderDiffFormLast }}%
                                    <i v-if="orderCompare.is_increase" class="fas fa-angle-up ml-1"></i>
                                    <i v-else class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </router-link>
                </div>    
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <router-link :to="{name:'adminUsers'}">
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fa-regular fa-user text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> {{ userCompare.users }} </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    {{userCompare.userDiffFormLast}}%
                                    <i v-if="userCompare.isIncrease" class="fas fa-angle-up ml-1"></i>
                                    <i v-else class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </router-link>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> {{ orderCompare.orders  }} </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    {{ orderCompare.orderDiffFormLast }}%
                                    <i v-if="orderCompare.is_increase" class="fas fa-angle-down ml-1"></i>
                                    <i v-else class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
        </div>

        <!-- Resent Order  -->
        <div class="flex">
            <h4 class="text-black font-semibold mx-4 my-6 capitalize"> Resent Order </h4>
        </div>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            oder code
                        </th>
                        <th scope="col" class="py-3 px-6">
                            coupon
                        </th>
                        <th scope="col" class="py-3 px-6">
                            discount
                        </th>
                        <th scope="col" class="py-3 px-6">
                            subtotal
                        </th>
                        <th scope="col" class="py-3 px-6">
                          status
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            create date
                        </th>
                        
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="order in orders" :key="order.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{order.order_code }}
                        </th>
                        <td  class="py-4 px-6">
                            {{ order.coupon }}
                        </td> 
                        <td class="py-4 px-6">
                            {{ order.discount}}
                        </td>
                        <td class="py-4 px-6">
                            {{ order.subtotal}}
                        </td>
                        <td class="py-4 px-6">
                            <button :id="order.status" class="text-white px-2 py-1 bg-blue-800 w-full capitalize">
                                {{ order.status }}
                            </button>
                        </td>
                        
                        
                        
                        <td class="py-4 px-6">
                            {{ order.created_date }}
                        </td>

                        <td class="py-4 px-6">
                            <router-link :to="{name:'adminOrderDetails',params:{slug:order.slug}}" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-eye"></i>
                            </router-link> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Top saleing product  -->

        <div class="flex my-4">
            <h4 class="text-black font-semibold mx-4 mt-10 capitalize"> Most popular products </h4>
        </div>

        <div class="mt-10 overflow-x-auto relative shadow-md sm:rounded-lg">
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
                    <tr v-for="product in products" :key="product.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            <div class="flex items-center">
                                <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"
                                class="underline">
                                     {{ product.product_title }} 
                                </router-link>
                                <div class="flex mx-4">
                                    <img v-for="img in product.images" :key="img.id"  :src="'/'+img.product_img" :alt="img.product_img_name"
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
                        <td class="py-4 px-6">
                            <router-link :to="{name:'product-detail',params:{slug:product.slug}}"  class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-regular fa-eye"></i> 
                            </router-link> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                orders: [],
                products:[],
                orderCompare:{
                    orders:'',
                    isIncrease:'',
                    orderDiffFormLast:'', //Order different from last week
                },
                userCompare:{
                    users:'',
                    isIncrease:'',
                    userDiffFormLast:'', 
                }
            }
        },
        mounted() {
            if (localStorage.getItem('reloaded')) {
                localStorage.removeItem('reloaded');
                this.loading = false;
            } else {
                this.loading = true;
                localStorage.setItem('reloaded', '1');
                location.reload();
                
            }
        },
        created(){
            axios.get('/admin/dashboard/content')
            .then(res =>{
                this.orders = res.data['orders'];
                this.products = res.data['products'];
                this.orderCompare.orders = res.data['currentWeekOrders'];
                this.orderCompare.isIncrease = res.data['isOrderIncrease'];
                this.orderCompare.orderDiffFormLast = res.data['weekPerOrder'];

                this.userCompare.users = res.data['currentWeekUsers'];
                this.userCompare.isIncrease = res.data['isUserIncrease'];
                this.userCompare.userDiffFormLast = res.data['currentWeekUsers'];
            });
        }
    }
</script>


<style lang="scss" scoped>
.shoping-report::before{
    position: absolute;
    content: '';
    width: 80%;
    top:100%;
    left: 50%;
    transform: translate(-50%);
    height: 0%;
    z-index: -1;
    background-color: rgb(245, 238, 238);
    transition: all 0.3s;

}
.shoping-report:hover:before{
    height: 10%;
}
</style>>
