<template>
    <div class="my-10">
        <Notification :notification="notification" v-if="notification.message" />
        <div class="header flex justify-between items-center">
            <h4 class="text-slate-800 text-lg font-bold capitalize dorp-shadow-md">
                product form
            </h4>
            <router-link :to="{name:'adminProductIndex'}" class="px-4 py-1 bg-cyan-500 text-white rounded-lg transiton duration-300 capitalize hover:bg-cyan-600"> all products </router-link>
        </div>

        <div class="product-form my-4">
            <form @submit.prevent="createForm ?createProduct():updateProduct()">
                <div class="grid grid-cols-4 gap-4">
                    <!-- product name  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <label for="product_img" class="my-4 text-slate-500 px-4 capitalize font-semibold"> 
                                product name
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <input type="text" v-model="product.product_title" placeholder="Product Code"
                            class="py-2 px-4 border-2 border-gray-200 focus:outline-none"
                            :class="{'border-red-500 border-1':errors.product_title}">

                            <p class="text-red-500" v-if="errors.product_title">{{ errors.product_title[0] }}</p>
                        </div>
                    </div>
                    
                    <!-- product code  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <label for="product_img" class="my-4 text-slate-500 px-4 capitalize font-semibold"> 
                                product code
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <input type="text" v-model="product.product_code" placeholder="Product Code"
                            class="py-2 px-4 border-2 border-gray-200 focus:outline-none"
                            :class="{'border-red-500 border-1':errors.product_code}">

                            <p class="text-red-500" v-if="errors.product_code">{{ errors.product_code[0] }}</p>
                        </div>
                    </div>

                    <!-- price -->

                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col w-full ">
                            <label for="product_img" class="my-4 text-slate-500 px-2 capitalize font-semibold"> 
                                regular price  
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <input type="text" v-model="product.price" placeholder="regular-price"
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                            :class="{'border-red-500':errors.price}">
                            
                            <p v-if="errors.price" class="text-red-500"> {{ errors.price[0] }} </p>
                        </div>
                    </div>

                    <!-- discount price  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col w-full">
                            <label for="discount_price" class="my-4 text-slate-500 px-2 capitalize font-semibold"> discount price <span v-if="product.discount_percentence" class="ml-4 text-orange-500"> {{ product.discount_percentence }}% discount  </span>  </label>
                            <input type="text" v-model="product.discount_price" placeholder="discount price"
                            class="px-2 py-2 border-gray-200 border-2 focus:outline-none">
                        </div>
                    </div>

                    <!-- quantity -->
                    <div class="col-span-2 lg:col-span-1">  
                        <div class="flex flex-col w-full">
                            <label for="product_img" class="my-4 text-slate-500 px-2 capitalize font-semibold"> 
                                Prouduct quantity
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <input type="text" v-model="product.quantity" placeholder="quantity"
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none"
                            :class="{'border-red-500':errors.quantity}">
                            
                            <p v-if="errors.quantity" class="text-red-500"> {{ errors.quantity[0] }} </p>
                        </div>    
                    </div>

                    <!-- weight  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col w-full">
                            <label for="weight" class="my-4 text-slate-500 px-2 capitalize font-semibold"> product weight </label>
                            <input type="text" v-model="product.weight" placeholder="weight"
                            class="px-2 py-2 border-gray-200 border-2 focus:outline-none">
                        </div>
                    </div>

                    <!-- category  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div class="text-gray-500 capitalize my-4 px-1"> 
                                Select Category: 
                                <span v-if="selectItem.category" class="px-2 text-gray-500 font-bold"> {{ selectItem.category }}  </span>
                                <span v-else class="text-red-500"> <i class="fa-regular fa-star"></i></span>
                            </div>
                            <select @change="handleChange" v-model="product.category_id" class="py-2 border-2 border-gray-200 text-gray-500 focus:outline-none"
                             :class="{'border-1 border-red-500':errors.category_id}">
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id" :data-name="cat.categoryName" data-type="category"
                                >
                                    {{ cat.categoryName }}
                                </option>
                            
                            </select>
                            <p v-if="errors.category_id" class="text-red-500"> {{ errors.category_id[0] }}  </p>
                        </div>
                    </div>
                    <!-- subcategory  -->
                    <div v-if="subcategories" class="col-span-2 lg:col-span-1">
                        <div  class="flex flex-col">
                            <div v-if="(subcategories.length > 0)" class="w-full">
                                <div class="text-gray-500 capitalize my-4 px-1"> 
                                    Select subcategory: <span v-if="selectItem.subcat" class="px-2 text-gray-500 font-bold"> {{ selectItem.subcat }}  </span>
                                </div>
                                <select  @change="handleChange" v-model="product.subcategory_id" class="py-2 border-2 border-gray-200 w-full text-gray-500 focus:outline-none">
                                    <option v-for="cat in subcategories" :key="cat.id" :value="cat.id" :data-name="cat.subCatName" data-type="subcat"
                                    >
                                        {{ cat.subCatName }}
                                    </option>
                                
                                </select>
                            </div> 
                        </div>
                    </div>
                    <!-- childcategory  -->
                    <div v-if="childcategories" class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div v-if="childcategories.length > 0">
                                <div class="text-gray-500 capitalize my-4 px-1"> 
                                    Select childcategory: <span v-if="selectItem.childcat" class="px-2 text-gray-500 font-bold"> {{ selectItem.childcat }}  </span>
                                </div>
                                <select @change="handleChange" v-model="product.childcategory_id" class="py-2 w-full border-2 border-gray-200 text-gray-500 focus:outline-none">
                                    <option v-for="cat in childcategories" :key="cat.id" :value="cat.id" :data-name="cat.childCatName" data-type="childcat"
                                    >
                                        {{ cat.childCatName }}
                                    </option>
                                
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- brand  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div class="text-gray-500 capitalize my-4 px-1"> 
                                Selected brand: <span v-if="selectItem.brand" class="px-2 text-gray-500 font-bold"> {{ selectItem.brand }}  </span>
                            </div>
                            <select @change="handleChange" v-model="product.brand_id" class="py-2 border-2 border-gray-200 text-gray-500 focus:outline-none">
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id" :data-name="brand.name" data-type="brand"
                                >
                                    {{ brand.name }}
                                </option>
                            
                            </select>
                        </div>
                    </div>

                    <!-- Slider  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div class="text-gray-500 capitalize my-4 px-1"> 
                                Selected slider: <span v-if="selectItem.slider" class="px-2 text-gray-500 font-bold"> {{ selectItem.slider}}  </span>
                            </div>
                            <select @change="handleChange" v-model="product.slider_id" class="py-2 border-2 border-gray-200 text-gray-500 focus:outline-none">
                                <option v-for="slider in sliders" :key="slider.id" :value="slider.id" :data-name="slider.sliderName" data-type="slider"
                                >
                                    {{ slider.sliderName }}
                                </option>
                            
                            </select>
                        </div>
                    </div>
                    <!-- color  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div class="text-gray-500 capitalize my-4 px-1 flex justify-between">
                                <div class="flex items-center">
                                    <p class="text-slate-600 font-bold capitalzie"> select color: </p> 
                                    <i class="fa-regular fa-star mx-2 text-orange-500"></i>  
                                </div>
                                <i @click="createColor" class="fa-solid fa-plus px-4 text-cyan-500" title="create Color"></i>
                            </div>
                            <Multiselect class="w-[100%]"
                                v-model="product.colors"
                                :options="colorOptions"
                                mode="tags"
                                placeholder="product color"
                                track-by="name"
                                label="name"
                                :close-on-select="false"
                                :searchable="true"
                            >
                            </Multiselect>
                            <p v-if="errors.colors" class="text-red-500"> {{ errors.colors[0] }} </p>
                        </div>
                    </div>

                    <!-- size  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col">
                            <div class="text-gray-500 capitalize my-4 px-1 flex justify-between">
                                <div class="flex items-center">
                                    <p class="text-slate-600 font-bold capitalzie"> select size: </p> 
                                    <i class="fa-regular fa-star mx-2 text-orange-500"></i>  
                                </div>
                                <i @click="createSize" class="fa-solid fa-plus px-4 text-cyan-500" title="create size"></i>
                            </div>
                            <Multiselect class="w-[100%]"
                                v-model="product.sizes"
                                :options="sizesOption"
                                mode="tags"
                                placeholder="Select product size"
                                track-by="name"
                                label="name"
                                :close-on-select="false"
                                :searchable="true"
                            >
                            </Multiselect>
                        </div>
                    </div>

                    <!-- Publish Date  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col my-4">
                            <label for="published_at" class="px-2 font-bold text-slate-600 capitalize"> Publish Now or Sate Upcomming </label>
                            <span v-if="product.published"> {{product.published}}</span>
                            <input class="my-3 border-2 border-cyan-200 px-1 py-2 focus:ouline-none" type="date" v-model="product.published_at" />
                        </div>
                    </div>

                    <!-- Vide link  -->
                    <div class="col-span-2 lg:col-span-1">
                        <div class="flex flex-col my-4">
                            <label for="published_at" class="px-2 font-bold text-slate-600 capitalize"> Product Video Link </label>
                            <input class="my-3 border-2 border-cyan-200 px-1 py-2 focus:ouline-none" type="text"
                            placeholder="video link" v-model="product.video_link" />

                        </div>
                    </div>

                    <!-- status  -->
                    <div class="col-span-2 lg:col-span-3">
                        <div class="flex items-center justify-center my-10">
                            <div class="flex my-4 items-center">
                                <input type="checkbox" v-model="product.is_furniture" id="is_furniture" true-value="1"  false-value="0">
                                <label for="is_furniture" class="px-4 font-bold text-slate-600 capitalize"> is furniture</label>
                            </div>
    
                            <div class="flex my-4 items-center">
                                <input type="checkbox" v-model="product.free_shipping" id="free_shipping" true-value="1"  false-value="0">
                                <label for="free_shipping" class="px-4 font-bold text-slate-600 capitalize"> Free shipping </label>
                            </div>
                            <div class="flex my-4 items-center">
                                <input type="checkbox" v-model="product.top_rated" id="top_rated" true-value="1"  false-value="0">
                                <label for="top_rated" class="px-4 font-bold text-slate-600 capitalize">top rated </label>
                            </div>
                            <div class="flex my-4 items-center">
                                <input type="checkbox" v-model="product.is_weekly_sale" id="is_weekly_sale" true-value="1"  false-value="0">
                                <label for="is_weekly_sale" class="px-4 font-bold text-slate-600 capitalize">week sale </label>
                            </div>
                        </div>
                        
                    </div>

                    <!-- product image  -->
                    <div class="col-span-2">
                        <div class="flex flex-col my-2">
                            <label for="product_img" class="my-4 text-slate-500 px-4 capitalize font-semibold"> 
                                product image
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <Multiselect
                                v-model="product.imgs"
                                :options="options"
                                mode="tags"
                                placeholder="Select Image"
                                track-by="name"
                                label="name"
                                :close-on-select="false"
                                :searchable="true"
                            >
                                <template v-slot:tag="{ option, handleTagRemove, disabled }">
                                    <div
                                        class="multiselect-tag is-user"
                                        :class="{
                                            'is-disabled': disabled
                                        }"
                                        >
                                        <img class="w-20 h-20 rounded-md" :src="option.image">
                                        {{ option.name }}
                                        <span
                                            v-if="!disabled"
                                            class="multiselect-tag-remove"
                                            @click="handleTagRemove(option, $event)"
                                        >
                                            <span class="multiselect-tag-remove-icon"></span>
                                        </span>
                                    </div>
                                </template>
                            </Multiselect>
                            <p v-if="errors.images" class="text-red-500"> {{ errors.images[0] }}</p>
                        </div>
                    </div>

                    <!-- tags -->
                    <div class="col-span-2">
                        <div class="flex flex-col my-2">
                            <label for="tags" class="my-4 text-slate-500 px-2 capitalize font-semibold"> 
                                Select Tags  
                                <i class="fa-regular fa-star text-red-500"></i>
                            </label>
                            <Multiselect
                                v-model="product.tags"
                                :options="tagsOption"
                                mode="tags"
                                placeholder="Select Tags max-7"
                                track-by="name"
                                label="name"
                                :close-on-select="false"
                                :searchable="true"
                            >
                            </Multiselect>
                            <p v-if="errors.tags" class="text-red-500"> {{ errors.tags[0] }}</p>
                        </div>
                    </div>
                    <!-- product short text  -->
                    <div class="col-span-4">
                        <div>
                            <div class="flex flex-col my-4">
                                <label for="short_text" class="my-4 text-slate-500 px-4 capitalize font-semibold"> 
                                    product short text
                                    <i class="fa-regular fa-star text-red-500"></i>
                                </label>
    
                                <textarea v-model="product.short_text"  cols="30" rows="3"
                                    class="px-4 py-4 border-2 border-gray-200 focus:outline-none"
                                    :class="{'order-1 border-red-500':errors.short_text}">
    
                                </textarea>
                                
                            </div>
                            <p v-if="errors.short_text" class="text-red-500"> {{errors.short_text[0]}} </p>    
                        </div>
                    </div>

                    <!-- product description  -->
                    <div class="col-span-4">
                        <div class="flex flex-col my-4">
                            <label for="text" class="my-4 text-slate-500 px-4 capitalize font-semibold">
                                 product description 
                                 <i class="fa-regular fa-star text-orange-500"></i>
                                </label>
                                <QuillEditor v-model:content="productDetails" contentType="html" toolbar="full" >
                                    
                                </QuillEditor>
                                
                        </div>

                        <div v-if="!createForm" class="w-full">
                            <div class="ql-snow">
                                <p class="ql-editor" v-html="productDetails"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-8">
                    <div class="flex justify-center">
                        <button class="py-1 px-4 text-white bg-cyan-500 transition duration rounded-md hover:bg-cyan-800">
                            {{createForm?"create product" :"update product"}}
                        </button>
                   </div>
                </div>               
            </form>
        </div>

        <!-- Modal form size,tag,image of tag and product etc -->

        <div v-if="modal" class="modal fixed top-0 left-0 bg-gray-400/60 z-10 w-full h-screen">
            <div class="w-96 p-4 bg-white absolute md:left-[40%] my-10">
                <div class="flex justify-end">
                    <button @click="modal = !modal" class="flex items-center justify-center text-white bg-red-500  w-8 h-8 rounded-full transition duration-300 hover:bg-red-800">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div v-if="createForm==='size'" class="product-size-form">
                    <form @submit.prevent="storeSize">
                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="title" class="text-gray-500 font-semibold px-1 my-2"> Size Title : </label>
                                <i class="fa-regular fa-star text-red-500 my-2"></i>
                            </div>
                            <textarea  v-model="size.size_title"
                                class="px-2 py-1 border-2 border-gray-200 focus:outline-none"
                                :class="{'border-red-500':errors.size_title}"> 
                            </textarea>
                            <p v-if="errors.size_title" class="px-1 text-red-500"> {{errors.size_title[0]}}</p>
                        </div>
                        <div class="flex flex-col my-4">
                            <div class="flex items-center">
                                <label for="title" class="text-gray-500 font-semibold px-1 my-2"> For extra in taka(intial:0) : </label>
                                <i class="fa-regular fa-star text-red-500 my-2"></i>
                            </div>
                            <input type="text"  v-model="size.size_extra_payment" placeholder="extar payment"
                                class="px-2 py-1 border-2 border-gray-200 focus:outline-none"
                                :class="{'border-red-500':errors.size_extra_payment}"> 
                            <p v-if="errors.size_extra_payment" class="px-1 text-red-500"> {{errors.size_extra_payment[0]}}</p>
                        </div>
                        
                       <div class="flex justify-center">
                            <button class="py-1 px-4 text-white bg-cyan-500 transition duration rounded-md hover:bg-cyan-800">
                                Create Size
                            </button>
                       </div>
                    </form>
                </div>

                <div v-else-if="createForm==='color'" class="product-color-form">
                    <form @submit.prevent="storeColor">
                        <div class="flex flex-col">
                            <label for="name" class="capitalize px-2 my-2 text-gray-600"> color name </label>
                            <input type="text" v-model="color.name" :class="{'border-red-500':errors.name}" 
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Color Name">
                            <p v-if="errors.name" class="my-2 color-red-500"> {{ errors.name[0] }}</p>

                        </div>
                        <div class="flex flex-col my-4">
                            <label for="color Code" class="capitalize px-2 my-2 text-gray-600"> color code </label>
                            <input type="text" v-model="color.colorCode" 
                            class="px-2 py-2 border-2 border-gray-200 focus:outline-none" placeholder="Color Name">    
                        </div>

                        <button class="px-4 py-1 uppercase text-white bg-blue-800 transition duration-300 rounded-md hover:bg-blue-600">
                             Create Color
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Notification from '../../NotificationAdmin.vue';
import Multiselect from '@vueform/multiselect';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, defineComponent } from 'vue'
import { QuillEditor, Delta } from '@vueup/vue-quill'
export default ({
    components: {
    Multiselect, QuillEditor,Notification,
  },
  data(){
        return{
            product:{
                imgs:[],
                tags:[],
                sizes:[],
                colors:[],
            },
            discount_price:'',
            errors:{},
            value: null,
            options: [
                
            ],
            
            selectItem:{
            },
            
            categories:{},
            subcategories:null,
            childcategories:null,
            brands:{},
            sliders:{},
            sizesOption:[],
            tagsOption:[],
            colorOptions:[],

            // form section 

            createForm:true,
            productDetailsUpdate:'',
            modal:false,
            size:{
                size_title:'size title',
                size_extra_payment:'',
            },
            color:{},

            notification:{
                type:'',
                message:'',
            },
        }
    },
    setup: () => {
        const contentDelta = ref<Delta>(
        new Delta([
                { insert: 'Gandalf', attributes: { bold: true } },
                { insert: ' the ' },
                { insert: 'Grey', attributes: { color: '#ccc' } },
            ])
        )
        const productDetails = ref()
        return { contentDelta, productDetails}
    },
    methods:{
        createProduct(){
            axios.post('/admin/product/store',{
                product_title : this.product.product_title,
                product_code:this.product.product_code,
                category_id: this.product.category_id,
                subcategory_id: this.product.subcategory_id,
                childcategory_id : this.product.childcategory_id,
                brand_id :this.product.brand_id,
                slider_id : this.product.slider_id,
                price : this.product.price,
                discount_price :this.product.discount_price,
                short_text: this.product.short_text,
                description: this.productDetails,
                quantity: this.product.quantity,
                weight: this.product.weight,
                free_shipping: this.product.free_shipping,
                is_weekly_sale: this.product.is_weekly_sale,
                top_rated: this.product.top_rated,
                tax: this.product.tax,
                published_at : this.product.published_at,
                tags: this.product.tags,
                images: this.product.imgs,
                sizes:this.product.sizes,
                colors:this.product.colors,
                is_furniture:this.product.is_furniture,
                'video_link': this.product.video_link,

            })
            .then(res=>{
                this.notification.type = 'success';
                this.notification.message = 'The product has been created successfully';
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },

        updateProduct(){
            axios.put('/admin/product/update/'+this.$route.params.slug,{
                product_title : this.product.product_title,
                product_code:this.product.product_code,
                category_id: this.product.category_id,
                subcategory_id: this.product.subcategory_id,
                childcategory_id : this.product.childcategory_id,
                brand_id :this.product.brand_id,
                slider_id : this.product.slider_id,
                price : this.product.price,
                discount_price :this.product.discount_price,
                short_text: this.product.short_text,
                description: this.productDetails,
                quantity: this.product.quantity,
                weight: this.product.weight,
                free_shipping: this.product.free_shipping,
                is_weekly_sale: this.product.is_weekly_sale,
                top_rated: this.product.top_rated,
                published_at : this.product.published_at,
                tags: this.product.tags,
                images: this.product.imgs,
                sizes:this.product.sizes,
                colors:this.product.colors,
                is_furniture:this.product.is_furniture,
                'video_link': this.product.video_link,
            })
            .then(res=>{
                this.notification.type = 'success';
                this.notification.message = 'The product has been updated';
                this.$router.push({name:'adminProductIndex'});
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        handleChange (event){
            let selectType = event.target.options[event.target.options.selectedIndex].getAttribute('data-type');
            let value = event.target.options[event.target.options.selectedIndex].getAttribute('data-name');
            Object.assign(this.selectItem,{[selectType]:value});

            if(selectType = 'category'){
                let selectCat = this.categories.filter( cat => cat.id === this.product.category_id );
                const proxy1 = new Proxy(selectCat, {});
                this.subcategories =  JSON.parse(JSON.stringify(proxy1))[0].subcategories;
            }

            if(selectType ='subcat'){
                let selectSubCat = this.subcategories.filter(subcat =>subcat.id === this.product.subcategory_id);
                const proxy2 = new Proxy(selectSubCat,{});
                this.childcategories = JSON.parse(JSON.stringify(proxy2))[0].childcategories;
            }
        },
        createSize(){
            this.size = {};
            this.modal=!this.modal;
            this.createForm = 'size';
        },
        storeSize(){
            axios.post('/admin/size/store',this.size)
            .then(res =>{
                this.errors = this.errors ? '': this.errors;
                this.modal = !this.modal;
                this.notification.type='success',
                this.notification.message = "product size has been successfully created !";
                this.reloadPage();
                this.createForm = true;
            })
            .catch(errors =>{
                this.errors = errors.response.data.errors;
            })
        },
        createColor(){
            this.modal = !this.modal;
            this.createForm = 'color';
            this.color = {};
        },
        storeColor(){
            axios.post('/admin/product/color/create',this.color)
            .then(response => {
                this.notification.type = 'success',
                this.notification.message = 'color has been Created SuccessFully';
                this.reloadPage();
                this.modal = !this.modal;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            });
        },
        updateCategory(){
            let selectCat = this.categories.filter( cat => cat.id === this.product.category_id );
            const proxy1 = new Proxy(selectCat, {});
            this.subcategories =  JSON.parse(JSON.stringify(proxy1))[0].subcategories;

            let selectSubCat = this.subcategories.filter(subcat =>subcat.id === this.product.subcategory_id);
            const proxy2 = new Proxy(selectSubCat,{});
            this.childcategories = JSON.parse(JSON.stringify(proxy2))[0].childcategories;
        },

        reloadPage(){
            axios.get('/admin/product/create')
            .then(res=>{
                this.createForm = true;
                this.categories = res.data[0];
                this.brands = res.data[1];
                this.sliders = res.data[2];
                
                let tags = res.data[3];
                
                tags.forEach(tag => {
                    this.tagsOption.push({value:tag.id,name:tag.tag_name});
                });

                this.options = [];
                let imgs = res.data[4];
                imgs.forEach(img=>{
                    this.options.push(
                         {
                            value:img.id,
                            name:img.product_img_name,
                            image:img.product_img,
                        }
                    )
                });
                this.sizesOption = [];
                let sizes = res.data[5];
                sizes.forEach(size =>{
                    this.sizesOption.push({
                        value:size.id,name:size.size_title,
                    });
                });
                this.colorOptions = [];

                let colors = res.data[6];
                colors.forEach(color =>{
                    this.colorOptions.push({
                        value:color.id,name:color.name
                    });
                })
            });  
        }
    },
    created(){

        axios.get('/admin/product/create')
        .then(res=>{
            this.createForm = true;
            this.categories = res.data[0];
            this.brands = res.data[1];
            this.sliders = res.data[2];
            
            let tags = res.data[3];
            tags.forEach(tag => {
                this.tagsOption.push({value:tag.id,name:tag.tag_name});
            });

            let imgs = res.data[4];
            imgs.forEach(img=>{
                this.options.push(
                    {
                        value:img.id,
                        name:img.product_img_name,
                        image:img.img,
                    }
                )
            });

            let sizes = res.data[5];
            sizes.forEach(size =>{
                this.sizesOption.push({
                    value:size.id,name:size.size_title + ' extra ' + size.size_extra_payment + "TK",
                });
            });

            let colors = res.data[6];
            colors.forEach(color =>{
                this.colorOptions.push({
                    value:color.id,name:color.name
                });
            });
            

        });  

        // update product 
        if(this.$route.params.slug){
            axios.get('/admin/product/edit/' + this.$route.params.slug)
            .then(res =>{
                this.createForm = false;
                this.product = res.data.product;
                this.productDetails = this.product.description;
                this.product.imgs = res.data.product_images;
                this.product.sizes = res.data.product_sizes;
                this.product.tags = res.data.product_tags;
                this.product.colors = res.data.product_colors; 
                this.updateCategory();
            })

        }
    },
    watch:{
        discount_price(value){
            this.product.discount_price=value;
            let regularPrice = this.product.price;
            let discount = regularPrice - value;
            let percentenceOfDiscount = Math.floor((discount *100)/ regularPrice);
            this.product.discount_percentence = percentenceOfDiscount;
        }
    }
})
</script>

<style src="@vueform/multiselect/themes/default.css"></style>



