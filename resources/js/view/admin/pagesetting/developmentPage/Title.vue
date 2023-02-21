<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="text-center my-10 text-gray-700 font-bold text-xl"> Page Title and Background </div>

        <form @submit.prevent="formCreate?createDevelopmentPage():updateDevelopmentPage()">  
            <div class="grid grid-cols-1 gap-4">
                <div class="col-sapn-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Page Name </label>
                        <input type="text" v-model="developmentPage.page_name" placeholder="Page Name"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.page_name}">
                        <p v-if="errors.page_name" class="text-red-500"> {{errors.page_name }}</p>
                    </div>
                </div>    
                <div class="col-span-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Background Logo </label>
                        <div class="flex item-center">
                            <input type="file"  placeholder="Page Title" @change="onFileChange" name="background_image"
                            class="px-2 py-2 w-full border-2 border-gray-200 focus:outline-none">
                            <img  :src="developmentPage.background_image ? developmentPage.background_image : developmentPage.old_background_image" alt="" class="w-12 h-12 rounded-full mx-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex my-10 justify-center">
                <button class="px-4 py-2 uppercase bg-green-600 text-white rounded-md transition duration-300 hover:bg-green-800">
                    {{ formCreate ? 'Create Page Name' : 'Update Page Name'}}
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import Notification from '../../NotificationAdmin.vue';

export default{
    components: {Notification,},
    data (){
        return{
            formCreate:true,
            developmentPage:{
                id:'',
                page_name:'',
                              
            },
            errors:{},

            notification:{
                type:'',
                message:'',
            }
        }
    },
    
    methods:{
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.developmentPage.background_image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        createDevelopmentPage(){
            axios.post('/admin/development/page/title/create',{
              page_name:this.developmentPage.page_name,
              background_image: this.developmentPage.background_image,
            })
            .then(res =>{
                this.notification.type ='success',
                this.notification.message = " The Page Title has been created successfully";
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        updateDevelopmentPage(){
            axios.put('/admin/development/page/title/update/'+ this.developmentPage.id,{
                page_name:this.developmentPage.page_name,
                background_image: this.developmentPage.background_image,
                old_background_image: this.developmentPage.old_background_image,
            })
            .then(res =>{
                this.notification.type ='success',
                this.notification.message = " The site Setting has been updated successfully";
            })
        },
    },
    mounted(){
        axios.get('/admin/development/page/title/index')
        .then(res =>{
            this.formCreate = false;
            this.developmentPage.id = res.data.id;
            this.developmentPage.page_name = res.data.page_name
            this.developmentPage.old_background_image = res.data.background_image;
        })
         
    }
}
</script>