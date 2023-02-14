<template>
    <div>
        <Notification  :notification="notification" v-if="notification.message" /> 
        <div class="text-center my-10 text-gray-700 font-bold text-xl"> Site Setting </div>

        <form @submit.prevent="formCreate?createSiteSetting():updateSiteSetting()">  
            <div class="grid grid-cols-2 gap-4">
                <div class="col-sapn-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Page Title </label>

                        <input type="text" v-model="siteSetting.page_title" placeholder="Page Title"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.page_title}">

                        <p v-if="errors.page_title" class="text-red-500"> {{errors.page_title }}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="company_name" class="px-1 my-2 text-gray-600 font-semibold"> Company Name </label>

                        <input type="text" v-model="siteSetting.company_name" placeholder="Company Name"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.company_name}">

                        <p v-if="errors.company_name" class="text-red-500 px-2"> {{errors.company_name}}</p>
                    </div>

                    <div class="flex flex-col">
                        <label for="company_phone" class="px-1 my-2 text-gray-600 font-semibold"> Company Phone </label>

                        <input type="text" v-model="siteSetting.company_phone" placeholder="Company Phone"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.company_phone}">

                        <p v-if="errors.company_phone" class="text-red-500 px-2"> {{errors.company_phone}}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="phone_number_2" class="px-1 my-2 text-gray-600 font-semibold"> Phone Number 2 </label>

                        <input type="text" v-model="siteSetting.company_phone_2" placeholder="Phone Number 2"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.company_phone_2}">

                        <p v-if="errors.company_phone_2" class="text-red-500 px-2"> {{errors.company_phone_2}}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="company_email" class="px-1 my-2 text-gray-600 font-semibold"> Company Email </label>

                        <input type="text" v-model="siteSetting.company_email" placeholder="Company Email"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.company_email}">

                        <p v-if="errors.company_email" class="text-red-500 px-2"> {{errors.company_email}}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="company_email_2" class="px-1 my-2 text-gray-600 font-semibold"> Company Email 2</label>

                        <input type="text" v-model="siteSetting.company_email_2" placeholder="Company Email 2"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.company_email_2}">

                        <p v-if="errors.company_email_2" class="text-red-500 px-2"> {{errors.company_email_2}}</p>
                    </div>
                    <div class="flex flex-col">
                        <label for="advance_payment_limit" class="px-1 my-2 text-gray-600 font-semibold"> advance payment limit</label>

                        <input type="text" v-model="siteSetting.advance_payment_limit" placeholder="advance payment limit"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        :class="{'border-red-500':errors.advance_payment_limit}">

                        <p v-if="errors.advance_payment_limit" class="text-red-500 px-2"> {{errors.advance_payment_limit}}</p>
                    </div>
                    <div class="flex flex-col my-2">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> advance payment limit message </label>

                        <textarea v-model="siteSetting.advance_payment_limit_message" cols="30" rows="6"
                        class="my-4 px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        >
                        
                        </textarea>     
                    </div>
                </div>    
                <div class="col-span-2 lg:col-span-1">
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Title Logo </label>
                        <div class="flex item-center">
                            <input type="file"  placeholder="Page Title" @change="onFileChange" name="title_image"
                            class="px-2 py-2 w-full border-2 border-gray-200 focus:outline-none">
                            <img  :src="siteSetting.title_image?siteSetting.title_image:'/'+siteSetting.old_title_image" alt="" class="w-12 h-12 rounded-full mx-2">
                            <input type="hidden" v-model="siteSetting.old_title_image" class="hidden">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Page Share Image  </label>
                        <div class="flex item-center">
                            <input type="file"  placeholder="Page Title" @change="onFileChange" name="share_image"
                            class="px-2 py-2 w-full border-2 border-gray-200 focus:outline-none">
                            <img  :src="siteSetting.share_image?siteSetting.share_image:'/'+siteSetting.old_share_image" alt="" class="w-12 h-12 rounded-full mx-2">
                            <input type="hidden" v-model="siteSetting.old_share_image">
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Searchable Seo Tag </label>

                        <textarea v-model="siteSetting.seo_tag" id="" cols="30" rows="4"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        >
                        </textarea>     
                    </div>
                    <div class="flex flex-col">
                        <label for="titel" class="px-1 my-2 text-gray-600 font-semibold"> Searchable paragrap 10 line</label>

                        <textarea v-model="siteSetting.seo_content" id="" cols="30" rows="6"
                        class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                        >
                        </textarea>     
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
                    <div v-if="!createForm" class="w-full">
                        <div class="ql-snow">
                            <p class="ql-editor" v-html="treanAndConditon"></p>
                        </div>
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
                    <div v-if="!createForm" class="w-full">
                        <div class="ql-snow">
                            <p class="ql-editor" v-html="returnPolicy"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex my-10 justify-center">
                <button class="px-4 py-2 uppercase bg-green-600 text-white rounded-md transition duration-300 hover:bg-green-800">
                    {{ formCreate ? 'Create Site Setting' : 'Update site Setting'}}
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import Notification from '../NotificationAdmin.vue';
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
        let treanAndConditon = ref('<h1> Tream and Condition </h1>')
        let returnPolicy = ref('<h2> Return Policy </h2>')
        return { contentDelta, treanAndConditon, returnPolicy}
    },
    data (){
        return{
            formCreate:false,
            siteSetting:{
                seo_tag:'example, tag, second-tag, this coma is needed'
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
        createSiteSetting(){
            axios.post('/admin/site/setting/create',{
              page_title:this.siteSetting.page_title,
              company_name: this.siteSetting.company_name,
              company_phone: this.siteSetting.company_phone,
              company_phone_2: this.siteSetting.company_phone_2,
              company_email: this.siteSetting.company_email,
              company_email_2: this.siteSetting.company_email_2,
              seo_tag : this.siteSetting.seo_tag,
              title_image: this.siteSetting.title_image,
              share_image: this.siteSetting.share_image, 
              seo_content :this.siteSetting.seo_content,
              trean_and_conditon : this.treanAndConditon,
              return_policy : this.returnPolicy,
              advance_payment_limit_message: this.siteSetting.advance_payment_limit_message,
              advance_payment_limit: this.siteSetting.advance_payment_limit,
            })
            .then(res =>{
                this.notification.type ='success',
                this.notification.message = " The site Setting has been created successfully";
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        updateSiteSetting(){
            axios.put('/admin/site/setting/update/'+ this.siteSetting.id,{
                page_title:this.siteSetting.page_title,
                company_name: this.siteSetting.company_name,
                company_phone: this.siteSetting.company_phone,
                company_phone_2: this.siteSetting.company_phone_2,
                company_email: this.siteSetting.company_email,
                company_email_2: this.siteSetting.company_email_2,
                seo_tag : this.siteSetting.seo_tag,
                title_image: this.siteSetting.title_image,
                old_title_image: this.siteSetting.old_title_image,
                share_image: this.siteSetting.share_image, 
                old_share_image :this.siteSetting.old_share_image,
                seo_content :this.siteSetting.seo_content,
                trean_and_conditon : this.treanAndConditon,
                return_policy : this.returnPolicy,
                advance_payment_limit_message: this.siteSetting.advance_payment_limit_message,
                advance_payment_limit: this.siteSetting.advance_payment_limit,
            })
            .then(res =>{
                this.notification.type ='success',
                this.notification.message = " The site Setting has been updated successfully";
            })
        },
    },
    mounted(){

        axios.get('/admin/site/setting/edit')
        .then(res =>{
            let data = res.data;
            this.formCreate = false;
            this.siteSetting.id = data.id;
            this.siteSetting.page_title = data.page_title;
            this.siteSetting.company_email = data.company_email;
            this.siteSetting.company_name = data.company_name;
            this.siteSetting.company_email_2 = data.company_email_2;
            this.siteSetting.company_phone = data.company_phone;
            this.siteSetting.company_phone_2 = data.company_phone_2;
            this.siteSetting.seo_tag = data.seo_tag;
            this.siteSetting.seo_content = data.seo_content;
            this.siteSetting.old_title_image = data.title_image;
            this.siteSetting.old_share_image = data.share_image;
            this.treanAndConditon = data.trean_and_conditon;
            this.returnPolicy = data.return_policy;
            this.siteSetting.advance_payment_limit_message = data.advance_payment_limit_message;
            this.siteSetting.advance_payment_limit = data.advance_payment_limit;
        })
         
    }
}
</script>