<template>
    <div class="mx-auto w-96 px-4 py-6 border-2 border-gray-100">
        <Notification :notification="notification" v-if="notification.message" /> 
        <form @submit.prevent="createSlider" enctype="multipart/form-data">
            <div class="flex flex-col">
                <label for="sliderName" class="my-2 px-4 text-gray-500  capitalize"> slider Name </label>
                <input type="text" placeholder="Slider Name"
                    class="px-4 py-2 border-2 border-gray-200 focus:outline-none"
                    :class="{'boder-1 border-red-500':errors.sliderName}"
                    v-model="slider.sliderName">
                
                <p v-if="errors.sliderName" class="px-2 text-red-500"> {{ errors.sliderName[0] }} </p>
            </div>
            <div class="flex flex-col">
                <label for="sliderImg" class="my-2 px-4 text-gray-500  capitalize"> slider Name </label>
                <input type="file"  @change="onFileChange"
                    class="px-4 py-2 border-2 border-gray-200 focus:outline-none"
                    :class="{'boder-1 border-red-500':errors.sliderImg}">
                
                <p v-if="errors.sliderImg" class="px-2 text-red-500"> {{ errors.sliderImg[0] }} </p>
            </div>
            <div v-if="slider.sliderImg">
                <img class="w-20 h-20" v-if="slider.sliderImg" :src="slider.sliderImg" alt="">
            </div>
            <div class="my-6 flex justify-center">
                <button type="sumit" class="px-4 py-1 rounded-md text-lg transition duration-300  bg-blue-500 text-white hover:bg-blue-800"> Submit </button>
            </div>
        </form>
    </div>
</template>
<script>
import Notification from '../../../components/Notification.vue';
export default {
    components:{Notification,},
    data (){
        return{
            slider:{
                sliderName:'soemkdhi',
                sliderImg:'',
            },
            errors:{},

            notification:{
                type:'',
                message:""
            }
        }
    },
    methods:{
        createSlider(){

            axios.post('/api/admin/slider/create',
            {
                headers: {
                        'Content-Type': 'multipart/form-data'
                },
                'sliderName':this.slider.sliderName,
                'sliderImg' : this.slider.sliderImg,
            })
            .then(res=>{
                console.log(res);
                this.notification.type = 'success';
                this.notification.message = 'SuccessFully create'
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;

            })
        },

        onFileChange(e){
            let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                
            },
            createImage(file) {
                
                let reader = new FileReader();
                reader.onload = (e) => {
                   this.slider.sliderImg =  e.target.result;
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>

<style>

</style>