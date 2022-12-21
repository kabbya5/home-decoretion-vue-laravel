<template>
    <div  class="notification-box fixed top-0 z-50">
        <div>
            <div class="flex flex-col gap-4 p-4">
                <div v-if="notification.type" role="alert" :class="type"
                    class="relative block md:w-[700px] text-base font-regular px-4 py-4 rounded-lg text-white" style="opacity: 1;">
                    <div class=" mr-12"> 
                        {{ message }}
                    </div>
                    <div class="absolute top-3 right-3 w-max rounded-lghover:bg-white hover:bg-opacity-20 transition-all">
                        <div v-if="type=='bg-orange-500'"   role="button" class="w-full rounded-lg">
                            <i @click="restoreParent(notification.deleteId)" class="fa-solid fa-rotate-left text-xl mr-2 hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                            <i @click="hideNotification" class="ml-4 fa-solid fa-xmark text-xl hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                        </div>
                        <div v-else-if="type=='bg-red-500'" @click="hideNotification"  role="button" class="w-full rounded-lg">
                            <i @click=forceDeleteParent(notification.deleteId) class="fa-solid fa-trash mr-2 hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                            <i @click="hideNotification" class="ml-4 fa-solid fa-xmark text-xl hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                        </div>
                        <div v-else @click="hideNotification"  role="button" class="w-max py-1 px-2 rounded-lg">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </div>    
                    </div>
                </div>
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
        if(this.notification.type == 'force'){
            this.type = 'bg-red-500'
        }
        else if(this.notification.type == 'delete'){
            this.type = 'bg-orange-500'
        }
        else if(this.notification.type=='edit'){
            this.type = 'bg-blue-500';
            this.success = true;
        }
        else if(this.notification.type == 'success'){
            this.type = 'bg-green-500';
        }
        else if(this.notification.type == 'errors'){
            this.type = 'bg-red-800';
        }
        
    },
    methods:{
        hideNotification: function(){
            this.notification.type = '';
            this.type = '';
            this.notification.message = '';
        },

        restoreParent(id){
            this.$parent.restore(id);
            this.hideNotification();
        },
        forceDeleteParent(id){
            this.$parent.forceDelete(id);
            this.hideNotification();
        }
    },
}
</script>