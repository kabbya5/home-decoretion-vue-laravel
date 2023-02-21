<template>
    <div class="my-8">
        <div class="px-3 container mx-auto">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-4 lg:col-span-3 bg-white border border-gray-200 my-5">
                    <div class="border shadow-md m-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-4 md:py-10 inline-block min-w-full sm:px-6 lg:px-8 shadow border-b border border-gray-200 sm:rounded-lg">
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="border-b text-left my-5">
                                                <tr>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Image
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Product Code
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Size
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Color
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Quantity
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Price
                                                    </th>
                                                    <th scope="col" class="text-xl  font-medium text-gray-600 px-2 py-2 text-left">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                                    <tr v-for="detail in orderDetails" :key="detail.id" class="border-b">
                                                        <td class="px-2 py-2 whitespace-nowrap text-xl  font-medium text-gray-600">
                                                            <div> 
                                                                <router-link :to="{name:'product-detail',params:{slug:detail.product.slug}}">
                                                                    <img :src="'/'+detail.product.image_url" :alt="detail.product.product_title" class="-ml-2 w-10 h-10 rounded-md">
                                                                </router-link>                                                         
                                                            </div>
                                                        </td>
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            <div class="flex flex-col">
                                                                <router-link :to="{name:'product-detail',params:{slug:detail.product.slug}}">
                                                                    <span class="text-xl  text-gray-600 font-md"> {{ detail.product.product_code }}</span>
                                                                </router-link> 
                                                            </div> 
                                                        </td>                             
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            {{ detail.size}}
                                                        </td>
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            {{ detail.color}}
                                                        </td>
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            {{ detail.quantity}}
                                                        </td>
                                                        
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            {{detail.single_price}}
                                                        </td>
                                                        <td class="text-xl  text-gray-600 font-md px-2 py-2 whitespace-nowrap">
                                                            {{detail.total_price}}
                                                        </td>                      
                                                    </tr> 
                                                    <tr>
                                                        <td v-if="order.coupon" colspan="7" align="right" class="py-2"> 
                                                            <span class="font-[500] text-gray-600 text-xl capitalize">
                                                                {{ order.coupon }} Discount:
                                                                <span class="text-red-900 text-xl  pl-5 font-[500]">
                                                                    {{order.discount}}  TK
                                                                </span>  
                                                            </span> 
                                                        </td>   
                                                    </tr>
                                                    <tr class="mt-5">
                                                        <td colspan="7" align="right" class="py-2"> 
                                                            <span class="font-[500] text-gray-600 text-xl capitalize">
                                                                Delivery Cost: <span class="text-gray-600 text-xl  pl-5 font-[500]"> {{ order.delivery_cost }} Tk</span>
                                                            </span> 
                                                        </td>
                                                    </tr>
                                                    <tr class="mt-5">
                                                        <td colspan="7" align="right" class="py-2"> 
                                                            <span class="font-[500] text-red-900  text-xl capitalize ">
                                                                Sub Total: <span class="text-red-900 text-xl  pl-5 font-[500]"> {{ order.subtotal }} Tk</span>
                                                            </span> 
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
        
                     <!-- shipping address   -->
        
                    <div class="my-5 md:my-10 py-5">
                        <h4 class="font-[600] text-2xl text-center"> Customer And Order Details  </h4>
                       
                        <div class="flex justify-between items-center  border border-gray-200 mt-5">
                            <h4 class="text-xl pl-4 pr-10 py-3 font-md text-gray-600"> Customer Name: </h4>
                            <p v-if="shipping" class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.name }} </p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600"> Customer Phone: </h4>
                            <p v-if="shipping" class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.phone }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600"> Customer Email: </h4>
                            <p v-if="shipping" class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.email }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class="font-md text-gray-600 text-xl  pl-4 pr-10 py-3 font-md"> Customer Addresss: </h4>
                            <p v-if="shipping" class="text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.address }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600"> Customer district: </h4>
                            <p v-if="shipping" class=" text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.district}}</p>
                        </div>
                    </div>

                </div>
                <div class="col-span-4 lg:col-span-1">
                    <div class="p-5 w-full bg-white">
                        <h4 class="font-[500] text-2xl pb-4"> Order Details  </h4>
                        <div class="flex items-center border border-gray-200 py-2">
                            <img v-if="user.profile_img" :src="'/'+user.profile_img" alt="" class="w-10 h-10 rounded-full">
                            <i v-else class="fa-solid fa-user fa-2x"></i>
                            <span v-if="user"  class="mx-2 text-xl font-md"> {{ user.first_name }} {{ user.last_name }}</span>
                        </div>
                        
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-[500] text-2xl text-gray-600 my-2"> Order Summary  </h4>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-xl py-3 text-gray-600"> Created : </h4>
                            <p class="font-semibold ml-2 text-xl py-3 text-gray-600"> {{ order.created_date }} </p>
                        </div>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-xl  py-3 text-gray-600"> Time : </h4>
                            <p class="font-semibold ml-2 text-xl py-3 text-gray-600"> {{ order.created_time }} </p>
                        </div>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-md text-xl py-3 text-gray-600"> Payment: </h4>
                            <p class="font-md ml-2 text-xl py-3 text-gray-600"> {{ order.payment_type }} </p>
                        </div>  
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-md text-xl py-3 text-gray-600"> Delivery: </h4>
                            <p class="font-md ml-2  text-xl py-3 text-gray-600"> {{ order.delivery_type }} </p>
                        </div>              
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-lg text-gray-600 my-2 uppercase"> Subtotal : </h4>
                            <p class="font-semibold text-xl text-gray-600 my-2 px-4">{{ order.subtotal  }} TK</p>
                        </div>               
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-[500] text-lg text-gray-600 my-2"> Delivery Address </h4>
                        <div class="flex items-center border-gray-200">
                            <p v-if="shipping" class="font-md text-xl  pl-4 pr-10 py-3 font-md text-gray-600">{{ shipping.address }}</p>
                        </div>          
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-[500] text-lg text-gray-600 my-2"> Delivery Comment </h4>
                        <div class="flex items-center border-gray-200">
                            <p  v-if="shipping" class="text-sm  px-2 pr-10 py-3 font-md text-gray-600">{{ shipping.comment }}</p>
                        </div>            
                    </div>
                    <div class="py-2 w-full bg-red-500 text-white" :id="order.status">
                        <p class="font-[500] text-lg  text-center"> {{ order.status }} </p>        
                    </div>

                </div>
                <div class="col-span-4">
                    <div class="flex justify-center items-center my-5 py-5">
                        <div v-if="order.status == 'new'">
                            <button @click="orderStatusChange('accept')">
                                <div class="py-2 px-5 mx-5 w-full bg-blue-800 text-white transition hover:bg-blue-700 duration-300">
                                    <p class="font-[500] text-lg  text-center"> Accept Order </p>        
                                </div>
                            </button>
                            <button @click="orderStatusChange('cancle')">
                                <div class="py-2 px-5 mx-5 w-full bg-red-800 text-white transition hover:bg-red-400 duration-300">
                                    <p class="font-[500] text-lg  text-center"> Cancle Order </p>        
                                </div>
                            </button>
                        </div>
                        
                        <button @click="orderStatusChange('shipping')" v-if="order.status == 'accept'">
                            <div class="py-2 px-5 mx-5 w-full bg-red-800 text-white transition hover:bg-red-500 duration-300">
                                <p class="font-[500] text-lg  text-center"> Shipping Order </p>        
                            </div>
                        </button>
                        <button @click="orderStatusChange('completed')" v-if="order.status == 'shipping'">
                            <div class="py-2 px-5 mx-5  w-full bg-blue-600 text-white transition hover:bg-blue-500 duration-300">
                                <p class="font-[500] text-lg  text-center">  completed Order  </p>        
                            </div>
                        </button>

                        <button @click="orderStatusChange('accept')" v-if="order.status == 'cancle'">
                            <div class="py-2 px-5 mx-5  w-full bg-red-800 text-white ">
                                <p class="font-[500] text-lg  text-center">  Accept Again </p>        
                            </div> 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return {
            order:{},
            orderDetails:[],
            shipping:{},
            user:{},
        }
    },
    created(){
        let slug = this.$route.params.slug;
        axios.get('/user/order/details/'+ slug)
        .then(res => {
            this.order = res.data['order'];
            this.orderDetails = res.data['orderDetails'];
            this.shipping = res.data['shipping'];
            this.user = res.data['user'];
        })
    }
}
</script>
<style scoped>
    table th, table td{
        padding:15px;
        font-size: 20px;
    }
    #new{
        text-transform: capitalize;
        color:white;
        background-color: rgb(4 120 87) !important;
        transition: 0.3s all;
    }
    #accept{
        text-transform: capitalize;
        color:white;
        background-color: rgb(14 116 144);
        transition: 0.3s all; 
    }
    #shipping{
        text-transform: capitalize;
        color:white;
        background-color: rgb(30 64 175);
        transition: 0.3s all; 
    }
    #completed{
        text-transform: capitalize;
        color:white;
        background-color: rgb(22 101 52);
        transition: 0.3s all; 
    }
    #cancle{
        text-transform: capitalize;
        color:white;
        background-color: rgb(159 18 57);
        transition: 0.3s all; 
    }
</style>