<template>
    <div class="mt-[90px] md:mt-0 md:py-10  container mx-auto">
        <div class="my-4 text-center">
            <h2 class="text-gray-800 font-bold capitalize text-2xl">
                Checkout 
            </h2>

            <div class="my-6">
                <router-link :to="{name:'home'}" class="text-gray-600 font-semibold">
                    Home  /
                </router-link>
                <router-link :to="{name:'cart-content'}" class="text-gray-600 font-semibold">
                    Shopping cart
                </router-link>
            </div>
        </div>
        <div class="my-4">
            <h2 class="text-gray-900 font-bold text-sm md:text-[18px] mx-4"> Shipping Address </h2>
            <div class="my-8">
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-3 md:col-span-1">
                        <form>
                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="name" class="text-gray-600 font-semibold  capitalize"> name </label>
                                    <p class="text-red-500 font-bold ">&midast;</p>
                                </div>
                                <input type="text" v-model="shipping.name"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.name}">
                                <p v-if="errors.name" class="text-red-500"> {{errors.name[0]}}</p>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="phone" class="text-gray-600 font-semibold  capitalize"> phone </label>
                                    <p class="text-red-500 font-bold ">&midast;</p>
                                </div>
                                <input type="text" v-model="shipping.phone"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.phone}">
                                <p v-if="errors.phone" class="text-red-500"> {{errors.phone[0]}}</p>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="email" class="text-gray-600 font-semibold  capitalize"> email </label>
                                    
                                </div>
                                <input type="email" v-model="shipping.email"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.email}">
                                <p v-if="errors.email" class="text-red-500"> {{errors.email[0]}}</p>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="address" class="text-gray-600 font-semibold  capitalize"> address </label>
                                    <p class="text-red-500 font-bold ">&midast;</p>
                                </div>
                                <input type="text" v-model="shipping.address"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.address}">
                                <p v-if="errors.address" class="text-red-500"> {{errors.address[0]}}</p>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="address" class="text-gray-600 font-semibold  capitalize"> District </label>
                                    <p class="text-red-500 font-bold ">&midast;</p>
                                     <span class="text-gray-700 font-semibold capitalize  ml-4"> {{ shipping.district }} </span>
                                </div>
                                <select v-model="shipping.district"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.district}">
                                <option selected> Dhaka </option>
                                <option value="chittagong" > Chittgone </option>
                                <option value="rajshahi"> Rajshahi </option>
                                <option value="sylhet"> Sylhet </option>
                                <option value="rangpur"> Rangpur </option>
                                <option value="mymensingh"> Mymensingh  </option>
                                <option value="khulna"> Khulna  </option>
                                <option value="barisal"> Barisal</option> 
                                </select>
                                <p v-if="errors.district" class="text-red-500"> {{errors.district[0]}}</p>
                            </div>

                            <div class="flex flex-col">
                                <div class="flex">
                                    <label for="comment" class="text-gray-600 font-semibold  capitalize"> comment </label>
                                </div>
                                <textarea  cols="30" rows="2" v-model="shipping.comment"
                                class="border-2 border-gray-200 my-2 px-2 py-2 focus:outline-none"
                                :class="{'border-red-500':errors.comment}">

                                </textarea>

                                <p v-if="errors.comment" class="text-red-500"> {{errors.comment[0]}}</p>
                            </div>

                        </form>
                    </div>

                    <div class="col-span-3 md:col-span-2">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1">
                                <h2 class="text-gray-900 font-bold text-sm md:text-[18px] mx-4"> Payment Method </h2>
                                <div class="my-2 px-4">
                                    <div class="flex">
                                        <input type="radio" id="cash_on_delivery" checked v-model="shipping.payment_method" value="cash_on_delivery" />
                                        <label for="cash_on_delivery" class="text-gray-600 font-semibold  mx-4"> Cash on Delivery </label>
                                    </div>
                                    <div class="flex my-2">
                                        <input type="radio" id="online_payment" v-model="shipping.payment_method" value="online_payment" />
                                        <label for="online_payment" class="text-gray-600 font-semibold  mx-4"> Online Payment </label>
                                    </div>   
                                    <div v-if="shipping.delivery_method=='online_payment'" class="text-gray-500  my-4">
                                        Nagad Marchent Number : {{ siteSetting.company_phone_2 }} 
                                        Bkash Marchent Number : {{ siteSetting.company_phone }} 
                                        Please pay on and enter the account 
                                        number and transaction ID from which you have paid in comment box.
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <h2 class="text-gray-900 font-bold text-sm md:text-[18px] mx-4"> Delivery Method </h2>
                                <div class="px-2">
                                    <div v-if="free_shipping" class="my-4 flex items-center">
                                        <h2 class="text-gray-900 font-semibold text-sm md:text-[16px] mx-4"> free Shipping </h2>
                                    </div>
                                    <div v-else class="flex flex-col my-2"> 
                                        <label  class="my-1 pl-2"> 
                                            <input type="radio" @change="changeDeliverySystems" v-model="delivery_method.title" 
                                            :value="delivery_method.title" :data-cost="delivery_method.cost" class="mr-2"> 
                                            {{ delivery_method.title }}- <span class="tex-sm">{{ delivery_method.cost }} TK </span> 
                                        </label>
                                        <label v-for="item in delivery_methods" :key="item.id" class="my-1 pl-2"> 
                                            <input type="radio" @change="changeDeliverySystems" v-model="delivery_method.title" 
                                            :value="item.delivery_title" :data-cost="item.delivery_cost" class="mr-2"> 
                                            {{ item.delivery_title }}- <span class="tex-sm">{{ item.delivery_cost }} TK </span> 
                                        </label>
                                    </div>   
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="my-4 grid grid-cols-12 gap-4">
                                <div class="my-4 col-span-12">
                                    <h2 class="text-gray-900 font-bold text-sm md:text-[18px] mx-4"> Your order </h2>
                                    <div class="my-8 overflow-x-auto relative shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left text-gray-500">
                                            <thead class="text-xs text-gray-700 uppercase">
                                                <tr>
                                                    <th scope="col" class="py-3 px-6">
                                                        Product 
                                                    </th>
                                                    <th scope="col" class="py-3 px-6">
                                                        Price
                                                    </th>
                                                    <th scope="col" class="py-3 px-6">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                
                                                <tr v-for="(cart,index) in carts" :key="index" class="border-b dark:bg-gray-900 dark:border-gray-700">
                                                    <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <router-link :to="{name:'product-detail',params:{slug:cart.id}}" class="text-gray-900  font-semibold  mx-4 w-60 hover:underline"> {{cart.options.product_title}}</router-link>
                                                    </th>
                                                    <td class="py-2 px-6 text-sm font-semibold text-slate-700">
                                                        {{ cart.price }} TK
                                                    </td>
                                                    <td class="py-2 px-6 text-md font-semibold text-slate-700">
                                                        {{ cart.subtotal }} TK
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="right" class="pt-4"> 
                                                        <span class="text-black font-semibold text-lg capitalize">
                                                            total
                                                         </span> 
                                                     </td>
                                                     <td colspan="1" class="pt-4"> 
                                                         <span class="text-red-500 font-semibold text-sm md:text-[18px] pl-5 "> {{subtotal}} TK </span>
                                                     </td>   
                                                </tr> 
                                                <tr v-if="delivery_method.cost">
                                                    <td colspan="2" align="right"> 
                                                        <span class=" text-black font-semibold text-sm md:text-[18px] capitalize">
                                                            Shipping Cost
                                                         </span> 
                                                     </td>
                                                     <td colspan="1"> 
                                                         <span class="text-red-500 font-semibold text-sm md:text-[18px] pl-5 "> {{ delivery_method.cost }} TK  </span>
                                                     </td>   
                                                </tr>
                                                <tr v-if="coupon">
                                                    <td colspan="2" align="right"> 
                                                        <span class=" text-black font-semibold text-sm md:text-[18px] capitalize">
                                                            Discount
                                                         </span> 
                                                     </td>
                                                     <td colspan="1"> 
                                                         <span class="text-red-500 font-semibold text-sm md:text-[18px] pl-5 "> {{ coupon.get_discount }} TK  </span>
                                                     </td>   
                                                </tr> 
                                                <tr>
                                                    <td colspan="2" align="right" class="pb-4"> 
                                                        <span class=" text-black font-semibold text-sm md:text-[18px] capitalize">
                                                            Grand Total:
                                                         </span> 
                                                     </td>
                                                     <td colspan="1" class="pb-4"> 
                                                         <span v-if="coupon" class="text-red-500 font-semibold text-sm md:text-[18px] pl-5 "> {{parseInt(coupon.finalDiscount) + delivery_method.cost}} TK  </span>
                                                         <span v-else class="text-red-500 font-semibold text-sm md:text-[18px] pl-5 "> {{subtotal + delivery_method.cost }} TK  </span>
                                                     </td>   
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="my-3 grid grid-cols-12 gap-4">
                                <div class="mx-4 col-span-12">
                                    <form @submit.prevent="applyCoupon">
                                        <div class="flex items-center">
                                            <input type="text" placeholder="Coupon Code" v-model="couponCheck.coupon_name"
                                            class="px-2 py-2 border-2 border-gray-300 w-full focus:outline-none">
                                            <button type="submit" class="w-40 capitalize font-bold py-2 bg-gray-200 border-2 border-gray-300">
                                                apply coupon
                                            </button>
                                        </div>
                                        
                                        <p v-if="errors.coupon_name" class="text-red-500"> {{errors.coupon_name[0] }}</p>
                                        <p v-if="errors.unvalid" class="text-red-500"> {{errors.unvalid }}</p>
                                        <p v-if="coupon" class="my-4 text-orange-800 text-xl font-bold"> You get {{ coupon.discount }} % for {{ coupon.coupon_name }} and save {{ coupon.get_discount }} TK </p>
                                    </form>
                                    <div v-if="siteSetting.advance_payment_limit < subtotal" class="my-4 flex flex-col justify-center">
                                        <div class="py-4">
                                            {{ siteSetting.advance_payment_limit_message }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="my-8 text-right">
                    <div class="">
                        <input type="checkbox" v-model="team_and_conditon" id="team_and_conditon" checked>
                        <label for="team_and_conditon">
                            I have read and agree to the
                            <router-link :to="{name:'team_and_condition'}" class="text-orange-500 font-semibold hover:underline">  
                                Terms and Conditions, Return Policy
                            </router-link> </label>
                        
                        <button @click="createOrder" class="bg-blue-700 px-4 py-2 text-md text-white capitalize mx-4"> confirm  order </button>
                        <p v-if="errors.agree" class="text-red-500 px-4 my-2">{{errors.agree[0]}}</p>
                    </div>
                </div>
            </div>
        </div>
        <Loading v-if="loading" :loading="'Wait for a moments. Loading... !'" />
    </div>
</template>
<script>
import Loading from "../components/Loading.vue";
export default{
    components:{Loading},
    data(){
        return {
            loading:false,
            shipping:{
                district:'Dhaka',
                name:'kabbya',
                email:'kabbya@gmail.com',
                phone:'01721245332',
                address:'malibag,dhaka',
                comment: 'this is testing comment I love codding',
                payment_method:'cas_on_delivery',
            },
            errors:{},
            siteSetting:'',
            subtotal:'',

            couponCheck:{},
            coupon:'',

            delivery_methods:[],

            delivery_method:{
                title:'',
                cost:'',
            },
            free_shipping :false,

            team_and_conditon:true,

            notification:{
                type:'',
                message:'',
            }
        }
    },
    methods:{
        changeDeliverySystems(e){
            let cost = e.target.getAttribute('data-cost');
            this.delivery_method.cost = parseInt(cost);
        },
        createOrder(){
            this.loading = true;
            this.errors = {},

            axios.put('/order/store',{
                name: this.shipping.name,
                phone: this.shipping.phone,
                email: this.shipping.email,
                address: this.shipping.address,
                district: this.shipping.district,
                comment: this.shipping.comment,

                coupon: this.coupon,

                subtotal: this.subtotal,
                
                payment_type: this.shipping.payment_method,

                delivery_type: this.delivery_method.title,
                delivery_method:this.delivery_method.cost,

                agree: this.team_and_conditon,

                
            })
            .then(res => {
                this.errors = {};
                this.loading = false;
                this.$router.push({name:'home'});
            })
            .catch(errors => {
                this.handelErrors(errors.response.data.errors)
                
            })
        },
        handelErrors(errors){
            this.loading = false;
            if(errors.unauthenticate){
                alert('at first login your account');
                this.$router.push('/login');
            }else(
                this.errors = errors
            )
        },
        applyCoupon(){
            axios.get('/coupon/check',{params:{coupon_name:this.couponCheck.coupon_name}})
            .then(res => {
                this.coupon = res.data;
                this.notification.type = 'success',
                this.notification.message = " Successfully added Coupon !";
                this.reloadPage();
            })
            .catch(errors =>{
                this.errors =errors.response.data.errors;
            })
        },
        reloadPage(){
            axios.get('/shopping/carts')
            .then(res => {
                this.carts = res.data['carts'];
                this.siteSetting = res.data['siteSetting'];
                this.subtotal = res.data['subtotal'];
            })
        },
    },
    created(){

        if(this.errors.unauthenticate){
            this.$router.push('/login');
        }
        axios.get('/shopping/carts')
        .then(res => {
            this.carts = res.data['carts'];
            this.siteSetting = res.data['siteSetting'];
            let subtotal = res.data['subtotal'];
            this.subtotal = Math.round(subtotal.replace(',',''));
        })
        axios.get('/get/delivery/setting')
        .then(res => {
            let delivery_method_data  = res.data['deliverySystem'];
            let delivery_system = Object.values(delivery_method_data)[0]
            this.delivery_method.title = delivery_system.delivery_title;
            this.delivery_method.cost =  parseInt(delivery_system.delivery_cost);

            this.delivery_methods = res.data['deliverySystem'].slice(1,5);

            this.coupon = res.data['coupon'];

            let shipping = res.data['freeShipping'];

            if(shipping){
                this.free_shipping = shipping;
                this.delivery_method.cost = 0;
                this.delivery_method.title = shipping;
            }
        })    
    }
}
</script>