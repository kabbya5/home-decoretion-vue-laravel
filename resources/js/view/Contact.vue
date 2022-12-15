<template>
    <div class="container mx-auto mt-[90px] md:mt-0">
        <div class="header mx-2 md:mx-0 mt-10 md:mt-0 flex items-center"> 
            <router-link to="/" class="capitalize mx-4 text-gray-700">
                home
            </router-link>
            <i class="fa solid fa-chevron-right"></i>
            <button  class="capitalize mx-4 text-gray-700">
                contact
            </button>
        
        </div>
        <div class="contact-body my-10 w-full  md:w-[700px] mx-auto">
            <h2 class="text-gray-900 capitalize font-bold text-[35px]"> {{ contactSetting.contact_title }}  </h2>
            <p class="my-10">
                {{ contactSetting.contact_message }}
            </p>

            <form @submit.prevent="sendMessage" class="form">
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full">
                        <label for="name" class="text-slate-800 font-semibold my-3 capitalize"> name </label>
                        <input type="text" v-model="contact.contact_name"
                        class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_name}">

                        <p v-if="errors.contact_name" class="text-red-500"> {{errors.contact_name[0]}} </p>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="phone" class="text-slate-800 font-semibold my-3 capitalize"> phone </label>
                        <input type="text" v-model="contact.contact_phone"
                        class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_phone}">

                        <p v-if="errors.contact_phone" class="text-red-500"> {{errors.contact_phone[0]}} </p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full">
                        <label for="email" class="text-slate-800 font-semibold my-3 capitalize"> email </label>
                        <input type="text" v-model="contact.contact_email"
                        class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_email}">

                        <p v-if="errors.contact_email" class="text-red-500"> {{errors.contact_email[0]}} </p>
                    </div>
                    <div class="flex flex-col w-full">
                        <label for="subject" class="text-slate-800 font-semibold my-3 capitalize"> subject </label>
                        <input type="text" v-model="contact.contact_subject"
                        class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                        :class="{'border-red-500':errors.contact_subject}">
    
                        <p v-if="errors.contact_subject" class="text-red-500"> {{errors.contact_subject[0]}} </p>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <label for="" class="text-slate-800 font-semibold my-3 capitalize"> desciption </label>
                    <textarea name="" id="" cols="30" rows="10" v-model="contact.contact_description"
                    class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_description}">
                    
                    </textarea>
                    <p v-if="errors.contact_description" class="text-red-500"> {{errors.contact_description[0]}} </p>
                </div>
                
                <button class="my-4 py-1 px-6 capitalize bg-blue-600 text-white rounded-lg text-xl"> send Message</button>
            </form>
        </div>

        <div class="location-map my-10 mx-4 :lg-mx-0 h-[400px] md:h-[600px]">
        
            <iframe :src="contactSetting.contact_location_map" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <LoadingVue v-if="loading" :loading="loading" />

        <NotificationAdminVue v-if="notification.message" :notification="notification" />
    </div>
    
</template>
<script>
import LoadingVue from '../components/Loading.vue';
import NotificationAdminVue from './admin/NotificationAdmin.vue';
export default{
    components:{LoadingVue,NotificationAdminVue,},
    data(){
        return{
            loading: 'loading...',
            contactSentSuccessMessage:true,
            contact:{
                contact_name:'kabbya',
                contact_phone:'01721597157',
                contact_email:'kabbya@gmail.com',
                contact_subject: 'email_testing',
                contact_description:'Fundpress site thoughtfully designed for real humans which means the best user experience for your entire community of donors, fundraisers, customers, and staff.', 
            },
            errors:{},
            contactSetting:[],
            notification:{
                message:'',
                type:'',
            }
        }
    },
    methods:{
        sendMessage(){
            this.loading = 'sending message ...';
            axios.post('/contact/message/sent',this.contact)
            .then(res =>{
                this.notification.message= 'the contact message has been send';
                this.notification.type= 'success';
                this.contact = {};
                this.loading = false;
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        }
    },
    mounted(){
        axios.get('/contact/page/setting')
        .then(res => {
            this.contactSetting = res.data;
            this.loading = false;
        });
        axios.get('/notifications');
    },
}
</script>
<style scoped>
iframe{
    width: 100%;
    height: 100%;
}
</style>