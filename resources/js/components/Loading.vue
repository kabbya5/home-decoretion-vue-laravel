<template>
    <div v-if="loading" class="fixed z-50 top-0 left-0 bg-white w-full h-screen"> 
        <div class="w-full h-full flex items-center justify-center">
            <button class="px-6 py-1 uppercase bg-white text-gray-800 font-bold text-[24px]">{{ loading }} </button>
        </div>
    </div>
</template>
<script>
export default{
    props:['loading'],
}
</script>