<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="my-10 serceh-box flex justify-between items-center">
            <router-link to="/admin/category/trashed/index" class="px-4 py-1 uppercase text-red-800 border-2 border-red-800
                transition duration-300 hover:bg-red-800hover:text-white"> 
                Trashed Category
            </router-link>
            <router-link to="/admin/category/index" class="px-4 py-1 uppercase text-blue-800 border-2 border-blue-800
                transition duration-300 hover:bg-blue-800 hover:text-white"> 
                ALL Category
            </router-link>
        </div>

        <!-- Data Tabel  -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            cat Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            categorys
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cat in showTrashedCategories" :key="cat" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="flex items-center">
                                {{ cat.categoryName }}
                                <img :src="cat.categoryImg" :alt="cat.categoryImgName" class="
                                    w-10 h-10 rounded-full mx-4"> 
                            </div>    
                        </th>
                        <td class="py-2 px-6">
                            Sliver
                        </td>
                        <td class="py-2 px-6">
                            <button @click="restore(cat.id)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-solid fa-rotate-left"></i> 
                            </button> 
                            <button @click="catForceDelete(cat.id,cat.categoryImg_name)" class="py-1 px-2 bg-red-700 text-white">  
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more load button  -->
        <div @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allTrashCategoryCount }}
            </div>
            <div v-if="shwoTrashedcatlength <= allTrashCategorylength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ loadMoreButtonText }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

    </div>
</template>
<script>
import Notification from '../NotificationAdmi.vue';
export default{
    components:{Headers,Notification },
    data(){
        return {
            showTrashedCategories:[],
            shwoTrashedcatlength: 10,
            allTrashCategory:[],
            allTrashCategoryCount:'',
            allTrashCategorylength:[],

            loadMoreButtonText : 'load more',

            // create update modal 

            modal:false,
            categorycat:{},
            errors:{},
            formCreate:true,

            // notificatio 
            notification:{
                type:'',
                message:"",
                deleteId:'',
            }
        }
    },
    methods:{
        loadMore(){
            this.shwoTrashedcatlength += 10;
            this.showTrashedCategories = this.allTrashCategory.slice(0,this.shwoTrashedcatlength);
        },
        
        catForceDelete(id,name){
            this.notification = {};
            this.notification.type = 'force';
            this.notification.message = `Do you want to delete this ${name} cats ?`;
            this.notification.deleteId = id;
            this.showTrashedCategories = this.allTrashCategory.filter(cat=> cat.id !== id);

        },
        restore(id){
            axios.post('/api/admin/category/restore/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The category has been Restore Successfully";
                this.notification.type = "success";
                this.reloadPage();
            })
        },
        forceDelete(id){
            axios.delete('/api/admin/category/force/delete/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The category delete has been  Successfully";
                this.notification.type = "success";
                this.reloadPage();
            })
        },
        reloadPage(){
            axios.get('/api/admin/category/trashed')
            .then(res =>{
                this.allTrashCategory = res.data[0];
                this.allTrashCategoryCount = res.data[1];
                this.showTrashedCategories = this.allTrashCategory.slice(0,this.shwoTrashedcatlength);
                this.allTrashCategorylength = this.allTrashCategory.length;
            })
        }
    },
    created(){
        axios.get('/api/admin/category/trashed')
        .then(res =>{
            console.log(res.data);
            this.allTrashCategory = res.data[0];
            this.allTrashCategoryCount = res.data[1];
            this.showTrashedCategories = this.allTrashCategory.slice(0,this.shwoTrashedcatlength);
            this.allTrashCategorylength = this.allTrashCategory.length;
        })
    },
}
</script>