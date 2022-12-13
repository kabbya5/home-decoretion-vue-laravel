<template>
    <div class="flex flex-wrap flex-row"> 
        <Notification :notification="notification" v-if="notification.message" />                                             
        <div class="flex-shrink max-w-full px-4 w-full mb-6">
          	<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-row justify-between items-center pb-2">
                    <div class="flex">
                        <router-link to="/admin/category/trashed/index" class="px-4 py-1 uppercase text-red-800 border-2 border-red-800
                        transition duration-300 hover:bg-red-800hover:text-white"> 
                        Trashed Category
                        </router-link>
                    </div>
                    <button @click="createModal" class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                        transition duration-300 hover:bg-indigo-800 hover:text-white"> create new</button>
                </div>
          		<div class="overflow-x-auto my-10">
	                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <!-- table -->

                        <div class="dataTable-container">
                            <table class="table-sorter table-bordered-bottom w-full text-gray-500 dark:text-gray-400 dataTable-table">
                                <thead>
                                    <tr class="bg-gray-200 dark:bg-gray-900 dark:bg-opacity-40">
                                        <th class="py-1 text-center" style="width: 14.6262%;">
                                            Category Name
                                        </th>
                                        <th class="py-1" style="width: 14.6262%;">
                                            Image
                                        </th>
                                        <th class="py-1" style="width: 14.6262%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr v-for="cat in categories" :key="cat.id">
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            {{ cat.categoryName}} 
                                        </td>
                                        <td class="text-center text-lg py-2 text-text-gray-500">
                                            <div class="flex justify-center">
                                                <img class="w-14 h-14 rounded-full" :src="cat.categoryImg" alt="cat.catgoryImgName">
                                            </div>
                                        </td>
                                        <td class="text-center text-lg py-2 text-text-gray-500">
                                            <button @click="editModal(cat)" class="bg-green-500 px-2 py-1">
                                                <i class="fa-regular fa-pen-to-square text-gray-500"></i> 
                                            </button> 
                                            <button @click="deleteCat(cat.id)" class="text-gray-600 ml-2 font-bold bg-red-600 px-2 py-1"> 
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
                                {{ categoriesCount }}
                            </div>
                            <div v-if="length <= categoriesLength" class="flex justify-center my-4">
                                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                                transition duration-300 hover:bg-indigo-600">
                                    {{ btnMessage }}
                                    <i class="fa-solid fa-repeat ml-1"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
	            </div>
			</div>
		</div>

        <!-- form modal  -->
        <div v-if="modal" class="fixed top-0 bg-gray-400/60 z-10 py-4 px-4 w-screen h-screen">
            <div class="flex justify-center items-center">
                <div class="w-96 bg-white px-4">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>
                        
                    </button>
                    <form @submit.prevent="createForm ? createCategory(): updateCategory()" class="w-full" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe Category Name </label>
                            <input type="text" placeholder="Category Name"
                            :class="{'border-1 border-red-500':errors.categoryName}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300" v-model="category.categoryName">

                            <p v-if="errors.categoryName" class="text-red-500"> {{ errors.categoryName[0] }} </p>
                        </div>
                        <div class="flex flex-col">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Category Image </label>

                            <div class="flex justify-between items-center">
                                <input type="file" placeholder="Category Image"
                                    :class="{'border-1 border-red-500':errors.categoryImg}"
                                    class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" 
                                    @change="onFileChange">

                                <img class="ml-2 w-14 h-14 rounded-full" :src="category.categoryImg?category.categoryImg:category.oldImg" alt="">
                            </div>
                            <p v-if="errors.categoryImg" class="text-red-500"> {{ errors.categoryImg[0] }} </p>

                            <!-- hidden old image  -->
                            <input type="hidden" v-model="category.oldImg">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-center text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ createForm ? 'create Category': 'update Category'}}
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
        components:{
            Notification,
        },
        data(){
            return {
                categories:[],
                categoriesCount:'',
                modal:false,
                length:5,
                allCategory: [],
                categoriesLength:'',
                btnMessage:"load more",
                errors:{},
                category:{
                },
                createForm : true,
                //create update notification
                notification:{
                    type:'',
                    message:""
                }
            }
        },

        methods:{
            createModal(){
                this.modal = !this.modal;
                this.createForm = true;
            },
            onFileChange(e  ) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.category.categoryImg = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            loadMore:function(){
                this.btnMessage = 'looding...'
                this.length = this.length + 5;
                this.categories = this.allCategor.slice(0, this.length);
                this.btnMessage = 'load more'
            },
            editModal: function(category){
                this.createForm = false;
                this.modal = !this.modal;
                this.category.categoryName = category.categoryName;
                this.category.oldImg = category.categoryImg;
                this.category.id = category.id;
            },
            createCategory: function(){
                axios.post('/api/admin/category',{
                    categoryName: this.category.categoryName,
                    categoryImg :this.category.categoryImg, 
                })
                .then(res =>{
                    this.modal = !this.modal;
                    this.notification.type = 'success';
                    this.notification.message = 'SuccessFully create';
                })
                .catch(errors =>{
                    this.errors = errors.response.data.errors
                });
            },
            updateCategory(){
                axios.put('/api/admin/category/update/' + this.category.id,{
                    categoryName : this.category.categoryName,
                    categoryImg : this.category.categoryImg,
                }).then( res =>{
                    this.modal = !this.modal;
                    this.notification.type='edit';
                    this.notification.message = 'The category has been updated Successfully !';
                    this.reloadPage();
                }).catch(errors =>{
                    this.errors = errors.response.data.errors;
                })
            },
            deleteCat(id){
                axios.delete('/api/admin/category/delete/'+id)
                .then(res=>{
                    this.notification.type='delete';
                    this.notification.message="The category has been deleted successfull Restore Now ?";
                    this.notification.deleteId = id;
                });
            },
            restore(id){
                axios.post('/api/admin/category/restore/' + id)
                .then(res =>{
                    this.reloadPage();
                    this.notification.message = "The product Image has been Restore Successfully";
                    this.notification.type = "success";
                    
                })
            },
            reloadPage(){
                axios.get('/api/admin/category')
                .then(res =>{
                    this.allCategor = res.data[0];
                    this.categories = res.data[0].slice(0, this.length);
                    this.categoriesCount = res.data[1];
                    this.categoriesLength = res.data[0].length;
                });
            }
        },
        mounted(){
            axios.get('/api/admin/category')
            .then(res =>{
                this.allCategor = res.data[0];
                this.categories = res.data[0].slice(0, this.length);
                this.categoriesCount = res.data[1];
                this.categoriesLength = res.data[0].length;
            })
        },
       
    }
</script>