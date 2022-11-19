<template>
    <div class="px-2 lg:container lg:mx-auto my-20 md:my-0">
        <div class="flex mb-4 mt-20 md:mt-8">
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                Home 
                <i class="fa-solid fa-right-arrow"></i>
            </router-link>
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                category 
                <i class="fa-solid fa-right-arrow"></i>
            </router-link>
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                subcategory
                <i class="fa-solid fa-right-arrow"></i>
            </router-link>
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                childcategory
                <i class="fa-solid fa-right-arrow"></i>
            </router-link>
            <router-link to="/" class="capitalize mx-2 text-gray-600 font-semibold"> 
                Chanel, the cheetah
                <i class="fa-solid fa-right-arrow"></i>
            </router-link>
        </div>
        <div class="w-full">
            <div class="bg-white">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 md:col-span-1">
                        <div class="owl-carousel owl-theme w-full">
                            <div v-for="n in 5" :key="n" class="item">
                                <img :src="img" alt="" class="object-cover h-full w-full">
                            </div>
                        </div>   
                    </div>
                    <div class="col-span-2 md:col-span-1 py-4 px-4">
                        <div class="title flex justify-between items-center">
                            <router-link to="/hdosl/lkd" class="text-gray-500 font-semibold text-xl transition-all duration-300 hover:text-gray-700">
                                Chanel, the cheetah
                            </router-link>
                        </div>
                        
                        <p class="my-2 text-sm text-gray-600"> 
                            Nam libero tempore, cum soluta nobis est 
                            eligendi optio cumque nihil impedit quo minus id
                            quod maxime placeat facere possimus, omnis amet...
                        </p>

                        <div class="discount flex items-center">
                            <div class="flex items-center">
                                <del> 300 TK </del>
                                <span class="mx-4 text-red-500 font-bold text-xl"> 400 TK </span>
                            </div>
                            <span class="bg-orange-500 px-2 py-1 rounded-full text-white flex items-center justify-center font-bold"> 10% </span>
                        </div>
                        <div class="flex items-center text-gray-600 my-2"> 
                            <i class="fa-regular fa-eye font-2xl"></i> 
                            <span class="mx-2 font-bold text-gray-600"> 30 </span>
                            people are views
                        </div>
                        <!-- form section  -->

                        <form class="w-full"> 
                            <div class="flex flex-row lg:flex-col">
                                <div class="flex flex-col w-1/3">
                                    <p class="text-gray-600 my-1"> Quanitity : </p>
                                    <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                        <option value="1" class=""> Only one </option>
                                        <option value="2"> Only two </option>
                                        <option value="3"> Only three </option>
                                        <option value="4"> Only four </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-1/3">
                                    <p class="text-gray-600 my-1"> Size : </p>
                                    <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                        <option value="ml" class=""> ML</option>
                                        <option value="xl"> XL </option>
                                        <option value="xxl"> XXL </option>
                                    </select>
                                </div>
                                <div class="flex flex-col w-1/3">
                                    <p class="text-gray-600 my-1"> Color : </p>
                                    <select name="" id="" class="border-2 border-gray focus:outline-none py-1"> 
                                        <option value="1" class=""> RED </option>
                                        <option value="2"> BLUE </option>
                                        <option value="3"> Green </option>
                                    </select>
                                </div>   
                            </div>
                            <button class="mt-4 capitalize w-full py-2 text-xl rounded-md bg-orange-500 text-white transition duration-300 hover:bg-orange-700">
                                buy now 
                            </button>
                        </form>
                    </div>
                </div>    
            </div>
    
        </div>
    </div>
</template>
<script>
export default {
  data: function() {
    return {
        img:'',
    }; 
  },
  methood:{
  },
  mounted(){
    this.img = 'https://media.istockphoto.com/id/1182454657/photo/bohemian-living-room-interior-3d-render.jpg?s=612x612&w=0&k=20&c=qw37MGIiTL_jML3_Tbm4bM-jNLCrocSWj7DanhBr_bY=';
  }
};

</script>