<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        
        <div class="my-10 flex flex-row justify-between items-center pb-2">
            <div class="flex">
                <div class="text-center  text-gray-700 font-bold text-xl capitalize"> product delivery setting  </div>
            </div>
            <button @click="createModalForm" class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                transition duration-300 hover:bg-indigo-800 hover:text-white"> create new</button>
        </div>
        <!-- data table  -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           delivery title
                        </th>
                        <th scope="col" class="py-3 px-6">
                          delivery cost
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="link in deliverySettings" :key="link.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ link.delivery_title }}
                        </th>
                        <td class="py-4 px-6">
                            {{link.delivery_cost}} TK
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editdeliverySetting(link)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- modal form  -->
        <div v-if="modal" class="fixed modal z-50 top-0 left-0 w-full h-screen bg-gray-200/60">
            <div class="flex justify-center items-center">
                <div class="w-96 -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>  
                    </button>
                    
                    <form @submit.prevent="formCreate ? createdeliverySetting() : updatedeliverySetting()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="delivery_title" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Delivery Title </label>
                            <input type="text" placeholder="Delivery Title"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.delivery_title}"
                            v-model="deliverySetting.delivery_title">

                            <p v-if="errors.delivery_title" class="text-red-500">{{ errors.delivery_title[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                          
                            <label for="delivery_cost" class="my-3 mx-4 text-lg text-gray-500 capitalize"> delivery Cost </label>
                            <i class="" :class="deliverySetting.delivery_cost"></i>

                            <input type="text" placeholder="Delivery Cost"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.delivery_cost}"
                            v-model="deliverySetting.delivery_cost">
                            <p v-if="errors.delivery_cost" class="text-red-500">{{ errors.delivery_cost[0] }}</p>
                        </div>

                        <button type="submit" class="capitalize py-2 my-4 px-4 bg-indigo-800 text-white rounded-md transition duratuion-300 hover:bg-indigo-600">
                             {{ formCreate ? 'create link' :'update link'}} 
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <LoadingVue v-if="loading" :loading="loading" />
    </div>
</template>
<script>
import Notification from '../NotificationAdmin.vue';
import LoadingVue from '../../../components/Loading.vue';

export default{
    components: {
    Notification,LoadingVue,
  },

    data (){
        return{
            loading:'loading...',
            modal:false,
            formCreate:true,
            deliverySettings:[],
            deliverySetting:{},
            errors:{},

            notification:{
                type:'',
                message:'',
            }
        }
    },
    methods:{
        createModalForm(){
            this.modal = true;
            this.formCreate = true;
            this.errors = {};
            this.deliverySetting= {};
        },
        createdeliverySetting(){
            axios.post('/admin/delivery/setting/create',this.deliverySetting)
            .then(res =>{
                this.modal = false;
                this.deliverySettings.push(this.deliverySetting);
                this.loading = 'loading...',
                this.notification.type ='success',
                this.notification.message = " The delivery setting has been created successfully";
                this.loading = false;
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        editdeliverySetting(setting){
            this.deliverySetting = setting;
            this.formCreate = false;
            this.modal = true;
            this.errors = {};
        },
         updatedeliverySetting(){
            axios.put('/admin/delivery/setting/'+ this.deliverySetting.id,this.deliverySetting)
            .then(res =>{
                this.modal = false;
                this.loading = 'loading...'
                this.notification.type ='success',
                this.notification.message = " The delivery setting has been updated successfully";
                this.loading = false;
            })
        },
    },
        
       
    mounted(){
        axios.get('/admin/delivery/settings')
        .then(res =>{
            this.deliverySettings = res.data;
            this.loading = false;
        })
         
    },
    created(){
        let pagedelivery_title = document.delivery_title;
        document.delivery_title = 'delivery-setting| admin| ' + pagedelivery_title;
    }
}
</script>