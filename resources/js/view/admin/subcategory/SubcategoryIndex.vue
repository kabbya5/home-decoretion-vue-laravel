<template>
    <div class="flex flex-wrap flex-row"> 
        <Notification :restoreCatgory="restoreCatgoryParent" :notification="notification" v-if="notification.message" /> 

        <div class="max-w-full px-4 w-full my-6">
          	<div class="p-6 bg-white rounded-lg shadow-lg h-full my-4">
                <div class="flex flex-row justify-between items-center pb-2">
                    
                    <HeaderSubcat  />
                    <button @click="modalCreate" class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                        transition duration-300 hover:bg-indigo-800 hover:text-white">
                         create new
                    </button>
                </div>
          		<div class="overflow-x-auto my-10">
	                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        
                        <!-- table -->
                        <div class="dataTable-container my-6">
                            <table class="table-sorter table-bordered-bottom w-full text-gray-500">
                                <thead>
                                    <tr class="bg-gray-200/60">
                                        <th class="py-1 text-left md:px-4 my-2" style="width: 14.6262%;">
                                            subcategory Name
                                        </th>
                                        <th class="py-1 text-left md:px-4 my-2" style="width: 16.6262%;">
                                            Category Name 
                                        </th>
                                        <th class="py-1 text-left md:px-4" style="width: 14.6262%;">
                                            Created At
                                        </th>
                                        <th class="py-1 text-left md:px-4" style="width: 5.6262%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm" style="margin:20px 0">
                                    <tr v-for="subcategory in subcategories" :key="subcategory.id">
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            {{ subcategory.subCatName}} 
                                        </td>                                        
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            {{ subcategory.category.categoryName }}
                                        </td>
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            {{ subcategory.date }}
                                        </td>
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            <button @click="editModal(subcategory)">
                                                <i class="fa-regular fa-pen-to-square"></i> 
                                            </button> 
                                            <button @click="subCatDel(subcategory.id)" class="text-red-800 ml-2 font-bold"> 
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
                                {{ subcategoriesCount }}
                            </div>
                            <div v-if="length <= subcategoriesLength" class="flex justify-center my-4">
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

        <!-- Edit update modal  -->

        <div v-if="modal" class="fixed modal top-0 w-full h-screen bg-gray-200/60">
            <div class="flex justify-center items-center">
                <div class="w-96 -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>
                        
                    </button>
                    
                    <form @submit.prevent="formCreate ? createSubCat() : updateSubCat()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="subCatName" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Sub Category name</label>
                            <input type="text" placeholder="Sub Category Name"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.subCatName}"
                            v-model="subcat.subCatName">

                            <p v-if="errors.subCatName" class="text-red-500">{{ errors.subCatName[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="text-gray-500 capitalize my-2 px-4 text-lg"> 
                                Selected Category: <span class="px-2 text-gray-500 font-bold"> {{ selectItem }}  </span>
                            </div>
                            <select @change="handleChange" v-model="subcat.category_id" class="py-2 border-2 border-gray-200 text-gray-500 focus:outline-none"
                             :class="{'border-1 border-red-500':errors.category_id}">
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id" :data-foo="cat.categoryName"
                                >
                                    {{ cat.categoryName }}
                                </option>
                            
                            </select>

                            <p v-if="errors.category_id" class="text-red-500">{{ errors.category_id[0] }}</p>
                            
                        </div>

                        <button type="submit" class="capitalize py-2 my-4 px-4 bg-indigo-800 text-white rounded-md transition duratuion-300 hover:bg-indigo-600">
                             {{ formCreate ? 'create sub category' :'update sub category'}} 
                        </button>
                    </form>
                </div>
            </div>
        </div>
	</div>
</template>
<script>
    import HeaderSubcat from './HeaderSubcat.vue';
    import Notification from '../../../components/Notification.vue';
    export default{
        components:{Notification,HeaderSubcat},
        data(){
            return {
                modal:false,
                subcategories:[],
                subcategoriesCount:'',
                length:5,
                allSubcategory: [],
                subcategoriesLength:'',
                btnMessage:"load more",

                //subcategory form

                categories:[],
                subcat:{
                    subCatName:'',
                    category_id:'',
                },
                errors:[],
                selectItem:'',
                formCreate:true,
                updateSubcatid:'',

                // notification

                notification:{
                    type:'',
                    message:"",
                    deleteId:'',
                }
                

            }
        },

        methods:{
            loadMore:function(){
                this.btnMessage = 'looding...'
                this.length += 5;
                this.subcategories = this.allSubcategory.slice(0, this.length);
                this.btnMessage = 'load more'
            },
            modalCreate(){
                this.subcat = {},
                this.formCreate = true;
                this.modal = !this.modal;
            },
            createSubCat(){
                axios.post('/api/admin/subcategory',this.subcat)
                .then(res =>{
                    this.notification.type = 'success';
                    this.notification.message = 'The Category has been Created  SuccessFully   !';
                    this.modal = ! this.modal;
                    this.reloadPage();
                })
                .catch(errors =>{
                    this.errors = errors.response.data.errors;
                })
                
            },
            editModal(data){
                this.subcat.subCatName = data.subCatName;
                this.subcat.category_id = data.category_id;
                this.formCreate = ! this.formCreate;
                this.updateSubcatid = data.id;
                this.errors = '';
                this.modal = !this.modal;
            },
            updateSubCat(){
                // fetch(`api/admin/subcategory/${this.updateSubcatid}`, {
                //     method: 'PUT',
                //     headers: {
                //         'Content-Type': 'application/json'
                //     },
                //     body: JSON.stringify({
                        
                //     })
                // })

                axios.put('/api/admin/subcatgory/update/'+this.updateSubcatid,{
                    subCatName:this.subcat.subCatName,
                    category_id :this.subcat.category_id,
                })
                .then(res =>{
                    this.notification.type ='edit';
                    this.notification.message = 'The category has been updeted successfully';
                    this.modal = !this.modal;
                    this.reloadPage();

                })
                .catch(errors =>{
                    this.errors = errors.response.data.errors;
                })
            },
            subCatDel(id){
                axios.delete('/api/admin/subcategory/' + id)
                .then(res=>{
                    this.notification.type ='delete';
                    this.notification.message = 'The category has been deleted!  Restore Now ?';
                    this.notification.deleteId = id;
                    this.subcategories= this.subcategories.filter(subcat => subcat.id !== id);
                    this.restoreNotification();
                })
            },
            restoreCatgoryParent(){
                axios.get('/api/admin/subcategory')
                .then(res =>{
                    this.allSubcategory = res.data[0];
                    this.subcategories = res.data[0].slice(0, this.length);
                    this.subcategoriesCount = res.data[1];
                    this.subcategoriesLength = res.data[0].length;
                    this.restoreNotification();
                })
            },
            restoreNotification(){
                setTimeout(() => this.notification = {}, 10000)
            },
            reloadPage(){
                axios.get('/api/admin/subcategory')
                .then(res =>{
                    this.allSubcategory = res.data[0];
                    this.subcategories = res.data[0].slice(0, this.length);
                    this.subcategoriesCount = res.data[1];
                    this.subcategoriesLength = res.data[0].length;
                    this.restoreNotification();
                })
            }

        },
        mounted(){
            axios.get('/api/admin/subcategory')
            .then(res =>{
                this.allSubcategory = res.data[0];
                this.subcategories = res.data[0].slice(0, this.length);
                this.subcategoriesCount = res.data[1];
                this.subcategoriesLength = res.data[0].length;
            }),
            axios.get('/api/admin/category')
            .then(res=>{
                this.categories = res.data[0];
            })
        },
    }
</script>
