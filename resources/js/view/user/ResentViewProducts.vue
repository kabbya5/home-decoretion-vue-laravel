<template>
    <div class="mt-[90px] md:mt-0 md:py-10 container mx-auto">
        <div class="my-4 text-center">
            <h2 class="text-gray-800 font-bold capitalize text-2xl">
                Resent view product 
            </h2>

            <div class="my-6">
                <router-link :to="{name:'home'}" class="text-gray-600 font-semibold">
                    Home  /
                </router-link>
                <router-link :to="{name:'cart-content'}" class="text-gray-600 font-semibold">
                    Resent View 
                </router-link>
            </div>
        </div>
        <Product :products="resentViewProducts" />
    </div>
</template>
<script>
import Product from '../../components/Product.vue';
export default{
    components:{Product,},
    data(){
        return{
            resentViewProducts:[],
        }
    },
    mounted(){
        axios.get('/user/resent/view/products')
        .then(res => {
            let datas = res.data;
            datas.forEach(data => {
                this.resentViewProducts.push(data.product);
            });
            
        });
    }
    
}
</script>