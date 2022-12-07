<template>
    <div class="w-full">
        <div class="my-10">
            <Notification  :notification="notification" v-if="notification.message" /> 
            <div class="flex flex-col md:flex-row items-center justify-between">
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           slider Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           slider Image
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
                    <tr v-for="slider in sliders" :key="slider.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ slider.sliderName }}
                        </th>
                        <td class="py-4 px-6">
                            <img class="w-10 h-10" :src="slider.sliderImg" alt="{{ slider.sliderName }}">
                        </td>
                        <td class="py-4 px-6">
                            {{ slider.date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(slider)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deleteslider(slider.id,slider.sliderName)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
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
                {{ slidersCount }}
            </div>
            <div v-if="length <= slidersLength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed z-50 top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex flex-col items-center justify-center">
                <div class="w-full px-4 py-8  bg-white">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <form @submit.prevent="formCreate ?createSLider() : updateslider()" enctype="multipart/form-data">
                        
                                <div class="flex w-full">
                                    <div class="flex flex-col w-full">
                                        <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe slider Name </label>
                                        <input type="text" placeholder="slider Name"
                                        :class="{'border-1 border-red-500':errors.sliderName}"
                                        class="my-2 px-4 py-2 border-2 focus:outline-none
                                            focus:border-gray-300" v-model="slider.sliderName">
        
                                        <p v-if="errors.sliderName" class="text-red-500"> {{ errors.sliderName[0] }} </p>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <label for="image" class="my-2 mx-4 text-gray-500 font-semibold"> Button Text  </label>
                                        <div class="flex justify-between items-center w-full">
                                            <input type="text" placeholder="slider Button Text"
                                                class="my-2 px-4 py-2 border-2 focus:outline-none
                                                focus:border-gray-300" 
                                                :class="{'border-1 border-red-500':errors.sliderImg}"
                                                v-model="slider.buttonText">
                                        </div>
                                        <p v-if="errors.sliderImg" class="text-red-500"> {{ errors.sliderImg[0] }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <label for="image" class="my-2 mx-4 text-gray-500 font-semibold"> slider Image </label>
                                    <div class="flex justify-between items-center w-full">
                                        <input type="file" placeholder="slider Image"
                                            class="my-2 px-4 py-2 border-2 focus:outline-none
                                            focus:border-gray-300" 
                                            :class="{'border-1 border-red-500':errors.sliderImg}"
                                            @change="onFileChange">
    
                                        <img class="ml-2 w-14 h-14 rounded-full" :src="slider.sliderImg ? slider.sliderImg : slider.oldImg" alt="">
                                        <input type="hidden" v-model="oldImg">
                                    </div>
                                    <p v-if="errors.sliderImg" class="text-red-500"> {{ errors.sliderImg[0] }}</p>
                                </div>
        
                                <div class="flex flex-col my-4">
                                    <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                                         product desdcription 
                                         <i class="fa-regular fa-star text-orange-500"></i>
                                        </label>
                                        <QuillEditor v-model:content="contentHTML" contentType="html" toolbar="full" />
                                </div>
                                
                                <div class="flex justify-center">
                                    <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                        duration-300 text-center text-blue-800 border-2 border-blue-800
                                        hover:text-green-800 hover:border-green-800"> 
                                        {{ formCreate ? 'create slider ' : 'update slider' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <div class="my-4 bg-white w-full"> 
                                <p class="text-center my-2"> preview</p>
                                <div class="relative w-full">
                                    <img class="block object-cover w-full h-600" :src="slider.sliderImg ? slider.sliderImg : slider.oldImg" alt="">
                                    <div class="absolute flex flex-col justify-center items-center bottom-[20%] z-10 text-white left-[20%]">
                                        <div class="ql-snow">
                                            <p class="ql-editor" v-html="contentHTML"></p>
                                        </div>
            
                                        <button class="my-4 px-4 py-2 bg-white text-gray-600 font-bold uppercase rounded-md transition duration-300 hover:bg-gray-200 hover:scale-[1.05]"> {{ slider.buttonText }} </button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, defineComponent } from 'vue'
import { QuillEditor, Delta } from '@vueup/vue-quill'
import Notification from '../NotificationAdmi.vue';
export default{
    components:{Notification,QuillEditor,},
    data(){
        return{
            modal:false,
            sliders:[],
            slidersCount:'',
            length:5,
            allSliders: [],
            slidersLength:'',
            btnMessage:"load more",
            
            // form data 
            slider:{}, 
            errors:{},
            formCreate:true,

            notification:{
                type:'',
                message:"",
                deleteId:'',
            },
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
        const contentHTML = ref('<h1> slider title and text here </h1>')
        return { contentDelta, contentHTML}
    },
    methods: {
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.slider = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.sliders = this.allSliders.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
                
        },
        createImage(file) {
            
            let reader = new FileReader();
            reader.onload = (e) => {
                this.slider.sliderImg =  e.target.result;
            };
            reader.readAsDataURL(file);
        },
        createSLider(){
            axios.post('/api/admin/slider',{
                sliderName:this.slider.sliderName,
                sliderImg:this.slider.sliderImg,
                sliderText:this.contentHTML,
                buttonText:this.slider.buttonText,
            })
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'slider has been Created SuccessFully';
                this.reloadslider();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(slider){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.slider = {
                id: slider.id,
                sliderName:slider.sliderName,
                oldImg:slider.sliderImg,
                sliderText:this.contentHTML,
                buttonText:slider.buttonText,
            };
            this.contentHTML = slider.sliderText;
        },
        updateslider(){
            axios.put('/api/admin/slider/update/' + this.slider.id,{
                sliderName:this.slider.sliderName,
                sliderImg:this.slider.sliderImg,
                sliderText:this.contentHTML,
                buttonText:this.slider.buttonText,
                oldImg:this.slider.oldImg,
            })
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'slider has been updated SuccessFully';
                this.reloadslider();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadslider(){
            axios.get('/api/admin/slider')
            .then(res =>{
                this.notification.deleteId = null;
                this.notification.type = 'success';
                this.notification.message = 'The slider has been deleted successsfully';
                this.allSliders = res.data[0];
                this.sliders = res.data[0].slice(0, this.length);
                this.slidersCount = res.data[1];
                this.slidersLength = res.data[0].length;
            })
        },
        deleteslider(id,name){
            this.notification.type ='force';
            this.notification.message = `Do you want to delete ${name} brad  ?`;
            this.notification.deleteId = id;
            this.sliders = this.sliders.filter(slider => slider.id !== id);
        },
        forceDelete(id){
            axios.delete('/api/admin/slider/' + id)
            .then(res=>{
                this.reloadslider();
            })
        }
                
    },
    created(){
        axios.get('/api/admin/slider')
        .then(res =>{
            this.allSliders = res.data[0];
            this.sliders = res.data[0].slice(0, this.length);
            this.slidersCount = res.data[1];
            this.slidersLength = res.data[0].length;
        });
        document.title = 'Admin/SLider'
    },
}
</script>