<template>
    <div>
        <div class="py-2 px-1 mt-[90px] md:mt-0 md:px-4" id="bottom-nav">
            <div class="w-full md:w-[600px] mx-auto">
                <div class="flex justify-center items-center">
                    <div class="logo flex flex-col items-center justify-center">     
                        <img v-if="user.old_img" class="w-20 h-20 rounded-full" :src="user.old_img?user.old_img:user.profile_img" :alt="user.slug">
                        <i v-else class="fa-regular fa-user fa-3x"></i>
                        <h2 class="capitalize text-gray-600 font-bold my-2"> Md Kabbya </h2>
                        <button :id="user.is_admin" @click="changeUserRole(user.id)"  class="my-4 mx-6 px-4 py-1 rounded-md bg-orange-700 text-white">
                            {{ user.is_admin }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar flex-col">
            <div class="mt-10">
                <h2 class="text-gary-600 font-semiblod capitalize text-center text-xl"> User Account created date {{ user.created_date }} </h2>
                <form @submit.prevent="updateUserAccount()" class="my-10 w-full md:w-[500px] mx-auto">
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="first_name" class="my-2 text-gary-600 font-semiblod capitalize"> First Name </label>
                            <input type="text" v-model="user.first_name"
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.first_name}">

                            <p class="text-red-500" v-if="errors.first_name"> {{errors.first_name[0]}}</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="last_name" class="my-2 text-gary-600 font-semiblod capitalize"> Last Name </label>
                            <input type="text" v-model="user.last_name"
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.last_name}">

                            <p class="text-red-500" v-if="errors.last_name"> {{errors.last_name[0]}}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="profile_img" class="my-2 text-gary-600 font-semiblod capitalize"> profile Image </label>
                        <div class="flex h-12 w-full">
                            <input type="file" @change="onFileChange"
                            class="w-full h-full border-2 border-gray-200 py-2 px-3 focus:outline-none">
                            <img :src="user.old_img ? user.old_img : user.profile_img " :alt="user.slug">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="first_name" class="my-2 text-gary-600 font-semiblod capitalize"> user name  </label>
                            <input type="text" v-model="user.user_name "
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.user_name }">

                            <p class="text-red-500" v-if="errors.user_name "> {{errors.user_name [0]}}</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="phone" class="my-2 text-gary-600 font-semiblod capitalize"> phone number </label>
                            <input type="text" v-model="user.phone"
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.phone}">

                            <p class="text-red-500" v-if="errors.phone"> {{errors.phone[0]}}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="email" class="my-2 text-gary-600 font-semiblod capitalize"> E-Mail: </label>
                            <input type="text" v-model="user.email" 
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.email}">

                            <p class="text-red-500" v-if="errors.email"> {{errors.email[0]}}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="password" class="my-2 text-gary-600 font-semiblod capitalize"> Password: </label>
                            <input type="password" v-model="user.password" 
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.password}">

                            <p class="text-red-500" v-if="errors.password"> {{errors.password[0]}}</p>
                        </div>
                    </div>
                     
                    <button type="submit" class="my-4 px-4 py-2 bg-blue-700 text-white"> Update Account </button>
                </form>
            </div>
        </div>
        <LoadingVue v-if="loading" :loading="'Loading...'" />
        <NotificationAdminVue v-if="notification.message" :notification="notification" />
    </div>
    
</template>
<script>

import NotificationAdminVue from '../NotificationAdmin.vue';
import LoadingVue from '../../../components/Loading.vue';
export default{
    components:{LoadingVue,NotificationAdminVue},
    data(){
        return {
            loading:false,
            user:{},
            errors:{},

            notification:{
                type:'',
                message:'',
            }
        }
    },
    methods:{
        logout(){
            axios.post('/logout')
            .then(res => this.$router.push({name:'home',params:{reload:1}}));
        },
        onFileChange(e ) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.user.profile_img = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        changeUserRole(id){
            axios.put('/admin/user/role/change/'+id)
            .then(res => {
                this.loading = true;
                this.notification.message = "Successfully updated";
                this.notification.type= 'success',
                this.loading = false;
                this.reloadPage();
            })
        },

        updateUserAccount(){
            axios.put('/admin/user/profile/update/'+this.user.id,this.user)
            .then(res =>{
                this.loading = true;
                this.notification.message = "Successfully updated";
                this.notification.type= 'success',
                this.loading = false;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        reloadPage(){
            let slug = this.$route.params.slug;

            axios.get('/admin/user/show/' + slug)
            .then(res => {
                this.loading = true;
                let user = res.data;
            
                this.user.first_name = user.first_name;
                this.user.last_name = user.last_name;
                this.user.email = user.email;
                this.user.phone = user.phone;
                this.user.user_name = user.user_name;
                this.user.id = user.id;
                this.user.old_img = user.profile_img;
                this.user.is_admin = user.is_admin;
                this.user.slug = user.slug;

                this.loading = false;
            });
        }
    },
    mounted(){
        let slug = this.$route.params.slug;

        axios.get('/admin/user/show/' + slug)
        .then(res => {
            this.loading = true;
            let user = res.data;
           
            this.user.first_name = user.first_name;
            this.user.last_name = user.last_name;
            this.user.email = user.email;
            this.user.phone = user.phone;
            this.user.user_name = user.user_name;
            this.user.id = user.id;
            this.user.old_img = user.profile_img;
            this.user.is_admin = user.is_admin;
            this.user.slug = user.slug;

            this.loading = false;
        });
    }
   
}

</script>
<style scoped>
    button#user{
        background-color: rgb(42, 144, 11) !important;
    }
    button{
        font-size: 16px;
        text-transform: capitalize;
        font-weight: 500;
        color:rgb(239, 237, 234);

    }
</style>
