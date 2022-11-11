<template>
    <div class="max-w-full px-4 w-full my-6">
        <Notification :restoreCatgory="restoreCatgoryParent" :notification="notification" v-if="notification.message" /> 
        <div class="p-6 bg-white rounded-lg h-full my-4">
            <HeaderSubcat  />
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Sub category Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Category Name 
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="trashed in subcategories" :key="trashed.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ trashed.subCatName }}
                        </th>
                        <td class="py-4 px-6">
                            {{ trashed.category.categoryName }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="restoreCatgory(trashed.id)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-solid fa-rotate-right"></i>
                            </button> 
                            <button @click="delete(trashed.id)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-solid fa-trash"></i>
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

</template>
<script>
import Notification from '../../../components/Notification.vue';
import HeaderSubcat from './HeaderSubcat.vue';
    export default{
        components:{HeaderSubcat,Notification},
        data(){
            return {
                subcategories:[],
                subcategoriesCount:'',
                length:5,
                allSubcategory: [],
                subcategoriesLength:'',
                btnMessage:"load more",

                notification:{
                    type:'force',
                    message:"Do you wated deleted it permamently ? cancle now",
                    deleteId:'2',
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
            restoreCatgory(id){
                axios.delete('/api/admin/subcategory/restore/' + id)
                .then(res=>{
                    this.notification.type ='success';
                    this.notification.message = 'The category has been  Restored!';
                    this.subcategories= this.subcategories.filter(subcat => subcat.id !== id);
                })
            },
            // delete(id){
            //     axios.delete('/api/admin/subcategory/restore/' + id)
            //     .then(res=>{
            //         this.notification.type ='forceDelete';
            //         this.notification.message = 'Do you wated deleted it permamently ? cancle now';
            //         this.subcategories= this.subcategories.filter(subcat => subcat.id !== id);
            //     })
            // }
        },
        mounted(){
            axios.get('/api/admin/subcategory/trashed')
            .then(res =>{
                this.allSubcategory = res.data[0];
                this.subcategories = res.data[0].slice(0, this.length);
                this.subcategoriesCount = res.data[1];
                this.subcategoriesLength = res.data[0].length;
            })
        },
    }
</script>