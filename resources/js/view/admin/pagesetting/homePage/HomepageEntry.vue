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
                          #No
                        </th>
                        <th scope="col" class="py-3 px-6">
                             Title
                        </th>
                        <th scope="col" class="py-3 px-6">
                             Font Icon 
                        </th>
                        <th scope="col" class="py-3 px-6">
                            single sentence
                        </th>
                        <th scope="col" class="py-3 px-6">
                            popularity
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="(entry,index) in entries" :key="index" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            # {{ index + 1 }}   
                        </th>
                        <td  class="py-4 px-6">
                            {{ entry.title}}
                        </td> 
                        <td class="py-4 px-6">
                             <i :class="entry.icon" class="fa-2x"></i>
                        </td>
                        <td class="py-4 px-6">
                            {{ entry.text}}
                        </td>
                        <td class="py-4 px-6">
                            {{ entry.popularity}}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(entry)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more button  -->

        <div v-if="allentryegoriesLength > showentryegoriesLength" @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allentryegoriesLength - showentryegoriesLength }} more entryegory
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
                    
                    <form @submit.prevent="formCreate ? createEntry() : updateEntry()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="title" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Home Page Entry Title </label>
                            <input type="text" placeholder="Home Page Entry Title"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.title}"
                            v-model="entry.title">

                            <p v-if="errors.title" class="text-red-500">{{ errors.title[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="text" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Home Page Entry text </label>
                            <input type="text" placeholder="Home Page Entry text"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.text}"
                            v-model="entry.text">

                            <p v-if="errors.text" class="text-red-500">{{ errors.text }}</p>      
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Home Page Entry Icon </label>
                                <i class="" :class="entry.icon"></i>
                            </div>
                            <input type="text" placeholder="Home Page Entry Icon"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.icon}"
                            v-model="entry.icon">

                            <p v-if="errors.icon" class="text-red-500">{{ errors.icon[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> section serial by popularity </label>
                            </div>
                            <input type="text" placeholder="1 to 100"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.popularity}"
                            v-model="entry.popularity">

                            <p v-if="errors.popularity" class="text-red-500">{{ errors.popularity[0] }}</p>
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
            entries:[],
            entry:{},
            errors:{},
            formCreate:true,
        }
    },
    methods:{
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.entry = {},
            this.selectItem = '';
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.showentryegoriesLength += 7;
            this.showentryegories = this.allentryegories.slice(0, this.showentryegoriesLength);
            this.btnMessage = 'load more'
        },
        createEntry(){
            axios.post('/admin/hompage/entry/create',this.entry)
            .then(response => {
                this.reloadentry();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(entry){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.entry = {
                id:entry.id,
                title:entry.title,
                text:entry.text,
                icon:entry.icon,
                popularity:entry.popularity,
            };
        },
     updateEntry(){
            axios.put('/admin/hompage/entry/update/' + this.entry.id, this.entry)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'entryegory has been updated SuccessFully';
                this.reloadentry();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadentry(){
            axios.get('/admin/hompage/entry')
            .then(res =>{
                this.entries = res.data;
            })
        },           
    },
    created(){
        axios.get('/admin/hompage/entry')
        .then(res =>{
            this.entries = res.data;
        })
    }
}
</script>