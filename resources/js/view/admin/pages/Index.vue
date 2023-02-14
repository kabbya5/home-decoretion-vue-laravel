<template>
    <div class="w-full">
        <div class="my-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex">
                    <button class="font-semibold"> All Pages </button>
                </div>
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                          #No
                        </th>
                        <th scope="col" class="py-3 px-6">
                             page title
                        </th>
                        <th scope="col" class="py-3 px-6">
                            page content
                        </th>
                        <th scope="col" class="py-3 px-6">
                            popularity
                        </th>
                        <th scope="col" class="py-3 px-6">
                            created date
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="(page,index) in pages" :key="index" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            # {{ index + 1 }}   
                        </th>
                        <td  class="py-4 px-6">
                            {{ page.page_title}}
                        </td> 
                        <td class="py-4 px-6">
                            <div class="ql-snow">
                                <p class="ql-editor" v-html="page.page_content.substring(0,250)"></p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            {{ page.popularity}}
                        </td>
                        <td class="py-4 px-6">
                            {{ page.created_date }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <div class="flex">
                                <button @click="editModal(page)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button> 
                                <router-link :to="{name:'page-details',params:{slug:page.slug}}" class="py-1 px-2 bg-green-500 text-white mr-4">
                                    <i class="fa-regular fa-eye"></i>
                                </router-link>
                            </div>
                             
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- modal -->
        <div v-if="modal" class="fixed modal left-0 top-0 z-[50] w-full h-screen bg-gray-200/60 overflow-auto">
            <div class="flex justify-center items-center">
                <div class="w-[80%] -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>
                        
                    </button>
                    
                    <form @submit.prevent="formCreate ? createPage() : updatePage()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="page_title" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Page Popularity </label>
                            <input type="text" placeholder="Page Popularity"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.popularity}"
                            v-model="page.popularity">

                            <p v-if="errors.popularity" class="text-red-500">{{ errors.popularity[0] }}</p>
                        </div>
                        <div class="flex flex-col my-4">
                            <label for="page_title" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Page Title </label>
                            <input type="text" placeholder="Page Title"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.page_title}"
                            v-model="page.page_title">

                            <p v-if="errors.page_title" class="text-red-500">{{ errors.page_title[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                                Page Description 
                                 <i class="fa-regular fa-star text-orange-500"></i>
                            </label>
                            <QuillEditor v-model:content="contentHTML" contentType="html" toolbar="full" class="overflow-auto" />
                            <p v-if="errors.page_content" class="my-2 text-red-500"> {{errors.page_content[0]}} </p>
                        </div>


                        
                        <button type="submit" class="capitalize py-2 my-4 px-4 bg-indigo-800 text-white rounded-md transition duratuion-300 hover:bg-indigo-600">
                             {{ formCreate ? 'create page' :'update page'}} 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import NotificationAdmin from '../NotificationAdmin.vue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, defineComponent } from 'vue'
import { QuillEditor, Delta } from '@vueup/vue-quill'
export default{
    components:{NotificationAdmin,QuillEditor,},
    data(){
        return{
            modal:false,
            pages:[],
            page:{},
            errors:{},
            formCreate:true,
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
        const contentHTML = ref('<h3> Add Your Page content without image  </h3>')
        return { contentDelta, contentHTML}
    },
    methods:{
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.page = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        createPage(){
            axios.post('/admin/page/create',{
                page_title:this.page.page_title,
                popularity:this.page.popularity,
                page_content: this.contentHTML,
            })
            .then(response => {
                this.reloadpage();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(page){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.page = {
                id:page.id,
                page_title:page.page_title,
                popularity:page.popularity,
            };
            this.contentHTML = page.page_content;
        },
        updatePage(){
            axios.put('/admin/page/update/' + this.page.id, {
                page_title:this.page.page_title,
                popularity:this.page.popularity,
                page_content: this.contentHTML,
            })
            .then(response => {  
                this.notification.type = 'edit',
                this.notification.message = 'pageegory has been updated SuccessFully';
                this.reloadpage();
                
            })
            .catch(errors => {
                this.modal = !this.modal;
                this.errors = errors.response.data.errors;
            });
        },
        reloadpage(){
            axios.get('/admin/page/index')
            .then(res =>{
                this.pages = res.data;
            })
        },           
    },
    created(){
        axios.get('/admin/page/index')
        .then(res =>{
            this.pages = res.data;
        })
    }
}
</script>