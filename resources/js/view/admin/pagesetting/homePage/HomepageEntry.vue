<template>
    <div class="w-full">
        <div class="my-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex">
                    <button class="font-semibold"> Home Page Intry </button>
                </div>
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Childcategory name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            category name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            sub category name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            products
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
                    
                    <tr v-for="childcat in showChildCategories" :key="childcat.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="flex items-center"> 
                                <img v-if="childcat.image" :src="childcat.image.img" alt="" class="mx-4 w-12 h-12">
                                {{childcat.childCatName }}
                            </div>
                            
                        </th>
                        <td  class="py-4 px-6">
                            {{ childcat.subcategory.category.categoryName }}
                        </td> 
                        <td class="py-4 px-6">
                            {{ childcat.subcategory.subCatName}}
                        </td>
                        <td class="py-4 px-6">
                            {{ childcat.products.length}}
                        </td>
                        <td class="py-4 px-6">
                            {{ childcat.created_date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(childcat)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deletechildcat(childcat.id,childcat.childCatName)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more button  -->

        <div v-if="allChildCategoriesLength > showChildCategoriesLength" @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allChildCategoriesLength - showChildCategoriesLength }} more childcategory
            </div>
            <div  class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed modal left-0 top-0 z-[50] w-full h-screen bg-gray-200/60">
            <div class="flex justify-center items-center">
                <div class="w-96 -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>
                        
                    </button>
                    
                    <form @submit.prevent="formCreate ? createChildCategory() : updateChildCategory()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="childcatName" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Child Category name</label>
                            <input type="text" placeholder="Sub Category Name"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.childCatName}"
                            v-model="childcat.childCatName">

                            <p v-if="errors.childCatName" class="text-red-500">{{ errors.childCatName[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="text-gray-500 capitalize my-2 px-4 text-lg"> 
                                Selected Childcategory: <span class="px-2 text-gray-500 font-bold"> {{ selectItem }}  </span>
                            </div>
                            <select @change="changeSubcatSelectInput" v-model="childcat.subcategory_id" class="py-2 border-2 border-gray-200 text-gray-500 focus:outline-none"
                             :class="{'border-1 border-red-500':errors.subcategory_id}">
                                <option v-for="subcat in subcategories" :key="subcat.id" :value="subcat.id" :data-name="subcat.subCatName"
                                >
                                    {{ subcat.subCatName }}
                                </option>
                            
                            </select>

                            <p v-if="errors.subcategory_id" class="text-red-500">{{ errors.subcategory_id[0] }}</p>      
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="tag_image" class="my-2 mx-4 text-gray-500 font-semibold"> Tag Image </label>
                            <Multiselect
                                v-model="childcat.image_id"
                                :options="optionImages"
                                mode="tags"
                                placeholder="Select Image"
                                track-by="name"
                                label="name"
                                :close-on-select="false"
                                :searchable="true"
                            >
                                <template v-slot:tag="{ option, handleTagRemove, disabled }">
                                    <div
                                        class="multiselect-tag is-user"
                                        :class="{
                                            'is-disabled': disabled
                                        }"
                                        >
                                        <img class="w-20 h-20 rounded-md" :src="option.image">
                                        {{ option.name }}
                                        <span
                                            v-if="!disabled"
                                            class="multiselect-tag-remove"
                                            @click="handleTagRemove(option, $event)"
                                        >
                                            <span class="multiselect-tag-remove-icon"></span>
                                        </span>
                                    </div>
                                </template>
                            </Multiselect>
                            <p v-if="errors.image_id" class="text-red-500">{{errors.image_id[0]}}</p>
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
import NotificationAdmin from '../../NotificationAdmin.vue';
import Multiselect from '@vueform/multiselect';
export default{
    components:{NotificationAdmin,Multiselect},
    data(){
        return{
            modal:false,
            showChildCategories:[],
            allChildCategories: [],
            allChildCategoriesLength:'',
            showChildCategoriesLength:10,
            btnMessage:"load more",
            
            // form data 
            subcategories:[],
            childcat:{},
            selectItem:'',
            errors:{},
            formCreate:true,

            optionImages:[],

            notification:{
                type:'',
                message:"",
                deleteId:'',
            }
        }
    },
    methods:{
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.childcat = {},
            this.selectItem = '';
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.showChildCategoriesLength += 7;
            this.showChildCategories = this.allChildCategories.slice(0, this.showChildCategoriesLength);
            this.btnMessage = 'load more'
        },
        changeSubcatSelectInput (event){
            this.selectItem = event.target.options[event.target.options.selectedIndex].getAttribute('data-name');
        },

        createChildCategory(){
            axios.post('/admin/childcategory',this.childcat)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'childCategory has been Created SuccessFully';
                this.reloadchildcat();
                this.modal = !this.modal;
            
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(childcat){
            console.log(childcat);
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.childcat = {
                id: childcat.id,
                childCatName:childcat.childCatName,
                subcategory_id:childcat.subcategory.id,
            };
            this.selectItem = childcat.subcategory.subCatName;
        },
        updateChildCategory(){
            axios.put('/admin/childcategory/update/' + this.childcat.id, this.childcat)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'childcategory has been updated SuccessFully';
                this.reloadchildcat();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadchildcat(){
            axios.get('/admin/childcategory')
            .then(res =>{
                this.allChildCategories = res.data;
                this.showChildCategories = res.data.slice(0, this.showChildCategoriesLength);
                this.allChildCategoriesLength = res.data.length;
            })
        },
        deletechildcat(id,name){
            this.notification.type ='';
            this.notification.message = `Do you want to delete ${name} childcatgory  ?`;
            this.notification.deleteId = id;
            this.showChildCategories = this.showChildCategories.filter(childcat => childcat.id !== id);
        },
        restoreCatgory(id){
            axios.delete('/admin/subcategory/restore/' + id)
            .then(res=>{
                this.notification.type ='success';
                this.notification.message = 'The category has been  Restored!';
                this.trasheds= this.trasheds.filter(trashed => trashed.id !== id);
            })
        },
        forceDelete(id){
            axios.delete('/admin/childcategory/' + id)
            .then(res=>{
                this.notification.message = 'childcategory has been deleted Successfully';
                this.notification.type = 'success';
                this.reloadchildcat();
            })
        }
                
    },
    created(){
        axios.get('/admin/childcategory')
        .then(res =>{
            this.allChildCategories = res.data;
            this.showChildCategories = res.data.slice(0, this.showChildCategoriesLength);
            this.allChildCategoriesLength = res.data.length;
        })
        axios.get('/admin/subcategory')
        .then(res =>{
            this.subcategories = res.data[0];
        })
        axios.get('/admin/product/image')
        .then(res =>{
            let images = res.data['allImages'];
            images.forEach(img =>{
                this.optionImages.push(
                    {
                        value:img.id,
                        name:img.product_img_name,
                        image:img.img,
                    }
                )
            })
        })
    }
}
</script>