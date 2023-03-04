<template>
    <div class="pt-10">
        <footer class="bg-white container mx-auto">
            <div class="grid grid-cols-2 gap-8 py-8 px-6 md:grid-cols-4">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase">Company</h2>
                    <ul class="text-gray-500 dark:text-gray-400">
                        <li v-for="page in pages" :key="page.id" class="mb-4">
                            <router-link :to="{name:'page-details',params:{slug:page.slug}}">
                                {{ page.page_title }}
                            </router-link>
                        </li>
                        
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-center text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Help center</h2>
                    <ul class="text-gray-500 dark:text-gray-400 text-center">
                        <li v-for="link in socialLinks" :key="link.id" class="mb-4">
                            <a target="blank" :href="link.link_url" class="hover:underline flex items-center justify-center">
                                <i :class="link.link_icon"></i>
                                <span class="ml-4"> {{link.media_name}}</span>
                            </a>
                        </li>
                    </ul>  
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Legal</h2>
                    <ul class="text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Licensing</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Download</h2>
                    <ul class="text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">iOS</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Android</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Windows</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">MacOS</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="py-6 px-4 bg-gray-100 dark:bg-gray-700 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2022 <a href="https://flowbite.com/">Flowbite™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center md:mt-0">
                    <a v-for="link in socialLinks" :key="link.id" 
                        :href="link.link_url" target="blank" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <i :class="link.link_icon"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>

export default{
    data(){
        return{
            pages:[],
            socialLinks:[],
        }
    },
    created(){
        axios.get('/footer/content')
        .then(res => {
            this.pages = res.data['pages'];
            this.socialLinks = res.data['socialLinks'];
        })
    }
}

</script>