<template>
    <div class="bg-blue-800 w-full py-4 ">
        <div class="w-full">
            <div class="flex justify-center items-center">
                <div class="w-96 bg-white py-8 px-4">
                    <h4 class="text-black font-semibold border-t-2 border-gray-400
                        px-4 pt-4 uppercase">
                         new account register
                    </h4>
                    <form @submit.prevent="registerAccount" action="px-4 py-6">
                        <input type="text" placeholder="First Name"
                            :class="{'border-1 border-red-500': errors.name}"
                            class="py-2  px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none"
                            v-model="user.name">
                        
                        <p v-if="errors.name" class="text-red-500 py-2">
                            {{ errors.name[0] }}
                        </p>

                        <input type="text" placeholder="Last Name"
                            :class="{'border-1 border-red-500':errors.last_name}"
                            class="py-2  px-4 text-gray-800 w-full border-2 
                            focus:border-gray-200 focus:outline-none"
                            v-model="user.last_name">
                            
                        <p v-if="errors.last_name" class="text-red-500 ">
                            {{ errors.last_name[0] }}
                        </p>      

                        <input type="text" placeholder="User Name"
                            class="py-2  px-4 text-gray-800 w-full border-2 
                            focus:border-gray-200 focus:outline-none"
                            :class="{'border-1 border-red-500':errors.user_name}"
                            v-model="user.user_name">

                            <p v-if="errors.user_name" class="text-red-500 ">
                                {{ errors.user_name[0] }}
                            </p>
                        
                        <input type="text" placeholder="Your Phone"
                            class="py-2  px-4 text-gray-800 w-full border-2 
                                focus:border-gray-200 focus:outline-none"
                                :class="{'border-1 border-red-500':errors.phone}"
                                v-model="user.phone">

                        <p v-if="errors.phone" class="text-red-500 ">
                            {{ errors.phone[0] }}
                        </p>

                        <input type="gmail" placeholder="Mail Account"
                            class="py-2  px-4 text-gray-800 w-full border-2 
                                focus:border-gray-200 focus:outline-none"
                                :class="{'border-1 border-red-500':errors.email}"
                                v-model="user.email">

                        <p v-if="errors.email" class="text-red-500 ">
                            {{ errors.email[0] }}
                        </p>

                        <div class="flex justify-between">
                            <input v-if="showPassword" class="w-full appearance-none text-xl focus:outline-none border-2 border-gray-200 py-2 px-4" type="text" v-model="user.password">
                            <input v-else :class="{'border-1 border-red-500':errors.password}"
                                class="w-full appearance-none text-xl focus:outline-none border-2 border-gray-200 py-2 px-4" type="password" v-model="user.password"
                                placeholder="password">
                            <button class="button w-10" @click="passwordShow" type="button">
                                <span class="icon">
                                    <i class="fas" :class="{ 'fa-eye-slash': showPassword, 'fa-eye': !showPassword }"></i>
                                </span>
                            </button>
                        </div>

                        <p v-if="errors.password" class="my-1 text-red-500"> {{ errors.password[0] }}</p>
                       

                        <input type="password" placeholder="Password"
                             class="py-2  px-4 text-gray-800 w-full border-2 
                                focus:border-gray-200 focus:outline-none"
                                :class="{'border-1 border-red-500':errors.password_confirmation}"
                                v-model="user.password_confirmation">

                        <p v-if="errors.password_confirmation" class="text-red-500 ">
                            {{ errors.password_confirmation[0] }}
                        </p>
                        <input type="checkbox" class="mx-4"
                            :class="{'border-1 border-red-600':errors.checked}" 
                            v-model="user.checked">

                        <p v-if="errors.checked" class="text-red-500 ">
                            {{ errors.checked[0] }}
                        </p>  
                             
                            I agree to the terms and condition.

                        <button type="submit" class="my-4 px-4 py-2 uppercase text-center bg-blue-800 w-full text-white transition duration-300 hover:bg-blue-600">
                             Create An Accoutn  
                        </button>
                    </form>
                    <div class="py-4">
                        Already have an account ?
                        <router-link to="/login" class="text-blue-800"> Log in instead </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    data(){
        return{
            user:{checked:null},
            errors:{},
            showPassword: false,
        }
    },
    methods: {
        passwordShow() {
            this.showPassword = !this.showPassword;
        },
        registerAccount(){
            let url = '/register';
            axios.post(url, this.user)
            .then(res => {
                this.$router.push('/');
            })
            .catch(error =>{  
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>