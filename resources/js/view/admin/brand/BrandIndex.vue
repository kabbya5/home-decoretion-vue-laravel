<template>
    <div class="w-full">
        <div class="my-10">
            <!-- :restoreCatgory="restoreCatgoryParent" -->
            <Notification  :notification="notification" v-if="notification.message" /> 
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex">
                    <button class="font-semibold"> All brands </button>
                </div>
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Brand Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Brand Image
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
                    <tr v-for="brand in brands" :key="brand.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ brand.name }}
                        </th>
                        <td class="py-4 px-6">
                            <img class="w-10 h-10" :src="brand.brand_img" alt="">
                        </td>
                        <td class="py-4 px-6">
                            {{ brand.date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(brand)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deleteBrand(brand.id,brand.name)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
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
                {{ brandsCount }}
            </div>
            <div v-if="length <= brandsLength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex items-center justify-center">
                <div class="my-10  w-[500px] px-4 py-8  bg-white">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ? createBrand() : updateBrand()" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe brand Name </label>
                            <input type="text" placeholder="brand Name"
                            :class="{'border-1 border-red-500':errors.name}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300" v-model="brand.name">

                            <p v-if="errors.name" class="text-red-500"> {{ errors.name[0] }} </p>
                        </div>
                        <div class="flex flex-col">
                            <label for="image" class="my-2 mx-4 text-gray-500 font-semibold"> brand Image </label>
                            <div class="flex justify-between items-center">
                                <input type="file" placeholder="brand Image"
                                    class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" 
                                    @change="onFileChange">

                                <img class="ml-2 w-14 h-14 rounded-full" :src="brand.brand_img ? brand.brand_img : brand.oldImg" alt="">
                            </div>

                            <!-- hidden old image  -->
                            <input type="hidden" v-model="brand.oldImg">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-center text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ formCreate ? 'create Brand ' : 'update Brand' }}
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
            brands:[],
            brandsCount:'',
            length:5,
            allBrand: [],
            brandsLength:'',
            btnMessage:"load more",
            
            // form data 

            brand:{
                name:'',
                brand_img:'',
            }, 
            errors:{},
            formCreate:true,

            notification:{
                type:'',
                message:"",
                deleteId:'',
            }
        }
    },
    methods: {
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.brand = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.brands = this.allBrand.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
                
        },
        createImage(file) {
            
            let reader = new FileReader();
            reader.onload = (e) => {
                this.brand.brand_img =  e.target.result;
            };
            reader.readAsDataURL(file);
        },
        createBrand(){
            axios.post('/admin/brand',
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                'name':this.brand.name,
                'brand_img' : this.brand.brand_img,
            })

            .then(response => {
                
                this.notification.type = 'success',
                this.notification.message = 'Brand has been Created SuccessFully';
                this.reloadBrand();
                this.modal = !this.modal;
            
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(brand){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.brand = {
                id: brand.id,
                name:brand.name,
                oldImg:brand.brand_img,
            };
        },
        updateBrand(){
            axios.put('/admin/brand/update/' + this.brand.id,{
                'name':this.brand.name,
                'brand_img' : this.brand.brand_img,
                'oldImg' : this.brand.oldImg,
            })
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'Brand has been updated SuccessFully';
                this.reloadBrand();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadBrand(){
            axios.get('/admin/brand')
            .then(res =>{
                this.notification.deleteId = null;
                this.notification.type = 'success';
                this.notification.message = 'The Brand has been deleted successsfully';
                this.allBrand = res.data[0];
                this.brands = res.data[0].slice(0, this.length);
                this.brandsCount = res.data[1];
                this.brandsLength = res.data[0].length;
            })
        },
        deleteBrand(id,name){
            this.notification.type ='force';
            this.notification.message = `Do you want to delete ${name} brad  ?`;
            this.notification.deleteId = id;
            this.brands = this.brands.filter(brand => brand.id !== id);
        },
        forceDelete(id){
            axios.delete('/admin/brand/' + id)
            .then(res=>{
                this.reloadBrand();
            })
        }
                
    },
    created(){
        axios.get('/admin/brand')
        .then(res =>{
            this.allBrand = res.data[0];
            this.brands = res.data[0].slice(0, this.length);
            this.brandsCount = res.data[1];
            this.brandsLength = res.data[0].length;
        })
    }
}
</script>