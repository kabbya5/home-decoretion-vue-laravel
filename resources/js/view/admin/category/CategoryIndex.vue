<template>
    <div class="flex flex-wrap flex-row"> 
        <Notification :notification="notification" v-if="notification.message" />                                             
        <div class="flex-shrink max-w-full px-4 w-full mb-6">
          	<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-row justify-between items-center pb-2">
                    <div class="flex">
                        <h3 class="text-base text-slate-500 font-bold">Latest Orders</h3>
                    </div>
                    <button @click="modal=!modal" class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                        transition duration-300 hover:bg-indigo-800 hover:text-white"> create new</button>
                </div>
          		<div class="overflow-x-auto">
	                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="flex items-center my-4">
                            <div class="dataTable-dropdown">
                                <label class="text-gray-500">
                                    <select class="py-1 px-2 border-2 border-gray-200 focus:outline-none w-20">
                                        <option value="5">5</option>
                                        <option value="10" selected>
                                            10
                                        </option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">25</option>
                                    </select>
                                    entries per page
                                </label>
                            </div>
                            <div class="dataTable-search mx-4">
                                <input class="py-1 border-2 border-gray-200 px-4 focus:outline-none" placeholder="Search..." type="text">
                            </div>
                        </div>

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
                                            <button @click="editModal(cat)">
                                                <i class="fa-regular fa-pen-to-square"></i> 
                                            </button> 
                                            <button class="text-red-800 ml-2 font-bold"> 
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
                        <form @submit.prevent="createCategory" class="w-full" enctype="multipart/form-data">
                            <div>
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

                                        <img class="ml-2 w-14 h-14 rounded-full" :src="category.categoryImg" alt="">
                                    </div>
                                    <p v-if="errors.categoryImg" class="text-red-500"> {{ errors.categoryImg[0] }} </p>

                                    <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Category Image Name </label>
                                    <input type="text" placeholder="Category Name"
                                    :class="{'border-1 border-red-500':errors.categoryImgName}"
                                    class="my-2 px-4 py-2 border-2 focus:outline-none
                                        focus:border-gray-300" v-model="category.categoryImgName">

                                    <p v-if="errors.categoryImgName" class="text-red-500"> {{ errors.categoryImgName[0] }} </p>

                                    hidden old image 
                                <input type="hidden" v-model="category.oldImg">
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                        duration-300 text-center text-blue-800 border-2 border-blue-800
                                        hover:text-green-800 hover:border-green-800"> 
                                        {{ buttonText }}
                                    </button>
                                </div>
                            </div>
                        <!-- <CategoryForm :errors="errors" :category="category" :buttonText="buttonText" />  -->
                    </form>
                </div>
            </div>   
        </div>

	</div>
</template>
<script>
import CategoryForm from './_From.vue';
import Notification from '../../../components/Notification.vue';

    export default{
        components:{
            CategoryForm,
            Notification,
        },
        data(){
            return {
                categories:[],
                categoriesCount:'',
                modal:true,
                category:{
                    oldImg:null,
                    categoryImg:null
                },
                errors:{},
                buttonText:'create Category',
                length:5,
                allCategory: [],
                categoriesLength:'',
                btnMessage:"load more",

                //create update notification
                notification:{
                    type:'',
                    message:""
                }
            }
        },

        methods:{
            loadMore:function(){
                this.btnMessage = 'looding...'
                this.length = this.length + 5;
                this.categories = this.allCategor.slice(0, this.length);
                this.btnMessage = 'load more'
            },
            editModal: function(category){
                this.modal = !this.modal;
                this.category = category;
                this.category.oldImg = category.categoryImg;
            },
            onFileChange(e  ) {

            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
            this.category.categoryImg = files[0];
            },
            createImage(file) {
                
                let reader = new FileReader();
                reader.onload = (e) => {
                    //this.category.categoryImg = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            createCategory: function(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
               
                axios.post('/api/admin/category',this.category )
                .then(res =>{
                    console.log(res);
                    this.notification.type = 'success';
                    this.notification.message = 'SuccessFully create';
                })
                .catch(errors =>{
                    this.errors = errors.response.data.errors
                });
                
            },
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