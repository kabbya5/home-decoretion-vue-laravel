<template>
    <div class="container px-2 py-10 md:px-0  mx-auto">
        <div v-if="orders">
            <!-- ALL Orders  -->
            <div class="flex">
                <h4 class="text-black text-xl font-semibold mx-4 my-6 capitalize"> ALL Orders </h4>
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
                                <router-link :to="{name:'user-order-details',params:{slug:order.slug}}" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-eye"></i>
                                </router-link> 
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-else>
            <h4 class="text-black text-xl font-semibold mx-4 my-6 capitalize"> Orders Not Founds </h4>
        </div>
        
    </div>
    
</template>

<script>
    export default{
        data(){
            return{
                orders:false,
            }
        },
        created(){
            axios.get('/user/orders')
            .then(res =>{
                this.orders = res.data;
            });
        }
    }
</script>
<style scoped>
    table th, table tr{
        padding: 10px;
        font-size: 16px;
        text-align: center;
    }
</style>