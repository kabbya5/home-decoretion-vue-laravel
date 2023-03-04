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
                            Description
                        </th>
                        <th scope="col" class="py-3 px-6">
                            position
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-for="(section,index) in sections" :key="index" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            # {{ index + 1 }}   
                        </th>
                        <td  class="py-4 px-6">
                            {{ section.title}}
                        </td> 
                        <td class="py-4 px-6">
                             <i :class="section.icon" class="fa-2x"></i>
                        </td>
                        <td class="py-4 px-6">
                            {{ section.description.substring(0,50)+'....'}}
                        </td>
                        <td class="py-4 px-6">
                            {{ section.position}}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(section)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more button  -->


        <!-- modal -->
        <div v-if="modal" class="fixed modal left-0 top-0 z-[50] w-full h-screen bg-gray-200/60">
            <div class="flex justify-center items-center">
                <div class="w-[600px] -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>     
                    </button>
                    
                    <form @submit.prevent="formCreate ? createSection() : updatesection()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="title" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Title </label>
                            <input type="text" placeholder="Title"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.title}"
                            v-model="section.title">

                            <p v-if="errors.title" class="text-red-500">{{ errors.title[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="description" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Short Description </label>
                            <textarea rows="5" type="text" placeholder="description"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.description}"
                            v-model="section.description">
                            </textarea>

                            <p v-if="errors.description" class="text-red-500">{{ errors.description[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Icon </label>
                                <i class="" :class="section.icon"></i>
                            </div>
                            <input type="text" placeholder="Icon"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.icon}"
                            v-model="section.icon">

                            <p v-if="errors.icon" class="text-red-500">{{ errors.icon[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> position </label>
                            </div>
                            <input type="text" placeholder="1 to 100"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.position}"
                            v-model="section.position">
                            <p v-if="errors.position" class="text-red-500">{{ errors.position[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> section_type : {{ section.section_type }} </label>
                            </div>
                            <select v-model="section.section_type" class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.section_type}">
                                <option disabled value=""> Please select one </option>
                                <option value="our-value">Our Value</option>
                                <option value="find-us"> Find Us </option>
                            </select>
                            <p v-if="errors.section_type" class="text-red-500">{{ errors.section_type[0] }}</p>
                        </div>

                        <button type="submit" class="capitalize py-2 my-4 px-4 bg-indigo-800 text-white rounded-md transition duratuion-300 hover:bg-indigo-600">
                             {{ formCreate ? 'create section' :'update section'}} 
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
            sections:[],
            section:{},
            errors:{},
            formCreate:true,
        }
    },
    methods:{
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.section = {},
            this.selectItem = '';
            this.modal = !this.modal;
            this.formCreate = true;
        },
        
        createSection(){
            axios.post('/admin/development/page/value/store',this.section)
            .then(response => {
                this.reloadsection();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(section){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.section = section;
        },
        updatesection(){
            axios.put('/admin/hompage/section/update/' + this.section.id, this.section)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'sectionegory has been updated SuccessFully';
                this.reloadsection();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        reloadsection(){
            axios.get('/admin/hompage/section')
            .then(res =>{
                this.sections = res.data;
            })
        },           
    },
    created(){
        axios.get('/admin/development/page/values')
        .then(res =>{
            this.sections = res.data;
        })
    }
}
</script>