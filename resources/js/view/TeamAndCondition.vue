<template>
    <div class="mt-[90px] md:mt-0 md:py-10 container mx-auto">
        <div class="my-4 text-center">
            <h2 class="text-gray-800 font-bold capitalize text-2xl">
                team and conditon amd return policy
            </h2>

            <div class="my-6">
                <router-link :to="{name:'home'}" class="text-gray-600 font-semibold">
                    Home  /
                </router-link>
                <router-link :to="{name:'team_and_condition'}" class="text-gray-600 font-semibold">
                    team and conditon
                </router-link>
            </div>

            <div class="my-10">
                <div class="ql-snow">
                    <p class="ql-editor" v-html="siteSetting.trean_and_conditon"></p>
                </div>
            </div>

            <div class="my-10">
                <div class="ql-snow">
                    <p class="ql-editor" v-html="siteSetting.return_policy"></p>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            siteSetting:{},
        }
    },
    created(){
        axios.get('/get/navbar/content')
        .then(res =>{this.siteSetting = res.data['siteSetting']})
    }
}
</script>