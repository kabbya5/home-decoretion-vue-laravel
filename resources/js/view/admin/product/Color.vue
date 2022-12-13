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
                           color Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           color Code
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
                    <tr v-for="color in colors" :key="color.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ color.name }}
                        </th>
                        <td class="py-4 px-6">
                            {{ color.colorCode }}
                        </td>
                        <td class="py-4 px-6">
                            {{ color.date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(color)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deletecolor(color.id,color.colorName)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
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
                {{ colorsCount }}
            </div>
            <div v-if="length <= colorLength" class="flex justify-center my-4">
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
                    <form @submit.prevent="formCreate ?createcolor() : updatecolor()" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <label for="name" class="capitalize px-2 my-2 text-gray-600"> color name </label>
                            <input type="text" v-model="color.name" :class="{'border-red-500':errors.name}" 
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Color Name">
                            <p v-if="errors.name" class="my-2 color-red-500"> {{ errors.name[0] }}</p>

                        </div>
                        <div class="flex flex-col my-4">
                            <label for="color Code" class="capitalize px-2 my-2 text-gray-600"> color code </label>
                            <input type="text" v-model="color.colorCode" 
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Color Name">    
                        </div>

                        <button class="px-4 py-1 uppercase text-white bg-blue-800 transition duration-300 rounded-md hover:bg-blue-600">
                            {{ formCreate ?'Create Color':'Update Color' }}
                        </button>
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
            colors:[],
            colorsCount:'',
            length:5,
            allColors: [],
            colorLength:'',
            btnMessage:"load more",
            
            // form data 
            content:'',
            color:{
                name:'',
                colorCode:'',
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
            this.color = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.colors= this.allColors.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        createcolor(){
            axios.post('/api/admin/product/color/create',this.color)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'color has been Created SuccessFully';
                this.reloadcolor();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(color){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.color = {
                id: color.id,
                name:color.name,
                colorCode:color.colorCode,
                
            };
        },
        updatecolor(){
            axios.put('/api/admin/product/color/update/' + this.color.id,this.color)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'Color has been updated SuccessFully';
                this.reloadcolor();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadcolor(){
            axios.get('/api/admin/product/color')
            .then(res =>{
                this.notification.deleteId = null;
                this.notification.type = 'success';
                this.notification.message = 'The color has been deleted successsfully';
                this.allColors = res.data[0];
                this.colors= res.data[0].slice(0, this.length);
                this.colorsCount = res.data[1];
                this.colorLength = res.data[0].length;
            })
        },          
    },
    created(){
        axios.get('/api/admin/product/color')
        .then(res =>{
            this.allColors = res.data[0];
            this.colors= res.data[0].slice(0, this.length);
            this.colorsCount = res.data[1];
            this.colorLength = res.data[0].length;
        });
        document.title = 'Admin/color'
    },
}
</script>