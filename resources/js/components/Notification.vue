<template>
    <div  class="notification-box">
        <div>
            <div class="flex flex-col gap-4 p-4">
                <div v-if="notification.type" role="alert" :class="type"
                    class="relative block w-full text-base font-regular px-4 py-4 rounded-lg text-white" style="opacity: 1;">
                    <div class=" mr-12"> 
                        {{ message }}
                    </div>
                    <div class="absolute top-3 right-3 w-max rounded-lg hover:bg-white hover:bg-opacity-20 transition-all">
                        <div @click="hideNotification"  role="button" class="w-max py-1 px-2 rounded-lg">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </div>
                    </div>
                </div>

                <div v-if="dangerType" role="alert" class="relative block w-full text-base font-regular px-4 py-4 rounded-lg bg-orange-500 text-white" style="opacity: 1;">
                    <div class=" mr-12">A simple orange alert with an 
                        <a href="#">example link

                        </a>. Give it a click if you like.
                    </div>
                    <div class="absolute top-3 right-3 w-max rounded-lg hover:bg-white hover:bg-opacity-20 transition-all">
                        <div role="button" class="w-max p-1 rounded-lg">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </div>
                    </div>
                </div>
                <!-- <div v-if="danger" role="alert" class="relative block w-full text-base font-regular px-4 py-4 rounded-lg bg-red-500 text-white" style="opacity: 1;">
                    <div class=" mr-12">A simple red alert with an 
                        <a href="#">example link</a>. Give it a click if you like.
                    </div>
                    <div class="absolute top-3 right-3 w-max rounded-lg hover:bg-white hover:bg-opacity-20 transition-all">
                        <div role="button" class="w-max p-1 rounded-lg">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>  
</template>

<script>
export default{
    props:['notification'],
    data(){
        return {
            message:'',
            type:'',
        }
    },
    created(){
        this.message = this.notification.message;
        if(this.notification.type=='primary'){
            this.type = 'bg-blue-500';
            this.success = true;
        }
        if(this.notification.type == 'success'){
            this.type = 'bg-green-500';
        }
    },
    methods:{
        hideNotification: function(){
            this.notification.type = '';
        }
    }
}
</script>