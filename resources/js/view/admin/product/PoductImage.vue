<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="flex justify-between my-4">
            <div class="flex">
                <button @click="createModal" class="mx-4 text-indigo border-2 border-indigo-800 px-4 py-1 capitalize font-semibold 
                    transition duration-300 hover:text-white hover:bg-indigo-800">
                    create New 
                </button>
            </div>
            <Headers/>
        </div>
        <div class="my-10 serceh-box flex justify-between items-center">
            <h2 class="text-gray-600 text-lg capitalize ml-3"> {{ allProductImagesCount }}</h2>
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
                    <tr v-for="image in showProductImages" :key="image" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="flex items-center">
                                {{ image.product_img_name }}
                                <img :src="image.product_img" :alt="image.product_img_name" class="
                                    w-10 h-10 rounded-full mx-4"> 
                            </div>
                            
                            
                        </th>
                        <td class="py-2 px-6">
                            {{ image.products.length }}
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
                {{ allProductImagesCount }}
            </div>
            <div v-if="showImagelength <= allProductImageslength" class="flex justify-center my-4">
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
                    <form @submit.prevent="formCreate ? createProductImage():updateProductImage()" enctype="multipart/form-data">
                        <div class="flex flex-col">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Product Image Name </label>
                            <input type="text" placeholder="Image Name like char,tabel"
                            :class="{'border-1 border-red-500':errors.product_img_name}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300" v-model="productImage.product_img_name">

                            <p v-if="errors.product_img_name" class="text-red-500"> {{ errors.product_img_name[0] }} </p>
                        </div>
                        <div class="flex flex-col">
                            <label for="image" class="my-2 mx-4 text-gray-500 font-semibold"> productImage Image </label>
                            <div class="flex justify-between items-center">
                                <input type="file" placeholder="productImage Image"
                                    class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" 
                                    :class="{'border-1 border-red-500':errors.product_img}"
                                    @change="onFileChange">

                                <img class="ml-2 w-14 h-14 rounded-full" :src="productImage.product_img ? productImage.product_img : productImage.oldImg" alt="">

                            </div>
                            <p v-if="errors.product_img" class="text-red-500"> {{ errors.product_img[0] }} </p>

                            <!-- hidden old image  -->
                            <input type="hidden" v-model="productImage.oldImg">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-center text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ formCreate ? 'create productImage ' : 'update productImage' }}
                            </button>
                        </div>
                    </form>
                </div>
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
            showProductImages:[],
            showImagelength: 10,
            allProductImages:[],
            allProductImagesCount:'',
            allProductImageslength:[],

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
        search(e){
            let serachText = e.target.value.toLowerCase();
            this.showProductImages = this.allProductImages.filter(
                image => image.product_img_name.toLowerCase().includes(serachText)
            );
            let count  = this.showProductImages.length;
            this.allProductImagesCount = count > 1 ? count + " prodduct images" :count + ' product image';
        },
        loadMore(){
            this.showImagelength += 10;
            this.showProductImages = this.allProductImages.slice(0,this.showImagelength);
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
                this.productImage.product_img = e.target.result;
            },
            reader.readAsDataURL(file);
        },
        createModal(){
            this.productImage= {};
            this.errors={};
            this.modal = !this.modal;
            this.formCreate = true;
            
        },
        editModal(productImage){
            this.productImage.product_img_name = productImage.product_img_name;
            this.productImage.id = productImage.id;
            this.modal = true;
            this.formCreate = false;
            this.productImage.oldImg = productImage.product_img;
        },
        createProductImage(){
            axios.post('/admin/product/image/create',this.productImage)
            .then(res =>{
                this.notification.type = 'success';
                this.notification.message = "Product Image has been Created successfully !";
                this.modal = false;
                this.reloadProductImage();
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        updateProductImage(){
            axios.put('/admin/product/image/update/' + this.productImage.id,{
                'product_img_name': this.productImage.product_img_name,
                'product_img' : this.productImage.product_img,
                'oldImg' : this.productImage.oldImg,
            })
            .then(res =>{
                this.notification.type='edit';
                this.notification.message = 'The product image has beed update !';
                this.modal = false;
                this.reloadProductImage();
            })

        },
        imageDelete(id){
            axios.delete('/admin/product/image/' + id)
            .then(res=>{
                this.notification = {};
                this.notification.type = 'delete';
                this.notification.message = "The Product image has been deleted Successfully";
                this.notification.deleteId = id;
                this.showProductImages = this.showProductImages.filter(image => image.id !==id)
            })
        },
        restore(id){
            axios.post('/admin/product/image/restore/' + id)
            .then(res =>{
                this.notification={};
                this.notification.message = "The product Image has been Restore Successfully";
                this.notification.type = "success";
                this.reloadProductImage();
            })
        },
        reloadProductImage(){
            axios.get('/admin/product/image')
            .then(res =>{
                this.allProductImages = res.data['allImages'];
                this.allProductImagesCount = res.data['imageCount'];
                this.showProductImages = this.allProductImages.slice(0,this.showImagelength);
                this.allProductImageslength = this.allProductImages.length;
            })
        }
    },
    created(){
        axios.get('/admin/product/image')
        .then(res =>{
            this.allProductImages = res.data['allImages'];
            this.allProductImagesCount = res.data['imageCount'];
            this.showProductImages = this.allProductImages.slice(0,this.showImagelength);
            this.allProductImageslength = this.allProductImages.length;
        })
    },
}
</script>