<template>
    <div>
        <NotificationAdminVue v-if="notification.message" :notification="notification" />
        <div class="my-10">
            <h2 class="text-gray-900 capitalize font-bold text-[30px]"> Contact Page Setting </h2>
        </div>

        <div class="w-full lg:w-[700px] mx-auto">
            <form @submit.prevent="createForm ? create() : update()">
                <div class="flex flex-col w-full">
                    <label for="title" class="text-slate-800 font-semibold my-3 capitalize"> contact_title </label>
                    <input type="text" v-model="contactSetting.contact_title"
                    class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_title}">

                    <p v-if="errors.contact_title" class="text-red-500"> {{errors.contact_title[0]}} </p>
                </div>

                <div class="flex flex-col w-full">
                    <label for="contact_location_map" class="text-slate-800 font-semibold my-3 capitalize"> contact_location_map </label>
                    <input type="text" v-model="contactSetting.contact_location_map"
                    class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_location_map}">

                    <p v-if="errors.contact_location_map" class="text-red-500"> {{errors.contact_location_map[0]}} </p>
                </div>

                <div class="flex flex-col w-full">
                    <label for="contact_button_text" class="text-slate-800 font-semibold my-3 capitalize"> contact button text </label>
                    <input type="text" v-model="contactSetting.contact_button_text"
                    class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_button_text}">

                    <p v-if="errors.contact_button_text" class="text-red-500"> {{errors.contact_button_text[0]}} </p>
                </div>
                <div class="flex flex-col w-full">
                    <label for="contact_message" class="text-slate-800 font-semibold my-3 capitalize"> contact message </label>
                    <textarea  cols="30" rows="10" v-model="contactSetting.contact_message"
                    class="border-2 border-gray-200 px-2 py-2 focus:outline-none"
                    :class="{'border-red-500':errors.contact_message}">
                    
                    </textarea>
                    <p v-if="errors.contact_message" class="text-red-500"> {{errors.contact_message[0]}} </p>
                </div>
                
                <button class="my-4 py-1 px-6 capitalize bg-blue-600 text-white rounded-lg text-xl"> {{createForm ? 'create':'update'}}</button>
            </form>
        </div>

        <LoadingVue v-if="loading" :loading="loading" />

        
    </div>
    
</template>
<script>
import NotificationAdminVue from '../NotificationAdmin.vue';
import LoadingVue from '../../../components/Loading.vue';

export default{
    components:{NotificationAdminVue,LoadingVue},
    data(){
        return {
            loading:false,
            createForm:true,
            contactSetting:{contact_title:''},
            errors:{},

            notification:{
                type:'',
                message:'',
            }
        }
    },
    methods:{
        create(){
            axios.post('/admin/contact/page/settings',this.contactSetting)
            .then(res =>{
                this.errors = {};
                this.createForm = false;
                this.loading = 'loading...';
                this.notification.type ='success';
                this.notification.message = " The contact page setting has been created successfully";
                this.loading = false;
            })
            .catch(errors => this.errors = errors.response.data.errors);
            

        },
        update(){
            axios.put('/admin/contact/page/settings/' +this.contactSetting.id,this.contactSetting)
            .then(res =>{
                this.loading = 'loading...';
                this.errors = {};
                this.notification.type ='success';
                this.notification.message = " The contact page setting has been updated successfully";
                this.loading = false;
            }) 
        }
    },
    mounted(){
        axios.get('/admin/contact/page/settings')
        .then(res => {
            this.loading = 'loading';
            this.contactSetting = res.data;
            this.loading = false;
            this.createForm = false;
        });
    },
    created(){
        let pageTitel = document.title;
        document.title = 'contact | admin | '+pageTitel;
    }
}
</script>