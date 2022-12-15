<template>
    <div class="w-full">
        <div class="my-10">
            <Notification  :notification="notification" v-if="notification.message" /> 
            <div class="flex flex-col md:flex-row items-center justify-between">
                <button @click="modalCreate" class="px-4 py-1 text-white bg-blue-800 border-2 border-white transiton duration-300 capitalize hover:border-blue-800 hover:bg-transparent hover:text-blue-800 rounded-md"> create new</button>
            </div>
        </div>
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                           coupon Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                           coupon discount %
                        </th>
                        <th scope="col" class="py-3 px-6">
                           is active
                        </th>
                        <th scope="col" class="py-3 px-6 bg-gray-50 dark:bg-gray-800">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="coupon in coupons" :key="coupon.id" class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ coupon.coupon_name }}
                        </th>
                        <td class="py-4 px-6">
                            {{ coupon.discount }}
                        </td>
                        <td class="py-4 px-6">
                            <button @click="couponActiviyChange(coupon.id,coupon.is_active)" class="bg-green-800 text-white px-2 py-1 capitalize transition duration-300 hover:bg-red-500"
                            :class="{'bg-red-500':coupon.is_active=='unactive'}"> 
                                {{ coupon.is_active=='active'?'active':'unactive' }}
                            </button>
                        </td>
                        <td class="py-4 px-6 bg-gray-50 dark:bg-gray-800">
                            <button @click="editModal(coupon)" class="py-1 px-2 bg-orange-500 text-white mr-4">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button> 
                            <button @click="deleteCoupon(coupon.id,coupon.coupon_name)" class="py-1 px-2 bg-red-700 text-white mr-4"> 
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- more button  -->
        <div @click="loadMore">
            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                {{ couponsCount }}
            </div>
            <div v-if="length <= couponsLength" class="flex justify-center my-4">
                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                transition duration-300 hover:bg-indigo-600">
                    {{ btnMessage }}
                    <i class="fa-solid fa-repeat ml-1"></i>
                </button>
            </div>
        </div>

        <!-- modal -->
        <div v-if="modal" class="fixed z-50 top-0 left-0 bg-gray-500/60 w-full h-screen">
            <div class="flex flex-col items-center justify-center h-full">
                <div class="w-96 px-4 bg-white py-8 ">
                    <button @click='modal=!modal' class="w-full text-right block">
                        <i class="fa-solid fa-xmark border-gray-400 border-2 py-3 px-4  rounded-full transition duration hover:text-white hover:bg-black"></i>
                    </button>
                    <form @submit.prevent="formCreate ?createCoupon() : updateCoupon()" enctype="multipart/form-data">
                
                        <div class="flex w-full">
                            <div class="flex flex-col w-full">
                                <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> Uniqe coupon Name </label>
                                <input type="text" placeholder="coupon Name"
                                :class="{'border-1 border-red-500':errors.coupon_name}"
                                class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" v-model="coupon.coupon_name">

                                <p v-if="errors.coupon_name" class="text-red-500"> {{ errors.coupon_name[0] }} </p>
                            </div>
                        </div>

                        <div class="flex w-full">
                            <div class="flex flex-col w-full">
                                <label for="name" class="my-2 mx-4 text-gray-500 font-semibold"> coupon discount % </label>
                                <input type="text" placeholder="coupon Name"
                                :class="{'border-1 border-red-500':errors.discount}"
                                class="my-2 px-4 py-2 border-2 focus:outline-none
                                    focus:border-gray-300" v-model="coupon.discount">

                                <p v-if="errors.discount" class="text-red-500"> {{ errors.discount[0] }} </p>
                            </div>
                        </div>
    
                        <div class="flex justify-center">
                            <button type="submit" class="text-center my-4 px-4 py-2 uppercase trasition
                                duration-300 text-center text-blue-800 border-2 border-blue-800
                                hover:text-green-800 hover:border-green-800"> 
                                {{ formCreate ? 'create coupon ' : 'update coupon' }}
                            </button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import Notification from '../NotificationAdmin.vue';
export default{
    components:{Notification},
    data(){
        return{
            modal:false,
            coupons:[],
            couponsCount:'',
            length:5,
            allcoupons: [],
            couponsLength:'',
            btnMessage:"load more",
            
            // form data 
            coupon:{}, 
            errors:{},
            formCreate:true,

            notification:{
                type:'',
                message:"",
                deleteId:'',
            },
        }
    },
    methods: {
        modalCreate(){
            this.errors = this.errors ? '': this.errors;
            this.coupon = {},
            this.modal = !this.modal;
            this.formCreate = true;
        },
        loadMore:function(){
            this.btnMessage = 'looding...'
            this.length += 5;
            this.coupons = this.allcoupons.slice(0, this.length);
            this.btnMessage = 'load more'
        },
        
        createCoupon(){
            axios.post('/admin/coupon',this.coupon)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'coupon has been Created SuccessFully';
                this.reloadCoupon();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        editModal(coupon){
            this.errors = this.errors ? '': this.errors;
            this.modal = !this.modal;
            this.formCreate = false;
            this.coupon = coupon;
        },
        updateCoupon(){
            axios.put('/admin/coupon/' + this.coupon.id,this.coupon)
            .then(response => {
                
                this.notification.type = 'edit',
                this.notification.message = 'coupon has been updated SuccessFully';
                this.reloadCoupon();
                this.modal = !this.modal;
            
            }).catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        couponActiviyChange(id,couponActiviy){
            axios.put('/admin/coupon/activity/change/'+id,{
                is_active: couponActiviy=='active'?'unactive':'active',
            })

            .then(res =>{
                this.notification.type="success";
                this.notification.message = 'Successfully change Publish Date';
                this.reloadCoupon();
            })
        },
        reloadCoupon(){
            axios.get('/admin/coupon')
            .then(res =>{
                this.allcoupons = res.data['coupons'];
                this.coupons = this.allcoupons.slice(0, this.length);
                this.couponsCount = res.data['couponsCount'];
                this.couponsLength = res.data['coupons'].length;
            });
        },
        deleteCoupon(id,name){
            this.notification.type ='force';
            this.notification.message = `Do you want to delete ${name} brad  ?`;
            this.notification.deleteId = id;
        },
                
    },
    created(){
        axios.get('/admin/coupon')
        .then(res =>{
            this.allcoupons = res.data['coupons'];
            this.coupons = this.allcoupons.slice(0, this.length);
            this.couponsCount = res.data['couponsCount'];
            this.couponsLength = res.data['coupons'].length;
        });
    },
}
</script>