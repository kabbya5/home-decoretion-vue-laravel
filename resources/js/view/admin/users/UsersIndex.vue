<template>
    <div>
        <div class="flex flex-row items-center justify-between">
            <div class="flex flex-row my-10">
                <button @click="getUsers('allUsers')" class="mx-2 px-4 py-1 uppercase border-2 border-blue-800
                    transition duration-300 hover:bg-blue-800 hover:text-white"
                    :class="{'bg-blue-800 text-white':orderStatus=='all'}">
                    users 
                </button>
                <button @click="getUsers('unverified')" class="mx-2 px-4 py-1 mx-4 uppercase border-2 border-red-800
                    transition duration-300 hover:bg-red-800 hover:text-white"
                    :class="{'bg-red-800 text-white':orderStatus=='cancle'}">
                        Unverified Users
                </button>
    
            </div>
            <div class="my-10 serceh-box flex justify-between items-center">
                <h2 v-if="searchUsersCount" class="text-gray-600 text-lg capitalize ml-3"> {{ searchUsersCount}}  </h2>
                <div class="flex px-4">
                    <input type="search" placeholder="Search heare..."  @keyup="searchUsers"
                    class="px-2 h-10 border-2 border-gray-200 w-full md:w-96 focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass text-2xl -ml-8 mt-1 text-gray-600"></i>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            #id
                        </th>
                        <th scope="col" class="py-3 px-6">
                            user name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            email
                        </th>
                        <th scope="col" class="py-3 px-6">
                          user type
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
                    <tr v-for="order in showOrders" :key="order.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{order.order_code }}
                        </th>
                        <td  class="py-4 px-6">
                            {{ order.coupon }}
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
                            <!-- <button @click="deletechildcat(childcat.id,childcat.childCatName)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-regular fa-trash-can"></i>
                            </button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more button  -->

        <div v-if="allOrdersLength > showOrdersLength" @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allOrdersLength - showOrdersLength }} more orders
            </div>
            <div  class="flex justify-center my-4">
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
        return {
            orderStatus:'all',
            showOrders:[],
            allOrders: [],
            allOrdersLength:'',
            showOrdersLength:5,
            btnMessage:"load more",
            searchUsersCount:'',
        }
    },
    methods:{

        loadMore:function(){
            this.btnMessage = 'looding...'
            this.showOrdersLength += 5;
            this.showOrders = this.allOrders.slice(0, this.showOrdersLength);
            this.btnMessage = 'load more'
        },

        getUsers(value){
            this.orderStatus = value;
            axios.get('/admin/all/orders/'+value)
            .then( res => {
                this.allOrders = res.data;
                this.showOrders = res.data.slice(0, this.showOrdersLength);
                this.allOrdersLength = res.data.length;
            })
        },

        searchOrders(e){
            let searchText = e.target.value.toLowerCase();
            this.showOrders = this.allOrders.filter(
                order => order.order_code.toLowerCase().includes(searchText)
            );

            let count = this.showOrders.length;

            this.searchUsersCount = count > 1 ? count + ' Orders' : count + "  order";
        }
    },
    created(){
        axios.get('/admin/all/orders/' + 'allOrder')
        .then(res =>{
            this.allOrders = res.data;
            this.showOrders = res.data.slice(0, this.showOrdersLength);
            this.allOrdersLength = res.data.length;
        })
    }
}
</script>