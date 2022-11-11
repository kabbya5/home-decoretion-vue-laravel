<template>
    <div  class="notification-box">
        <div>
            <div class="flex flex-col gap-4 p-4">
                <div v-if="notification.type" role="alert" :class="type"
                    class="relative block md:w-[700px] text-base font-regular px-4 py-4 rounded-lg text-white" style="opacity: 1;">
                    <div class=" mr-12"> 
                        {{ message }}
                    </div>
                    <div class="absolute top-3 right-3 w-max rounded-lghover:bg-white hover:bg-opacity-20 transition-all">
                        <div v-if="type=='bg-red-500'"   role="button" class="w-full rounded-lg">
                            <i @click="restoreSubCat(notification.deleteId)" class="fa-solid fa-rotate-left text-xl mr-2 hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                            <i @click="hideNotification" class="ml-4 fa-solid fa-xmark text-xl hover:bg-white hover:bg-opacity-20 transition-all py-1 px-2 rounded-lg"></i>
                        </div>
                        <div v-else-if="type=='bg-orange-500'" @click="hideNotification"  role="button" class="w-max py-1 px-2 rounded-lg">
                            <i class="fa-solid fa-trash"></i>
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
    props:['notification','restoreCatgory'],
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
        else if(this.notification.type == 'success'){
            this.type = 'bg-green-500';
        }else if(this.notification.type == 'delete'){
            this.type = 'bg-red-500'
        }else if(this.notification.type == 'force'){
            this.type = 'bg-orange-500'
        }
    },
    methods:{
        hideNotification: function(){
            this.notification.type = '';
            this.type = '';
            this.mmessage='';
            this.notification.message = '';
        },
        restoreSubCat(id){
            
            axios.delete('/api/admin/subcategory/restore/'+id)
            .then(res=>{
                this.type = 'bg-green-500';
                this.message = 'The category has been restored !';
                this.restoreCatgory();
            });
           
        }

    }
}
</script>