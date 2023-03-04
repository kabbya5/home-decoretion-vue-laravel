<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        
        <div class="my-10 flex flex-row justify-between items-center pb-2">
            <div class="flex">
                <div class="text-center  text-gray-700 font-bold text-xl"> Social Media links  </div>
            </div>
            <button @click="createModalForm" class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                transition duration-300 hover:bg-indigo-800 hover:text-white"> create new</button>
        </div>
        <!-- data table  -->
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Link Nane
                         </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Link Url
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Link icon
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="link in socialMediaLinks" :key="link.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ link.media_name }}
                        </th>
                        <td scope="row" class="py-4 px-6 font-medium whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ link.link_url }}
                        </td>
                        <td class="py-4 px-6">
                            {{link.link_icon}} <i class="mx-2 text-black" :class="link.link_icon"></i>
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editSocialMediaLink(link)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- modal form  -->
        <div v-if="modal" class="fixed modal z-50 top-0 left-0 w-full h-screen bg-gray-200/60">
            <div class="flex justify-center items-center">
                <div class="w-96 -ml-10 bg-white px-4 my-10">
                    <button @click="modal = !modal" class="block w-full text-right">
                        <i class="fa-solid fa-xmark fa-2x text-red-500 "></i>  
                    </button>
                    
                    <form @submit.prevent="formCreate ? createSocialMediaLink() : updateSocialMediaLink()" class="w-full">
                        <div class="flex flex-col my-4">
                            <label for="media_name" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Social Media Name </label>
                            <input type="text" placeholder="Social Media  Name"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.media_name}"
                            v-model="socialMediaLink.media_name">

                            <p v-if="errors.media_name" class="text-red-500">{{ errors.media_name[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="link_url" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Social Media Link url </label>
                            <input type="text" placeholder="Social Media Link Name"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.link_url}"
                            v-model="socialMediaLink.link_url">

                            <p v-if="errors.link_url" class="text-red-500">{{ errors.link_url[0] }}</p>
                        </div>

                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="link_icon" class="my-3 mx-4 text-lg text-gray-500 capitalize"> Social Media Link icon </label>
                                <i class="" :class="socialMediaLink.link_icon"></i>
                            </div>
                            <input type="text" placeholder="Social Media Link icon"
                            class="px-4 py-2 border-2 border-gray-200 text-graya-400 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.link_icon}"
                            v-model="socialMediaLink.link_icon">

                            <p v-if="errors.link_icon" class="text-red-500">{{ errors.link_icon[0] }}</p>
                        </div>

                        <button type="submit" class="capitalize py-2 my-4 px-4 bg-indigo-800 text-white rounded-md transition duratuion-300 hover:bg-indigo-600">
                             {{ formCreate ? 'create link' :'update link'}} 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Notification from '../NotificationAdmin.vue';

export default{
    components: {
    Notification,
  },

    data (){
        return{
            modal:false,
            formCreate:true,
            socialMediaLinks:[],
            socialMediaLink:{},
            errors:{},

            notification:{
                type:'',
                message:'',
            }
        }
    },
    methods:{
        createModalForm(){
            this.modal = true;
            this.formCreate = true;
            this.errors = {};
            this.socialMediaLink= {};
        },
        createSocialMediaLink(){
            axios.post('/admin/site/setting/social/midia/links/create',this.socialMediaLink)
            .then(res =>{
                this.modal = false;
                this.notification.type ='success',
                this.notification.message = " The social media link has been created successfully";
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        editSocialMediaLink(link){
            this.socialMediaLink = link;
            this.formCreate = false;
            this.modal = true;
            this.errors = {};
        },
        updateSocialMediaLink(){
            axios.put('/admin/site/setting/social/midia/links/update/'+ this.socialMediaLink.id,this.socialMediaLink)
            .then(res =>{
                this.modal = false;
                this.notification.type ='success',
                this.notification.message = " The site Setting has been updated successfully";
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
    },
        
       
    mounted(){

        axios.get('/admin/site/setting/social/midia/links')
        .then(res =>{
            this.socialMediaLinks = res.data;
        })
         
    },
    created(){
        let pageTitle = document.title;
        document.title = 'medial-link | ' + pageTitle;
    }
}
</script>