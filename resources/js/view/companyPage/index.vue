<template>
    <div class="">
        <div class="hero" :style="{'background-image':'url('+bg+')',}">
            <div class="container mx-auto">
                <div class="p-0 md:p-3 lg:p-8">
                    <div class="flex flex-col-reverse md:flex-row items-center h-full bg-white">
                        <div class="hidden md:block w-4 bg-cyan-800 h-96">
                        </div>
                        <div class="p-2 md:p-10 flex w-full items-center">
                            <div class="mt-6 md:mt-0">
                                <button class="bg-cyan-800 px-4 py-1 text-white rounded-md "> Title </button>
                                <p class="my-3 capitalize text-slate-600 font-semibold"> industry. Lorem Ipsum has been  </p>
    
                                <h3 class="text-gray-800 font-bold text-xl md:text-2xl capitalize"> Project Title </h3>

                                <div class="flex">
                                    <span class="my-3 block capitalize text-slate-600 font-semibold"> Desing By </span>
                                    <span class="mx-8 my-3 block font-bold capitalize text-slate-600"> Desiner Name </span>
                                </div>

                                <div class="w-full md:w-[300px] lg:w-[400px]">
                                    <p class="text-slate-600  text-md">
                                        Contrary to popular belief, Lorem Ipsum is not simply random text.
                                        It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                                    </p>

                                    <button class="my-5 bg-cyan-800 px-4 py-1 text-white rounded-md "> Load More  </button>
                                </div>
                                
                            </div>                
                        </div>
                        <div class="img-div mr-0 md:mr-4 w-full h-full">
                            <img class="w-full h-full" :src="bg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- How you find US -->
        <div class="works px-2 mt-10">
            <div class="container mx-auto">
                <h3 class="text-gray-800 font-bold text-xl md:text-2xl capitalize"> How you find US </h3>
            <div class="grid grid-cols-12 my-6 md:my-20 gap-4 ">
                <div class="col-span-6 lg:col-span-4 my-4">
                    <div class="flex flex-col justify-center items-center w-[400px] mx-auto">
                        <i class="fa-solid fa-house-chimney-user fa-3x text-orange-500"></i>
                        <h2 class="block my-4 text-gray-900  text-xl"> Buy / Investment </h2>
                        <p class="block my-4 text-[#8B8884]  text-md">
                            Quam vestibulum sociis libero, pellentes vel montes purus taciti vivamus sapien etiam montes. Nostra cras vulputate luctu ipsum, ullamcorper ridiculus porta.
                        </p>
                    </div>
                </div>
                <div class="col-span-6 lg:col-span-4 my-4">
                    <div class="flex flex-col justify-center items-center w-[400px] mx-auto">
                        <i class="fa-solid fa-house-chimney-user fa-3x text-orange-500"></i>
                        <h2 class="block my-4 text-gray-900  text-xl"> Buy / Investment </h2>
                        <p class="block my-4 text-[#8B8884]  text-md">
                            Quam vestibulum sociis libero, pellentes vel montes purus taciti vivamus sapien etiam montes. Nostra cras vulputate luctu ipsum, ullamcorper ridiculus porta.
                        </p>
                    </div>
                </div>
                <div class="col-span-6 lg:col-span-4 my-4">
                    <div class="flex flex-col justify-center items-center w-[400px] mx-auto">
                        <i class="fa-solid fa-house-chimney-user fa-3x text-orange-500"></i>
                        <h2 class="block my-4 text-gray-900  text-xl"> Buy / Investment </h2>
                        <p class="block my-4 text-[#8B8884]  text-md">
                            Quam vestibulum sociis libero, pellentes vel montes purus taciti vivamus sapien etiam montes. Nostra cras vulputate luctu ipsum, ullamcorper ridiculus porta.
                        </p>
                    </div>
                </div>
            </div>
            </div>
            
        </div>

        <div class="container mx-auto my-10 md:my-20">
            <!-- projects  -->
            <div class="project px-2">
                <h3 class="text-[#000040] leading-[67px] font-bold text-xl md:text-2xl capitalize"> Recent Projects </h3>
                <div class="grid grid-cols-12 my-10 gap-4">
                    <div class="col-span-6 lg:col-span-4">
                        <div class="image-div">
                            <img :src="bg" alt="">
                        </div>
                        <span class="text-[#000040] font-semibold text-md md:text-xl capitalize mt-4 block"> Apolo Family Appartment </span>
                        <div class="details text-left my-2">
                            <span class="ml-1 text-md text-[#8B8884] "> 
                                <i class="mx-1 fa-solid fa-bed text-md text-[#8B8884] "> 

                                </i> 
                                4 
                            </span> 
                            <span class="ml-1 text-md text-[#8B8884] "><i class="fa-solid fa-toilet mx-1 text-md">  </i> 4  </span> 
                            <span class="ml-1 text-md text-[#8B8884] "><i class="fa-solid fa-house-chimney-window mx-1 text-md text-[#8B8884] "> </i>  1200 sq ft </span>     
                            <span class="ml-1 text-md text-[#8B8884]"> 20000000TK </span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- team  -->
            <div class="team px-2">
                <h3 class="text-gray-800 font-bold text-xl md:text-2xl capitalize">Meet Our Team Members </h3>
                <div class="grid grid-cols-12 my-6 gap-4">
                    <div class="col-span-6 lg:col-span-4 my-4">
                        <div class="image-div relative h-[auto]">
                            <img class="h-full w-full" :src="image" alt="">
                            <div class="flex items-center justify-center">
                                <p class="-mt-5 bg-yellow-600 px-4 py-2 capitalize text-white rounded-md"> Manager </p>
                            </div>    
                        </div>
                        <span class="text-gray-800 font-bold text-xl uppercase mt-4 block text-center"> Apolo Family Appartment </span>
                        <div class="details text-center my-2">
                            <p class="text-[#8B8884] capitalize block">
                                Everything We Pizza, We Pizza With Love. Designer Fastfood.
                            </p>
                            <div class="flex my-2 mr-2 justify-center">
                                <span class=" text-md"> <i class="mx-1 fa-solid fa-phone text-md text-[#8B8884] "> </i>  01721597157 </span>
                                <span class="text-md lowercase"> <i class="mx-1 fa-solid fa-phone text-md text-[#8B8884] "> </i> gmail@gmail.com </span>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto my-10 md:my-20">
            <!-- what our works  -->
            <div class="works px-2 mt-10">
                <h3 class="text-gray-800 font-bold text-xl md:text-2xl capitalize"> What our works </h3>
                <div class="grid grid-cols-12 my-6 md:my-20 gap-4 ">
                    <div class="col-span-6 lg:col-span-4 my-4">
                        <div class="flex flex-col justify-center items-center">
                            <i class="fa-solid fa-house-chimney-user fa-3x text-orange-500"></i>
                            <h2 class="block my-4 text-gray-900  text-xl"> Buy / Investment </h2>
                            <p class="block my-4 text-[#8B8884]  text-md">
                                Quam vestibulum sociis libero, pellentes vel montes purus taciti vivamus sapien etiam montes. Nostra cras vulputate luctu ipsum, ullamcorper ridiculus porta.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- projects  -->
            <div class="project px-2">
                <h3 class="text-[#000040] leading-[67px] font-bold text-xl md:text-2xl capitalize"> Recent Projects </h3>
                <div class="grid grid-cols-12 my-10 gap-4">
                    <div class="col-span-6 lg:col-span-4">
                        <div class="image-div">
                            <img :src="bg" alt="">
                        </div>
                        <span class="text-[#000040] font-semibold text-md md:text-xl capitalize mt-4 block"> Apolo Family Appartment </span>
                        <div class="details text-left my-2">
                            <span class="ml-1 text-md text-[#8B8884] "> 
                                <i class="mx-1 fa-solid fa-bed text-md text-[#8B8884] "> 

                                </i> 
                                4 
                            </span> 
                            <span class="ml-1 text-md text-[#8B8884] "><i class="fa-solid fa-toilet mx-1 text-md">  </i> 4  </span> 
                            <span class="ml-1 text-md text-[#8B8884] "><i class="fa-solid fa-house-chimney-window mx-1 text-md text-[#8B8884] "> </i>  1200 sq ft </span>     
                            <span class="ml-1 text-md text-[#8B8884]"> 20000000TK </span>
                        </div>

                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>
<script>
export default{
    data (){
        return {
            bg:'https://c4.wallpaperflare.com/wallpaper/724/723/644/interior-design-room-house-home-apartment-condo-209-desktop-background-images-wallpaper-preview.jpg',
            image:'https://media.istockphoto.com/id/1332558192/photo/three-multi-ethnic-construction-workers-chatting.jpg?s=612x612&w=0&k=20&c=m6Sevw_6Xw-5LhpnT1C_P6UitIo04em3lhjfx-BGsKg=',

            image_2:'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRtK5EOk4JZqGJALx4DZhK-iyezjKUneLOY79Kv0H38f4CTbiGaCGpL7Gd2J9mhGYZW1w&usqp=CAU',
            image_3:'https://www.westend61.de/images/0000849735pw/construction-workers-talking-at-construction-site-CAIF09301.jpg'
        }
    }
}
</script>
<style scoped>
.hero{
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
}
</style>>
 