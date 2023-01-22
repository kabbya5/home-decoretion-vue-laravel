<template>
    <div class="w-full">
        <div class="my-10">
            <Notification  :notification="notification" v-if="notification.message" /> 
            <div class="flex flex-col md:flex-row items-center justify-between">
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           size title
                        </th>
                        <th scope="col" class="py-3 px-6">
                           size extary TK
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Created At
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="size in sizes" :key="size.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ size.size_title }}
                        </th>
                        <td class="py-4 px-6">
                            {{ size.size_extra_payment }}
                        </td>
                        <td class="py-4 px-6">
                            {{ size.created_date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(size)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deletesize(size.id,size.sizeName)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- more button  -->
        <div @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ sizesCount }}
            </div>
            <div v-if="length <= sizeLength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed z-50 top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[500px] px-4 my-8  bg-white pb-4">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ?createSize() : updateSize()" enctype="multipart/form-data">
                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="title" class="text-gray-500 font-semibold px-1 my-2"> Size Title : </label>
                                <i class="fa-regular fa-star text-red-500 my-2"></i>
                            </div>
                            <textarea  v-model="size.size_title"
                                class="px-2 py-1 border-2 border-gray-200 focus:outline-none"
                                :class="{'border-red-500':errors.size_title}"> 
                            </textarea>
                            <p v-if="errors.size_title" class="px-1 text-red-500"> {{errors.size_title[0]}}</p>
                        </div>
                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="title" class="text-gray-500 font-semibold px-1 my-2"> For extra in taka(intial:0) : </label>
                                <i class="fa-regular fa-star text-red-500 my-2"></i>
                            </div>
                            <input type="text"  v-model="size.size_extra_payment" placeholder="extar payment"
                                class="px-2 py-1 border-2 border-gray-200 focus:outline-none"
                                :class="{'border-red-500':errors.size_extra_payment}"> 
                            <p v-if="errors.size_extra_payment" class="px-1 text-red-500"> {{errors.size_extra_payment[0]}}</p>
                        </div>
                        
                       <div class="flex justify-center">
                            <button class="py-1 px-4 text-white bg-cyan-500 transition duration rounded-md hover:bg-cyan-800">
                                {{ formCreate?"create size":"update size" }}
                            </button>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Notification from '../NotificationAdmin.vue';
export default{
    components:{Notification,},
    data(){
        return{
            modal:false,
            sizes:[],
            sizesCount:'',
            length:5,
            allsizes: [],
            sizeLength:'',
            btnMessage:"load more",
            
            // form data 
            content:'',
            size:{
                size_title:'',
                size_extra_payment:'',
            }, 
            errors:{},
            formCreate:true,

            notification:{
                type:'',
                message:"",
            },
        }
    },
    methods: {
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.size = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.sizes= this.allsizes.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        createSize(){
            axios.post('/admin/size/store',this.size)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'size has been Created SuccessFully';
                this.reloadsize();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(size){
            
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.size.id = size.id;
            this.size.size_title = size.size_title;
            this.size.size_extra_payment = size.size_extra_payment;
        },
        updateSize(){
            axios.put('/admin/size/update/'+this.size.id, this.size)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'size has been updated SuccessFully';
                this.reloadsize();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        deletesize(id,name){
            this.notification.type = 'force',
                this.notification.message = 'size has been updated SuccessFully';
        },
        reloadsize(){
            axios.get('/admin/size/index')
            .then(res =>{
                this.allsizes = res.data;
                this.sizes= res.data.slice(0, this.length);
                this.sizesCount = res.data.length +' sizes';
                this.sizeLength = res.data.length;
            });
        },          
    },
    created(){
        axios.get('/admin/size/index')
        .then(res =>{
            this.allsizes = res.data;
            this.sizes= res.data.slice(0, this.length);
            this.sizesCount = res.data.length +' sizes';
            this.sizeLength = res.data.length;
        });
        document.title = 'Admin/Size'
    },
}
</script>