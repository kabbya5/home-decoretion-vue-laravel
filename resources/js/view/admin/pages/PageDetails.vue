<template>
    <div class="mt-[120px] md:mt-6 px-2 md:px-5">
        <h2 class="text-3xl capitalize text-center font-xl text-gray-800"> {{page.page_title}}</h2>

        <div class="ql-snow">
            <p class="ql-editor" v-html="page.page_content"></p>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return {
            page:{},
        }
    },
    created(){
        let slug = this.$route.params.slug; 
        axios.get('/page/details/' + slug)
        .then(res => {
            this.page = res.data;
        });
    }
}
</script>