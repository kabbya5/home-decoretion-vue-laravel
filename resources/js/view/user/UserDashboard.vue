<template>
    <div>
        <div class="py-2 px-1 md:mt-0 md:px-4" id="bottom-nav">
            <router-link to="/"  class="text-md  mx-4 text-gray-500 font-bold">
                home / profile
            </router-link>
            <div class="w-full md:w-[600px] mx-auto">
                <div class="flex justify-center items-center">
                    <div class="logo flex flex-col items-center justify-center">
                        
                        <img v-if="userProfile.old_img" class="w-20 h-20 rounded-full" :src="userProfile.old_img? '/' + userProfile.old_img:userProfile.profile_img">
                        <i v-else class="fa-regular fa-user fa-3x"></i>
                        <h2 class="capitalize text-gray-600 font-bold my-2"> Md Kabbya </h2>
                        <button @click="logout" class="my-4 mx-6 px-4 py-1 rounded-md bg-red-500 text-white"> Logout </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar flex-col">
            <div class="mt-10">
                <h2 class="text-gary-600 font-semiblod capitalize text-center text-xl"> My Account Information </h2>
                <form @submit.prevent="updateUserAccount()" class="my-10 w-full md:w-[500px] mx-auto">
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="first_name" class="my-2 text-gary-600 font-semiblod capitalize"> First Name </label>
                            <input type="text" v-model="userProfile.first_name"
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.first_name}">

                            <p class="text-red-500" v-if="errors.first_name"> {{errors.first_name[0]}}</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="last_name" class="my-2 text-gary-600 font-semiblod capitalize"> Last Name </label>
                            <input type="text" v-model="userProfile.last_name"
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
                            <img :src="userProfile.profile_img ? userProfile.profile_img : '/' + userProfile.old_img" :alt="userProfile.slug">
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="first_name" class="my-2 text-gary-600 font-semiblod capitalize"> user name  </label>
                            <input type="text" v-model="userProfile.user_name "
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.user_name }">

                            <p class="text-red-500" v-if="errors.user_name "> {{errors.user_name [0]}}</p>
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="phone" class="my-2 text-gary-600 font-semiblod capitalize"> phone number </label>
                            <input type="text" v-model="userProfile.phone"
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.phone}">

                            <p class="text-red-500" v-if="errors.phone"> {{errors.phone[0]}}</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex flex-col w-full">
                            <label for="email" class="my-2 text-gary-600 font-semiblod capitalize"> E-Mail: </label>
                            <input type="text" v-model="userProfile.email" disabled
                            class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                            :class="{'border-red-500':errors.email}">

                            <p class="text-red-500" v-if="errors.email"> {{errors.email[0]}}</p>
                        </div>
                    </div>
                     
                    <button type="submit" class="my-4 px-4 py-2 bg-blue-700 text-white"> Update Account </button>
                    <a href="/password/reset"  class="mx-4 px-4 py-2 rounded-md bg-orange-700 text-white"> Update Password </a>
                </form>
            </div>
        </div>
       
        <NotificationAdminVue v-if="notification.message" :notification="notification" />
        <LoadingVue v-if="loading" :loading="'loading...'"/>
    </div>
    
</template>
<script>
import LoadingVue from '../../components/Loading.vue';
import NotificationAdminVue from '../admin/NotificationAdmin.vue';
export default{
    components:{LoadingVue,NotificationAdminVue},
    data(){
        return {
            loading:true,
            userProfile:{},
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
                    this.userProfile.profile_img = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        updateUserAccount(){
            axios.put('/user/profile/update/'+this.userProfile.id,this.userProfile)
            .then(res =>{
                this.loading = true;
                this.notification.message = "Successfully updated";
                this.notification.type= 'success',
                this.loading = false;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    },
    mounted(){
        axios.get('/user/get')
        .then(res => {
            this.loading = true;
            this.userProfile = res.data;
            this.userProfile.old_img = this.userProfile.profile_img;
            this.loading = false;
        });
    }
   
}

</script>
<style scoped>
    .button-active, .button-exact-active{
        background: rgb(209 213 219);
        color:rgb(63 63 70);
    }
    .active{
        background: rgb(229 231 235);
    }
</style>
