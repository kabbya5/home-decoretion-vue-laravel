<template>
    <div>
        <div class="flex flex-row items-center justify-between">
            <div class="flex flex-row my-10">
                <button @click="getUsers('allUsers')" class="mx-2 px-4 py-1 uppercase border-2 border-blue-800
                    transition duration-300 hover:bg-blue-800 hover:text-white"
                    :class="{'bg-blue-800 text-white':usersStatus=='allUsers'}">
                    users 
                </button>
                <button @click="getUsers('unverified')" class="mx-2 px-4 py-1 mx-4 uppercase border-2 border-red-800
                    transition duration-300 hover:bg-red-800 hover:text-white"
                    :class="{'bg-red-800 text-white':usersStatus=='unverified'}">
                        Unverified Users
                </button>
    
            </div>
            <div class="my-10 serceh-box flex justify-between items-center">
                <h2 v-if="searchUsersCount" class="text-gray-600 text-lg capitalize ml-3"> {{ searchUsersCount}}  </h2>
                <div class="flex px-4">
                    <input type="search" placeholder="Search heare..."  @keyup="searchUsers"
                    class="px-2 h-10 border-2 border-gray-200 w-full md:w-96 focus:outline-none">
                    <i class="fa-solid fa-magnifying-glass text-2xl -ml-8 mt-1 text-gray-600"></i>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            #id
                        </th>
                        <th scope="col" class="py-3 px-6">
                            user name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            email
                        </th>
                        <th scope="col" class="py-3 px-6">
                          user type
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            create date
                        </th>
                        
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user , index) in showUsers" :key="user.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            #{{index +1}}
                        </th>
                        <td  class="py-4 px-6">
                            {{ user.user_name }}
                        </td> 
                        <td class="py-4 px-6">
                            {{ user.email }}
                        </td>
                        <td class="py-4 px-6">
                            <button :id="user.is_admin" class="text-white px-2 py-1 rounded-md bg-green-800 w-full capitalize">
                                {{ user.is_admin ==1 ?'admin' : 'user'}}
                            </button>
                            
                        </td>
                         
                        <td class="py-4 px-6">
                            {{ user.created_date }}
                        </td>

                        <td class="py-4 px-6">
                            <router-link :to="{name:'adminUserDetails',params:{slug:user.slug}}" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-eye"></i>
                            </router-link> 

                            <button v-if="usersStatus =='unverified'" @click="deleteUsers(user.id,)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- more button  -->

        <div v-if="allUsersLength > showUsersLength" @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ allUsersLength - showUsersLength }} more orders
            </div>
            <div  class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <NotificationVue v-if="notification.message" :notification="notification" />
    </div>
</template>

<script>

import NotificationVue from '../NotificationAdmin.vue';
export default{
    components:[NotificationVue],
    data(){
        return {
            usersStatus:'allUsers',
            showUsers:{},
            allUsers: [],
            allUsersLength:'',
            showUsersLength:10,
            btnMessage:"load more",
            searchUsersCount:'',

            notification:{
                type:'',
                message:"",
                deleteId:'',
            },
        }
    },
    methods:{

        loadMore:function(){
            this.btnMessage = 'looding...'
            this.showUsersLength += 5;
            this.showUsers = this.allUsers.slice(0, this.showUsersLength);
            this.btnMessage = 'load more'
        },

        getUsers(status){
            this.usersStatus = status;
            axios.get('/admin/users/'+ status)
            .then( res => {
                this.allUsers = res.data;
                this.showUsers = res.data.slice(0, this.showUsersLength);
                this.allUsersLength = res.data.length;
            })
        },
        
        deleteUsers(id,name){
            axios.delete('/admin/user/delete/' + id)
            .then(res => {
                this.showUsers = this.allUsers.filter(user => user.id !== id);
            });
        },

        searchUsers(e){
            let searchText = e.target.value.toLowerCase();
            
            this.showUsers = this.allUsers.filter(
                user => user.user_name.toLowerCase().includes(searchText)
            );

            let count = this.showUsers.length;

            this.searchUsersCount = count > 1 ? count + ' Users' : count + "  User";
        },
    },
    created(){
        axios.get('/admin/users/' + 'allUsers')
        .then(res =>{
            this.allUsers = res.data;
            this.showUsers = res.data.slice(0, this.showUsersLength);
            this.allUsersLength = res.data.length;
        });
    }
}
</script>
<style scoped>
    button#admin{
        background-color: rgb(142, 11, 11);
        color:white;
        font-size: 16px;
        font-weight: 500;
    }
</style>