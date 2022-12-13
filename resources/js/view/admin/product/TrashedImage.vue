<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="flex justify-between my-4">
            <Headers/>
        </div>
        <div class="my-10 serceh-box flex justify-between items-center">
            <h2 class="text-gray-600 text-lg capitalize ml-3"> {{ allTrashedImagesCount }}</h2>
            <div class="flex px-4">
                <input type="search" placeholder="Search heare..." 
                class="px-2 h-10 border-2 border-gray-200 w-full md:w-96 focus:outline-none">
                <i class="fa-solid fa-magnifying-glass text-2xl -ml-8 mt-1 text-gray-600"></i>
            </div>
        </div>

        <!-- Data Tabel  -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            image Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            products
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            created At
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="image in showTrashedImages" :key="image" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="flex items-center">
                                {{ image.product_img_name }}
                                <img :src="image.product_img" :alt="image.product_img_name" class="
                                    w-10 h-10 rounded-full mx-4"> 
                            </div>
                            
                            
                        </th>
                        <td class="py-2 px-6">
                            Sliver
                        </td>
                        <td class="py-2 px-6 bg-gray-50 dark:bg-gray-800">
                            {{ image.date }}
                        </td>
                        <td class="py-2 px-6">
                            <button @click="restore(image.id)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-solid fa-rotate-left"></i> 
                            </button> 
                            <button @click="imageForceDelete(image.id,image.product_img_name)" class="py-1 px-2 bg-red-700 text-white">  
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
                {{ allTrashedImagesCount }}
            </div>
            <div v-if="shwoTrashedImagelength <= allTrashedImageslength" class="flex justify-center my-4">
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
import Headers from './_Headers.vue';
import Notification from '../NotificationAdmin.vue';
export default{
    components:{Headers,Notification },
    data(){
        return {
            showTrashedImages:[],
            shwoTrashedImagelength: 10,
            allTrashedImages:[],
            allTrashedImagesCount:'',
            allTrashedImageslength:[],

            loadMoreButtonText : 'load more',

            // create update modal 

            modal:false,
            productImage:{},
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
            this.shwoTrashedImagelength += 10;
            this.showTrashedImages = this.allTrashedImages.slice(0,this.shwoTrashedImagelength);
        },
        
        imageForceDelete(id,name){
            this.notification = {};
            this.notification.type = 'force';
            this.notification.message = `Do you want to delete this ${name} images ?`;
            this.notification.deleteId = id;
            this.showTrashedImages = this.allTrashedImages.filter(image=> image.id !== id);

        },
        restore(id){
            axios.post('/api/admin/product/image/restore/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The product Image has been Restore Successfully";
                this.notification.type = "success";
                this.showTrashedImages = this.allTrashedImages.filter(image=> image.id !== id)
            })
        },
        forceDelete(id){
            axios.delete('/api/admin/product/image/force/delete/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The product Image has been  Successfully";
                this.notification.type = "success";
                this.reloadPage();
            })
        },
        reloadPage(){
            axios.get('/api/admin/product/image/trashed')
            .then(res =>{
                this.allTrashedImages = res.data[0];
                this.allTrashedImagesCount = res.data[1];
                this.showTrashedImages = this.allTrashedImages.slice(0,this.shwoTrashedImagelength);
                this.allTrashedImageslength = this.allTrashedImages.length;
            })
        }
    },
    created(){
        axios.get('/api/admin/product/image/trashed')
        .then(res =>{
            console.log(res.data);
            this.allTrashedImages = res.data[0];
            this.allTrashedImagesCount = res.data[1];
            this.showTrashedImages = this.allTrashedImages.slice(0,this.shwoTrashedImagelength);
            this.allTrashedImageslength = this.allTrashedImages.length;
        })
    },
}
</script>