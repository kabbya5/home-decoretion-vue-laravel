<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="flex justify-between my-12">
            <div class="flex">
                <button @click="createModal" class="mx-4 text-indigo border-2 border-indigo-800 px-4 py-1 capitalize font-semibold 
                    transition duration-300 hover:text-white hover:bg-indigo-800">
                    create New 
                </button>
            </div>
        </div>
        <div class="my-10 serceh-box flex justify-between items-center">
            <h2 class="text-gray-600 text-lg capitalize ml-3"> {{ allPageImagesCount }}</h2>
            <div class="flex px-4">
                <input type="search" placeholder="Search heare..."  @keyup="search"
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
                            Pages
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
                    <tr v-for="image in showPageImages" :key="image" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="flex items-center capitalize">
                                {{ image.page_image_name }}
                                
                            </div>    
                        </th>

                        <td class="py-2 px-6"> 
                            <img :src="image.page_image" :alt="image.page_image_name" class="
                                w-15 h-10 rounded-md mx-4"> 
                        </td>
                        
                        <td class="py-2 px-6 bg-gray-50 dark:bg-gray-800">
                            {{ image.date }}
                        </td>
                        <td class="py-2 px-6">
                            <button @click="editModal(image)" class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </button> 
                            <button @click="imageDelete(image.id)" class="py-1 px-2 bg-red-700 text-white">  
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
                {{ allPageImagesCount }}
            </div>
            <div v-if="showImagelength <= allPageImageslength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ loadMoreButtonText }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal  -->
        <div v-if="modal" class="fixed top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex items-center justify-center">
                <div class="my-10  w-[500px] px-4 py-8  bg-white">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ? createPageImage():updatePageImage()" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Page Image Name </label>
                            <input type="text" placeholder="Image Name like char,tabel"
                            :class="{'border-1 border-red-500':errors.page_image_name}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300" v-model="PageImage.page_image_name">

                            <p v-if="errors.page_image_name" class="text-red-500"> {{ errors.page_image_name[0] }} </p>
                        </div>
                        <div class="flex flex-col">
                            <label for="image" class="my-2 mx-4 text-gray-500 font-semibold"> Page Image </label>
                            <div class="flex justify-between items-center">
                                <input type="file" placeholder="PageImage Image"
                                    class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" 
                                    :class="{'border-1 border-red-500':errors.page_image}"
                                    @change="onFileChange">

                                <img class="ml-2 w-14 h-14 rounded-full" :src="PageImage.page_image ? PageImage.page_image : PageImage.oldImg" alt="">

                            </div>
                            <p v-if="errors.page_image" class="text-red-500"> {{ errors.page_image[0] }} </p>

                            <!-- hidden old image  -->
                            <input type="hidden" v-model="PageImage.oldImg">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ formCreate ? 'create PageImage ' : 'update PageImage' }}
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
    components:{Headers,Notification },
    data(){
        return {
            showPageImages:[],
            showImagelength: 10,
            allPageImages:[],
            allPageImagesCount:'',
            allPageImageslength:[],

            loadMoreButtonText : 'load more',

            // create update modal 

            modal:false,
            PageImage:{},
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
        search(e){
            let serachText = e.target.value.toLowerCase();
            this.showPageImages = this.allPageImages.filter(
                image => image.page_image_name.toLowerCase().includes(serachText)
            );
            let count  = this.showPageImages.length;
            this.allPageImagesCount = count > 1 ? count + " page images" :count + ' page image';
        },
        loadMore(){
            this.showImagelength += 10;
            this.showPageImages = this.allPageImages.slice(0,this.showImagelength);
        },
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if(!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file){
            let reader = new FileReader();
            reader.onload = (e) =>{
                this.PageImage.page_image = e.target.result;
            },
            reader.readAsDataURL(file);
        },
        createModal(){
            this.PageImage= {};
            this.errors={};
            this.modal = !this.modal;
            this.formCreate = true;
            
        },
        editModal(PageImage){
            this.PageImage.page_image_name = PageImage.page_image_name;
            this.PageImage.id = PageImage.id;
            this.modal = true;
            this.formCreate = false;
            this.PageImage.oldImg = PageImage.page_image;
        },
        createPageImage(){
            axios.post('/admin/development/page/image/create',this.PageImage)
            .then(res =>{
                this.notification.type = 'success';
                this.notification.message = "Page Image has been Created successfully !";
                this.modal = false;
                this.reloadPageImage();
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        updatePageImage(){
            axios.put('/admin/development/page/image/update/' + this.PageImage.id,{
                'page_image_name': this.PageImage.page_image_name,
                'page_image' : this.PageImage.page_image,
                'oldImg' : this.PageImage.oldImg,
            })
            .then(res =>{
                this.notification.type='edit';
                this.notification.message = 'The Page image has beed update !';
                this.modal = false;
                this.reloadPageImage();
            })

        },

        imageDelete(id){
            axios.delete('/admin/developmnet/page/image/delete/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The Page Image has been  Successfully";
                this.notification.type = "success";
                this.reloadPageImage();
            })
        },
        
        reloadPageImage(){
            axios.get('/admin/developmnet/page/image/index')
            .then(res =>{
                this.allPageImages = res.data['allImages'];
                this.allPageImagesCount = res.data['imageCount'];
                this.showPageImages = this.allPageImages.slice(0,this.showImagelength);
                this.allPageImageslength = this.allPageImages.length;
            })
        }
    },
    created(){
        axios.get('/admin/developmnet/page/image/index')
        .then(res =>{
            this.allPageImages = res.data['allImages'];
            this.allPageImagesCount = res.data['imageCount'];
            this.showPageImages = this.allPageImages.slice(0,this.showImagelength);
            this.allPageImageslength = this.allPageImages.length;
        })
    },
}
</script>