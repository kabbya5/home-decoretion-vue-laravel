<template>
    <div class="flex flex-wrap flex-row"> 
        <Notification :notification="notification" v-if="notification.message" />                                             
        <div class="flex-shrink max-w-full px-4 w-full mb-6">
          	<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-row justify-between items-center pb-2">
                    <button @click="createModal" class="px-4 py-2 uppercase text-indigo-800 border-2 border-indigo-800
                        transition duration-300 hover:bg-indigo-800 hover:text-white"> create new</button>
                </div>


                <div class="overflow-hidden mt-10 relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                                   Category Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                   Category Short Description
                                </th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cat in categories" :key="cat.id" class="border-b border-gray-200 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    {{ cat.categoryName.substring(0,40) + '....' }}
                                </th>

                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    {{ cat.categoryText.substring(0,40) + '....'  }}
                                </th>
                                
                                
                                <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                                    <button @click="editModal(cat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
	
			</div>
		</div>

        <!-- form modal  -->
        <div v-if="modal" class="fixed top-0 left-0 bg-gray-400/60 z-10 py-4 px-4 w-screen h-screen">
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
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe Category Name </label>
                            <textarea cols="30" rows="10" v-model="category.categoryText"
                            :class="{'border-1 border-red-500':errors.categoryText}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300">
                            </textarea>
                            <p v-if="errors.categoryText" class="text-red-500"> {{ errors.categoryText[0] }} </p>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300  text-blue-800 border-2 border-blue-800
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
import Notification from '../../NotificationAdmin.vue';
    export default{
        components:{
            Notification,
        },
        data(){
            return {
                categories:[],
                categoriesCount:'',
                modal:false,

                errors:{},
                category:{
                    oldImg:'',
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
                this.category = {};
            },
            
            editModal: function(category){
                this.category = {};
                this.errors = {};
                this.createForm = false;
                this.modal = !this.modal;
                this.category.categoryText = category.categoryText;
                this.category.categoryName = category.categoryName;
                this.category.id = category.slug;
            },
            createCategory: function(){
                axios.post('/admin/developmnet/page/category/store',this.category)
                .then(res =>{
                    this.reloadPage();
                    this.modal = !this.modal;
                    this.notification.type = 'success';
                    this.notification.message = 'SuccessFully created development category!';
                })
                .catch(errors =>{
                    this.errors = errors.response.data.errors
                });
            },
            updateCategory(){
                axios.put('/admin/development/page/category/update/' + this.category.id,{
                    categoryName : this.category.categoryName,
                    categoryText : this.category.categoryText
                }).then( res =>{
                    this.modal = !this.modal;
                    this.notification.type='edit';
                    this.notification.message = 'The category has been updated Successfully !';
                    this.reloadPage();
                }).catch(errors =>{
                    this.errors = errors.response.data.errors;
                })
            },
            
           
            reloadPage(){
                axios.get('/admin/development/page/category/index')
                .then(res =>{
                    this.categories = res.data;
                })
            }
        },
        mounted(){
            axios.get('/admin/development/page/category/index')
            .then(res =>{
                this.categories = res.data;
            })
        },
       
    }
</script>