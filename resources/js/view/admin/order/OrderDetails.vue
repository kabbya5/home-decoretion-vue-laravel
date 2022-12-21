<template>
    <div class="my-8">
        <div class="px-3">
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-4 lg:col-span-3 bg-white border border-gray-200 my-5">
                    <div class="border shadow-md m-3">
                        <div class="">
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8 shadow border-b border border-gray-200 sm:rounded-lg">
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="border-b text-left my-5">
                                            <tr>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Image
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Product Name
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Size
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Color
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Quantity
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Price
                                                </th>
                                                <th scope="col" class="text-sm font-medium text-gray-900 px-2 py-2 text-left">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                                <tr v-for="detail in orderDetails" :key="detail.id" class="border-b">
                                                    <td class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        <div> 
                                                            <router-link :to="{name:'product-detail',params:{slug:detail.product.slug}}">
                                                                <img :src="detail.product.image_url" :alt="detail.product.product_title" class="-ml-2 w-10 h-10 rounded-md">
                                                            </router-link>                                                         
                                                        </div>
                                                    </td>
                                                    <td class="text-md text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        <div class="flex flex-col">
                                                            <router-link :to="{name:'product-detail',params:{slug:detail.product.slug}}">
                                                                <span class="text-md text-black font-semibold"> {{ detail.product.product_title }}</span>
                                                            </router-link> 
                                                        </div> 
                                                    </td>                             
                                                    <td class="text-sm text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        {{ detail.size}}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        {{ detail.color}}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        {{ detail.quantity}}
                                                    </td>
                                                    
                                                    <td class="text-sm text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        {{detail.single_price}}
                                                    </td>
                                                    <td class="text-sm text-gray-900 font-semibold px-2 py-2 whitespace-nowrap">
                                                        {{detail.total_price}}
                                                    </td>                      
                                                </tr> 
                                                <tr>
                                                    <td v-if="order.coupon" colspan="5" align="right" class="py-2"> 
                                                        <span class="font-bold text-black text-md">
                                                            {{ order.coupon }} Discount:
                                                         </span> 
                                                    </td>
                                                    <td v-if="order.coupon" colspan="3"> 
                                                        <span class="text-red-900 text-md pl-5 font-bold">
                                                            {{order.discount}}  TK
                                                        </span>  
                                                    </td>   
                                                </tr>
                                                <tr class="mt-5">
                                                    <td colspan="5" align="right" class="py-2"> 
                                                       <span class="font-bold text-black text-md">
                                                            Sub-total:
                                                        </span> 
                                                    </td>
                                                    <td colspan="3"> 
                                                        <span class="text-red-900 text-md pl-5 font-bold"> {{ order.subtotal }} Tk</span>
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
        
                    <div class="my-5 py-5">
                        <h4 class="font-semibold text-xl text-center"> Customer And Order Details  </h4>
                       
                        <div class="flex justify-between items-center  border border-gray-200 mt-5">
                            <h4 class=" text-md py-2 px-2 font-semibold text-black"> Customer Name: </h4>
                            <p v-if="shipping" class="mx-1  text-md py-2 px-2 font-semibold text-black">{{ shipping.name }} </p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-md py-2 px-2 font-semibold text-black"> Customer Phone: </h4>
                            <p v-if="shipping" class="mx-1  text-md py-2 px-2 font-semibold text-black">{{ shipping.phone }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-md py-2 px-2 font-semibold text-black"> Customer Email: </h4>
                            <p v-if="shipping" class="mx-1  text-md py-2 px-2 font-semibold text-black">{{ shipping.email }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class="font-semibold text-black text-md py-2 px-2 font-semibold text-black"> Customer Addresss: </h4>
                            <p v-if="shipping" class="mx-1 text-md py-2 px-2 font-semibold text-black">{{ shipping.address }}</p>
                        </div>
                        <div class="flex justify-between items-center border border-gray-200 mt-5">
                            <h4 class=" text-md py-2 px-2 font-semibold text-black"> Customer district: </h4>
                            <p v-if="shipping" class="mx-1  text-md py-2 px-2 font-semibold text-black">{{ shipping.district}}</p>
                        </div>
                    </div>
                    <div class="my-5 py-5">
                        <div  class="flex items-center border-gray-200">
                            <h4  class=" text-md py-2 px-2 font-semibold text-black">{{ order.payment_type }} </h4>   
                        </div> 
                    </div>
                </div>
                <div class="col-span-4 lg:col-span-1 my-5">
                    <div class="p-5 w-full bg-white">
                        <h4 class="font-bold text-lg pb-4"> Order Details  </h4>
                        <div class="flex items-center border border-gray-200 py-2">
                            <img v-if="user.profile_img" :src="user.profile_img" alt="" class="w-10 h-10 rounded-full">
                            <i v-else class="fa-solid fa-user fa-2x"></i>
                            <a v-if="user" href="{{ route('users.update',$order->user->id) }}" class="mx-2"> {{ user.first_name }} {{ user.last_name }}</a>
                        </div>
                        
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-bold text-lg text-gray-900 my-2"> Order Summary  </h4>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-md py-2 px-2 font-semibold text-black"> Created : </h4>
                            <p class="mx-1 font-semibold text-md py-2 px-2 font-semibold text-black"> {{ order.created_date }} </p>
                        </div>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-md py-2 px-2 font-semibold text-black"> Time : </h4>
                            <p class="mx-1 font-semibold text-md py-2 px-2 font-semibold text-black"> {{ order.created_time }} </p>
                        </div>
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-md py-2 px-2 font-semibold text-black"> Payment: </h4>
                            <p class="mx-1 font-semibold text-md py-2 px-2 font-semibold text-black"> {{ order.payment_type }} </p>
                        </div>  
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-semibold text-md py-2 px-2 font-semibold text-black"> Delivery: </h4>
                            <p class="mx-1 font-semibold text-md py-2 px-2 font-semibold text-black"> {{ order.delivery_type }} </p>
                        </div>              
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <div class="flex items-center border-gray-200">
                            <h4 class="font-bold text-lg text-gray-900 my-2 uppercase"> Subtotal : </h4>
                            <p class="font-bold text-xl text-gray-900 my-2 px-4">{{ order.subtotal  }} TK</p>
                        </div>               
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-bold text-lg text-gray-900 my-2"> Delivery Address </h4>
                        <div class="flex items-center border-gray-200">
                            <p v-if="shipping" class="mx-1 font-semibold text-md py-2 px-2 font-semibold text-black">{{ shipping.address }}</p>
                        </div>          
                    </div>
        
                    <div class="my-3 p-5 w-full bg-white">
                        <h4 class="font-bold text-lg text-gray-900 my-2"> Delivery Comment </h4>
                        <div class="flex items-center border-gray-200">
                            <p  v-if="shipping" class="mx-1 text-md py-2 px-2 font-semibold text-black">{{ shipping.comment }}</p>
                        </div>            
                    </div>
                    <div class="py-2 w-full bg-red-500 text-white" :id="order.status">
                        <p class="font-bold text-lg  text-center"> {{ order.status }} </p>        
                    </div>

                </div>
                <div class="col-span-4">
                    <div class="flex justify-center items-center my-5 py-5">
                        <div v-if="order.status == 'new'">
                            <button @click="orderStatusChange('accept')">
                                <div class="py-2 px-5 mx-5 w-full bg-blue-800 text-white transition hover:bg-blue-700 duration-300">
                                    <p class="font-bold text-lg  text-center"> Accept Order </p>        
                                </div>
                            </button>
                            <button @click="orderStatusChange('cancle')">
                                <div class="py-2 px-5 mx-5 w-full bg-red-800 text-white transition hover:bg-red-400 duration-300">
                                    <p class="font-bold text-lg  text-center"> Cancle Order </p>        
                                </div>
                            </button>
                        </div>
                        
                        <button @click="orderStatusChange('shipping')" v-if="order.status == 'accept'">
                            <div class="py-2 px-5 mx-5 w-full bg-red-800 text-white transition hover:bg-red-500 duration-300">
                                <p class="font-bold text-lg  text-center"> Shipping Order </p>        
                            </div>
                        </button>
                        <button @click="orderStatusChange('completed')" v-if="order.status == 'shipping'">
                            <div class="py-2 px-5 mx-5  w-full bg-blue-600 text-white transition hover:bg-blue-500 duration-300">
                                <p class="font-bold text-lg  text-center">  completed Order  </p>        
                            </div>
                        </button>

                        <button @click="orderStatusChange('accept')" v-if="order.status == 'cancle'">
                            <div class="py-2 px-5 mx-5  w-full bg-red-800 text-white ">
                                <p class="font-bold text-lg  text-center">  Accept Again </p>        
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
    methods:{
        orderStatusChange(value){
            axios.put('/admin/order/update/'+this.order.id,{status:value})
            .then(res => this.reloadPage());
        },
        reloadPage(){
            let slug = this.$route.params.slug;
            axios.get('/admin/order/' + slug)
            .then(res => {
                this.order = res.data['order'];
                this.orderDetails = res.data['orderDetails'];
                this.shipping = res.data['shipping'];
                this.user = res.data['user'];
            })
        },
    },
    created(){
        let slug = this.$route.params.slug;
        axios.get('/admin/order/' + slug)
        .then(res => {
            this.order = res.data['order'];
            this.orderDetails = res.data['orderDetails'];
            this.shipping = res.data['shipping'];
            this.user = res.data['user'];
        })
    }
}
</script>
<style>
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