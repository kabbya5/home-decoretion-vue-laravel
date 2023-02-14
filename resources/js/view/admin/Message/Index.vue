<template>
    <div class="w-full">
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="my-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex">
                    <button class="font-semibold capitalize"> All messages </button>
                </div>
                <button @click="deleteMessage()" class="py-1 px-2 bg-red-700 text-white mr-4"
                title="delete-all-unwanted-message"> 
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            phone
                         </th>
                        <th scope="col" class="py-3 px-6">
                           Email
                        </th>
                        <th scope="col" class="py-3 px-6">
                           Subject
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="message in messages" :key="message.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ message.contact_name }}
                        </th>
                        <td class="py-4 px-6">
                            {{ message.contact_phone }}
                        </td>
                        <td class="py-4 px-6">
                            {{ message.contact_email }}
                        </td>
                        <td class="py-4 px-6">
                            {{ message.contact_subject }}
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="view(message)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-eye"></i>
                            </button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- modal -->
        <div v-if="modal" class="fixed top-0 left-0  w-full h-screen bg-gray-300/60">
            <div class="flex items-center justify-center">
                <div class="my-10  w-[500px] px-4 py-8  bg-white">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>

                    <div class="">
                        <p class="my-3 text-gray-800 font-smibold">
                            Name: {{ message.contact_name }}
                        </p>
                        <p class="my-3 text-gray-800 font-smibold">
                            Email: {{ message.contact_email }}
                        </p>
                        <p class="my-3 text-gray-800 font-smibold">
                            Phone: {{ message.contact_phone }}
                        </p>
                        <p class="my-3 text-gray-800 font-smibold">
                            Subject: {{ message.contact_subject}}
                        </p>
                        <p class="my-3 text-gray-800 font-smibold">
                            {{ message.contact_description}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Notification from '../NotificationAdmin.vue';
export default{
    components:{Notification,},
    data(){
        return{
            modal:false,
            messages:[],
            message:{},
            messagesCount:'',

            notification:{
                type:'',
                message:"",
            },
        }
    },
    methods: {
        view(message){
            this.modal = !this.modal;
            this.message = message;
        },
        deleteMessage(){
            axios.delete('/admin/message/delete')
            .then(res => {
                this.notification.type = 'success',
                this.notification.message = "Successfully delete unwanted message";
            })
        }

    },
    created(){
        axios.get('/admin/message/index')
        .then(res =>{
            this.messages = res.data;
            this.messagesCount = 'Total ' + res.data.length + ' messages';
        })
    }
}
</script>