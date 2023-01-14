<!-- <template>
    <div>
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
                        <img :src="img" :alt="userProfile.slug">
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
                        <label for="email" class="my-2 text-gary-600 font-semiblod capitalize"> E-Mail </label>
                        <input type="text" v-model="userProfile.email"
                        class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                        :class="{'border-red-500':errors.email}">

                        <p class="text-red-500" v-if="errors.email"> {{errors.email[0]}}</p>
                    </div>
                </div>
                 
                <button type="submit" class="my-4 px-4 py-2 bg-blue-700 text-white"> Update Account </button>
                <button @click="logout" class="my-4 mx-6 px-4 py-2 bg-red-500 text-white"> Logout </button>
            </form>
        </div>
        <div class="mt-10">
            <h2 class="text-gary-600 font-semiblod capitalize text-center text-xl"> Change Password </h2>
            <form @submit.prevent="updateUserAccountPassword()" class="my-10 w-full md:w-[500px] mx-auto">
                <div class="flex flex-col w-full">
                    <label for="email" class="my-2 text-gary-600 font-semiblod capitalize"> E-Mail </label>
                    <input type="text" v-model="userProfile.email"
                    class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                    :class="{'border-red-500':errors.email}">

                    <p class="text-red-500" v-if="errors.email"> {{errors.email[0]}}</p>
                </div>
                <div class="flex flex-col w-full">
                    <label for="email" class="my-2 text-gary-600 font-semiblod capitalize"> E-Mail </label>
                    <input type="text" v-model="userProfile.email"
                    class="w-full border-2 border-gray-200 py-2 px-3 focus:outline-none"
                    :class="{'border-red-500':errors.email}">

                    <p class="text-red-500" v-if="errors.email"> {{errors.email[0]}}</p>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                userProfile:{},
                errors:{},
            }
        }
    }
</script> -->