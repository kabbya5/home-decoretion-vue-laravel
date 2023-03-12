<template>
    <div>
        <NotificationAdmin v-if="notification.message" :notification="notification" />
        <div class="header flex justify-end mt-10">
            <div class="flex mr-20">
                <button @click="modalCreate" data-name="project" class="px-6 py-2 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create projects </button>
                <button @click="modalCreate" data-name="apartment" class="px-6 py-2 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create Apartment Projects </button>
                <button @click="modalCreate" data-name="employee" class="px-6 py-2 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> Add employee </button>
            </div>
        </div>

        <!-- product Table  -->
        
        <div class="my-10 overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Product name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Category
                        </th>
                        <th scope="col" class="py-3 px-6">
                            price
                        </th>
                        <th scope="col" class="py-3 px-6">
                            quantity
                        </th>
                        <th v-if="(showProductsType=='all')" scope="col" class="py-3 px-6">
                            published_at
                        </th>
                        <th scope="col" class="py-3 px-6">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in showProducts" :key="product.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            <div class="flex items-center">
                                <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"
                                class="underline">
                                     {{ product.product_title }} 
                                </router-link>
                                <div class="flex mx-4">
                                    <img v-for="img in product.images" :key="img.id"  :src="img.img" :alt="img.product_img_name"
                                    class="w-12 h-10 rounded-full -ml-2 transition duration-300 hover:scale-[1.2]">
                                </div>
                            </div>   
                        </th>
                        <td class="py-4 px-6">
                            {{product.category.categoryName}}
                        </td>
                        <td class="py-4 px-6">
                           {{ product.discount_price ? product.discount_price : product.price }} TK
                        </td>
                        <td class="py-4 px-6">
                            {{ product.quantity }}
                        </td>
                        <td v-if="(showProductsType=='all')" class="py-4 px-6">
                            {{ product.published }}
                        </td>
                        <td v-if="(showProductsType=='all')" class="py-4 px-6">
                            <router-link :to="{name:'adminPoductEdit',params:{slug:product.slug}}"  class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </router-link> 
                            <button @click="deleteProdcut(product.id)" class="py-1 my-2 px-2 bg-red-700 text-white">  
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                        <td v-if="(showProductsType=='trashed')" class="py-4 px-6">
                            <button @click="trashRestore(product.id)" class="py-1 px-2 bg-indigo-700 text-white mr-4">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="modal" class="fixed z-50 top-0 left-0  w-full h-screen bg-gray-800/80 overflow-auto">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[700px] px-4 my-8  bg-white pb-4">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ?createcolor() : updatecolor()" enctype="multipart/form-data">

                        <div v-if="project_type=='employee'">
                            <div class="flex">
                                <div class="flex flex-col w-full mr-4">
                                    <label for="name" class="capitalize px-2 my-2 text-gray-600"> name </label>
                                    <input type="text" v-model="project.name" :class="{'border-red-500':errors.name}" 
                                    class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="employee name">
                                    <p v-if="errors.name" class="my-2 color-red-500"> {{ errors.name[0] }}</p>
                                </div>

                                <div class="flex flex-col w-full ml-4">
                                    <label for="designation" class="capitalize px-2 my-2 text-gray-600"> designation</label>
                                    <input type="text" v-model="project.designation" :class="{'border-red-500':errors.designation}" 
                                    class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Manager">
                                    <p v-if="errors.designation" class="my-2 color-red-500"> {{ errors.designation[0] }}</p>
                                </div>
                            </div>
                            
                            <div class="flex mt-2">
                                <div class="flex flex-col mr-4 w-full">
                                    <label for="phone" class="capitalize px-2 my-2 text-gray-600"> Empolyee phone </label>
                                    <input type="text" v-model="project.phone" :class="{'border-red-500':errors.phone}" 
                                    class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="01721579157">
                                    <p v-if="errors.phone" class="my-2 color-red-500"> {{ errors.phone[0] }}</p>
                                </div>

                                <div class="flex flex-col w-full ml-4">
                                    <label for="gmail" class="capitalize px-2 my-2 text-gray-600"> Email </label>
                                    <input type="text" v-model="project.gmail" :class="{'border-red-500':errors.gmail}" 
                                    class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="kabbya44@gmial.com">
                                    <p v-if="errors.gmail" class="my-2 color-red-500"> {{ errors.gmail[0] }}</p>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="flex flex-col">
                                <label for="title" class="capitalize px-2 my-2 text-gray-600"> Project Title </label>
                                <input type="text" v-model="project.title" :class="{'border-red-500':errors.title}" 
                                class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Commercial Interiors">
                                <p v-if="errors.title" class="my-2 color-red-500"> {{ errors.title[0] }}</p>
                            </div>
    
                            <div class="flex flex-col">
                                <label for="project_type" class="capitalize px-2 my-2 text-gray-600"> Project Type </label>
                                <input type="text" v-model="project.project_type" :class="{'border-red-500':errors.project_type}" 
                                class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Zihan Toy Factory Ltd">
                                <p v-if="errors.project_type" class="my-2 color-red-500"> {{ errors.project_type[0] }}</p>
                            </div>

                            <div class="col-span-2 lg:col-span-1">
                                <div class="flex flex-col my-4">
                                    <label for="project" class="px-2 font-bold text-slate-600 capitalize"> Product Video Link </label>
                                    <input class="my-3 border-2 border-cyan-200 px-1 py-2 focus:ouline-none" type="text"
                                    placeholder="video link" v-model="project.video_link" />
        
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col mt-2">
                            <label for="short_description" class="capitalize px-2 my-2 text-gray-600"> short description </label>
                            <textarea cols="30" rows="4" v-model="project.short_description"
                                :class="{'border-red-500':errors.short_description}" 
                                class="px-2 py-2 border-2 border-gray-200 focus:outline-none">
                            </textarea>
                            <p v-if="errors.short_description" class="my-2 color-red-500"> {{ errors.short_description[0] }}</p>
                        </div>


                        <div class="flex flex-col mt-4">
                            <label for="development_page_category_id" class="capitalize px-2 my-2 text-gray-600"> Select Category </label>
                            <select v-model="project.development_page_category_id" :class="{'border-red-500':errors.development_page_category_id}" 
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Commercial Interiors">
                                <option v-for="category in categories" :key="category.id" value="category.id"> {{category.categoryName}}</option>
                            </select>
                            <p v-if="errors.development_page_category_id" class="my-2 color-red-500"> {{ errors.development_page_category_id[0] }}</p>
                        </div>

                        
                        <div class="flex flex-col my-2">
                            <label for="product_img" class="my-4 text-slate-500 px-4 capitalize font-semibold"> 
                                 image
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <Multiselect
                                v-model="project.imgs"
                                :options="options"
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
                            <p v-if="errors.images" class="text-red-500"> {{ errors.images[0] }}</p>
                        </div>
                    

                    
                        <div class="flex flex-col my-4">
                            <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                                    product description 
                                    <i class="fa-regular fa-star text-orange-500"></i>
                                </label>
                                <QuillEditor v-model:content="productDetails" contentType="html" toolbar="full" >
                                    
                                </QuillEditor>
                                
                        </div>

                    

                        <button class="px-4 py-3 uppercase text-white bg-blue-800 transition duration-300 rounded-md hover:bg-blue-600">
                            {{ formCreate ?'Create Color':'Update Color' }}
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
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, defineComponent } from 'vue';
import { QuillEditor, Delta } from '@vueup/vue-quill';
export default{
    components: {
    Multiselect, QuillEditor,NotificationAdmin,
  },
    data(){
        return{
            formCreate:false,
            modal:true,
            project_type:'',
            categories:{},
            project:{
                imgs:[],
            },
            options: [
                
            ],
            errors:{},
            showProductsType:'all',
            showProducts:[],
            showProductLength:5,
            allProducts:[],
            allProductLength:'',
            btnMessage:"load more",

            notification:{
                type:'',
                message:'',
                deleteId:'',
            }
        }
    },
    setup: () => {
        const contentDelta = ref<Delta>(
        new Delta([
                { insert: 'Gandalf', attributes: { bold: true } },
                { insert: ' the ' },
                { insert: 'Grey', attributes: { color: '#ccc' } },
            ])
        )
        const productDetails = ref()
        return { contentDelta, productDetails}
    },

    methods:{
        modalCreate(e){
            let project_type = e.target.getAttribute('data-name');
            this.project_type = project_type;
        
            this.errors = this.errors ? '': this.errors;
            this.color = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore(){
            this.btnMessage = 'looding...';
            this.showProductLength = this.showProductLength + 10;
            this.showProducts = this.allProducts.slice(0, this.showProductLength);
            this.btnMessage = 'load more';
        },
        allProductsShow(){
            this.showProductsType = 'all';
            this.reloadPage();
        },
        trashedProudcts(){
            this.showProductsType = 'trashed';
            axios.get('/admin/product/trashed')
            .then(res =>{
                this.allProducts = res.data;
                this.showProducts = this.allProducts.slice(0,5);
                this.allProductLength = res.data.length;
            })
        },
        deleteProdcut(id){
            axios.delete('/admin/product/delete/'+id)
            .then(res =>{
                this.notification.type='delete';
                this.notification.message = 'Do you Want To delete Product';
                this.notification.deleteId = id;
                this.showProducts = this.showProducts.filter(product => product.id !== id );
            })    
        },
        trashRestore(id){
            axios.post('/admin/product/restore/'+id)
            .then(res =>{
                this.notification.type='success';
                this.notification.message='successfully Restored ! ';
                this.showProducts = this.showProducts.filter(product => product.id !== id);
            })
        },
        restore(id){
            axios.post('/admin/product/restore/'+id)
            .then(res =>{
                this.notification.type='success';
                this.notification.message='successfully Restored ! ';
                this.reloadPage();
            })
        },
        reloadPage(){
            axios.get('/admin/products')
            .then( res =>{
                this.allProducts = res.data;
                this.showProducts = this.allProducts.slice(0,5);
                this.allProductLength = res.data.length;
                
            })
        },
        productFilter(e){
            let productTitle = e.target.value.toLowerCase();
            this.allProducts = this.allProducts.filter(
                product => product.product_title.toLowerCase().includes(productTitle)
            );
            this.showProducts = this.allProducts;
            if(!productTitle){
                this.reloadPage();
            }else if(!this.showProducts.length){
                this.reloadPage;
            }
        }

    },
    mounted(){
        axios.get('/admin/products')
        .then( res =>{
            this.allProducts = res.data;
            this.showProducts = this.allProducts.slice(0,5);
            this.allProductLength = res.data.length;
            
        })
    },

    created(){
        axios.get('/admin/development/page/category/index')
        .then(res =>{
            this.categories = res.data;
        })
        axios.get('/admin/product/create')
        .then(res=>{
        
            let imgs = res.data[4];
            imgs.forEach(img=>{
                this.options.push(
                    {
                        value:img.id,
                        name:img.product_img_name,
                        image:img.img,
                    }
                )
            });
        }); 
    }
}
</script>