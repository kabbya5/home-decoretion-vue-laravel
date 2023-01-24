<template>
    <div class="w-full">
        <div class="my-10">
            <Notification  :notification="notification" v-if="notification.message" /> 
            <div class="flex flex-col md:flex-row items-center justify-between">
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
                <div class="form-group w-94 flex items-center">
                    <input @keyup="searchTag" type="text" class="border-2 border-gray-200 focus:outline-none px-2 py-1 h-10">
                    <button class="px-3 py-1 text-white bg-cyan-500 transition duration-300 hover:bg-cyan-600 h-10">
                        <i class="class fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Tag Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Tag Image
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
                    <tr v-for="tag in showTags"  :key="tag.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ tag.tag_name }}
                        </th>
                        <td class="py-4 px-6">
                            <img v-if="tag.image" class="w-10 h-10" :src="tag.image.img" :alt="tag.tag_name">
                            <button v-else @click="editModal(tag)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i> 
                            </button> 
                        </td>
                        <td class="py-4 px-6">
                            {{ tag.date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(tag)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deletetag(tag.id,tag.tag_name)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
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
                {{allTags.length - showTags.length}} more Tags
            </div>
            <div v-if="allTags.length >= length" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed z-50 top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex flex-col items-center justify-center my-10">
                <div class="w-96 px-4 py-8  bg-white">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ?createtag() : updateTag()">
                        <div class="flex flex-col w-full">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe Tag Name </label>
                            <input type="text" placeholder="Tag Name"
                            :class="{'border-1 border-red-500':errors.tag_name}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300 w-full" v-model="tag.tag_name">

                            <p v-if="errors.tag_name" class="text-red-500"> {{ errors.tag_name[0] }} </p>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="tag_image" class="my-2 mx-4 text-gray-500 font-semibold"> Tag Image </label>
                            <Multiselect
                                v-model="tag.image_id"
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

                        <div class="flex flex-col w-full">
                            <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Tag Popularity </label>
                            <input type="text" placeholder="Tag Popularity"
                            :class="{'border-1 border-red-500':errors.popularity}"
                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                focus:border-gray-300 w-full" v-model="tag.popularity">

                            <p v-if="errors.popularity" class="text-red-500"> {{ errors.popularity[0] }} </p>
                        </div>
                            
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-center text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ formCreate ? 'create tag ' : 'update tag' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Multiselect from '@vueform/multiselect';
import Notification from '../NotificationAdmin.vue';
export default{
    components:{Notification,Multiselect,},
    data(){
        return{
            modal:false,
            showTags: [],
            length:5,
            allTags: [],
            // tag Image 
            images:[],

            btnMessage:"load more",
            
            // form data 
            tag:{
                tag_name:'',
                image_id:[],
            }, 
            optionImages:[],
            errors:{},
            formCreate:true,

            notification:{
                type:'',
                message:"",
                deleteId:'',
            },
        }
    },
    methods: {
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.tag = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.showTags = this.allTags.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        searchTag(e){
            let searchText = e.target.value.toLowerCase();
            this.allTags = this.allTags.filter(
                tag => tag.tag_name.toLowerCase().includes(searchText)
            );
            this.showTags = this.allTags;
            if(!searchText){
                this.reloadTag();
            }else if(!this.showTags.length){
                this.reloadTag();
            }
        },
        createtag(){
            axios.post('/admin/tag/store',this.tag)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'tag has been Created SuccessFully';
                this.reloadTag();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(tag){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.tag = {
                id: tag.id,
                tag_name:tag.tag_name,
                image_id: tag.image_id?[tag.image_id]:[],
                popularity:tag.popularity,
               
            };
        },
        updateTag(){
            axios.put('/admin/tags/update/' + this.tag.id,this.tag)
            .then(response => {
                this.notification.type = 'edit';
                this.notification.message = 'tag has been updated SuccessFully';
                this.reloadTag();
                this.modal = !this.modal;
                this.formCreate = true;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadTag(){
            axios.get('/admin/tag/index')
            .then(res =>{
                this.allTags = res.data;
                this.showTags = res.data.slice(0, this.length);
            });
        },
        deletetag(id,name){
            this.notification.type ='force';
            this.notification.message = `Do you want to delete ${name} brad  ?`;
            this.notification.deleteId = id;
        },  
        forceDelete(id){
            axios.delete('/admin/tag/delete/'+id)
            .then(res =>{
                this.notification.type='sucess';
                this.notification.message="successfully deleted !";
                this.showTags = this.showTags.filter(tag => tag.id !== id);
            })
        }          
    },
    created(){
        axios.get('/admin/tag/index')
        .then(res =>{
            this.allTags = res.data;
            this.showTags = res.data.slice(0, this.length);
        });

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

        document.title = 'Tag | Admin'
    },
}
</script>