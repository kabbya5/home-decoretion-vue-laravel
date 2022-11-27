<template>
    <div>
        <div class="text-center my-10 text-gray-700 font-bold text-xl"> Site Setting </div>

        <form @submit="formCreate?createSiteSetting():updateSiteSetting()">  
            <div class="grid grid-cols-2 gap-4">
                <div class="col-sapn-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Page Title </label>

                        <input type="text" v-model="siteSetting.page_title" placeholder="Page Title"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.page_title}">

                        <p v-if="errors.page_title" class="text-red-500"> {{errors.page_title[0] }}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Searchable Seo Tag </label>

                        <textarea v-model="siteSetting.seo_tag" id="" cols="30" rows="10"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        >
                        </textarea>     
                    </div>
                </div>    
                <div class="col-span-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Title Icon </label>
                        <div class="flex item-center">
                            <input type="file"  placeholder="Page Title" @change="onFileChange" name="title_image"
                            class="px-2 py-2 w-full border-2 border-gray-200 focus:outline-none">
                            <img v-if="siteSetting.title_image" :src="siteSetting.title_image" alt="" class="w-12 h-12 rounded-full mx-2">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Page Share Image  </label>
                        <div class="flex item-center">
                            <input type="file"  placeholder="Page Title" @change="onFileChange" name="shere_image"
                            class="px-2 py-2 w-full border-2 border-gray-200 focus:outline-none">
                            <img v-if="siteSetting.shere_image" :src="siteSetting.shere_image" alt="" class="w-12 h-12 rounded-full mx-2">
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex flex-col my-4">
                        <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                            terms and condition 
                            <i class="fa-regular fa-star text-orange-500"></i>
                            </label>
                            <QuillEditor v-model:content="treanAndConditon" contentType="html" toolbar="full" />
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex flex-col my-4">
                        <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                            Return Policy 
                            <i class="fa-regular fa-star text-orange-500"></i>
                            </label>
                            <QuillEditor v-model:content="returnPolicy" contentType="html" toolbar="full" />
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <button class="px-4 py-1 uppercase bg-green-600 text-white rounded-md transition duration-300 hover:bg-green-800">
                    {{ formCreate ? 'Create Site Setting' : 'Update site Setting'}}
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import Notification from '../NotificationAdmi.vue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, defineComponent } from 'vue'
import { QuillEditor, Delta } from '@vueup/vue-quill'
export default{
    components: {
    QuillEditor,Notification,
  },
    setup: () => {
        const contentDelta = ref<Delta>(
        new Delta([
                { insert: 'Gandalf', attributes: { bold: true } },
                { insert: ' the ' },
                { insert: 'Grey', attributes: { color: '#ccc' } },
            ])
        )
        const treanAndConditon = ref('<h1> Tream and Condition </h1>')
        const returnPolicy = ref('<h2> Return Policy </h2>')
        return { contentDelta, treanAndConditon, returnPolicy}
    },
    data (){
        return{
            formCreate:true,
            siteSetting:{
                seo_tag:'example, tag, second-tag, this coma is needed'
            },
            errors:{},
        }
    },
    methods:{
        onFileChange(e) {
            let name = e.target.getAttribute('name');
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0],name);
        },
        createImage(file,name) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.siteSetting[name] = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    }
}
</script>