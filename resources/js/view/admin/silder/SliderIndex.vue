<template>
    <div class="flex flex-wrap flex-row"> 
        <div class="flex-shrink max-w-full px-4 w-full mb-6">
          	<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                <div class="flex flex-row justify-between items-center pb-2">
                    <div class="flex">
                        <h3 class="text-base text-slate-500 font-bold"> ALL slider </h3>
                        <a> Active Slider </a>
                        <a href=""> Trash Slider  </a>
                    </div>
                    <router-link to="/admin/slider/create"  class="px-4 py-1 uppercase text-indigo-800 border-2 border-indigo-800
                        transition duration-300 hover:bg-indigo-800 hover:text-white">
                         create new
                    </router-link>
                </div>
          		<div class="overflow-x-auto">
	                <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <!-- table -->

                        <div class="dataTable-container my-6">
                            <table class="table-sorter table-bordered-bottom w-full text-gray-500">
                                <thead>
                                    <tr class="bg-gray-200/60">
                                        <th class="py-1 text-center" style="width: 14.6262%;">
                                            slider Name
                                        </th>
                                        <th class="py-1" style="width: 14.6262%;">
                                            Image
                                        </th>
                                        <th style="width: 14.6262%;">
                                            Status
                                        </th>
                                        <th class="py-1" style="width: 14.6262%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr v-for="slider in sliders" :key="slider.id">
                                        <td class="text-left text-lg py-2 text-text-gray-500">
                                            {{ slider.sliderName}} 
                                        </td>
                                        <td class="text-center text-lg py-2 text-text-gray-500">
                                            <div class="flex justify-center">
                                                <img class="w-14 h-14 rounded-full" :src="slider.sliderImg" :alt="slider.sliderName">
                                            </div>
                                        </td>
                                        <td class="text-center text-lg py-2 text-text-gray-500">
                                            <div class="flex justify-center">
                                                <img class="w-14 h-14 rounded-full" :src="slider.sliderImg" :alt="slider.sliderName">
                                            </div>
                                        </td>
                                        <td class="text-center text-lg py-2 text-text-gray-500">
                                            <!-- <button @click="editModal(slider)">
                                                <i class="fa-regular fa-pen-to-square"></i> 
                                            </button>  -->
                                            <button class="text-red-800 ml-2 font-bold"> 
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- more button  -->
                        <div @click="loadMore">
                            <div class="text-right pt-3 text-gray-500 capitalize font-semibold">
                                {{ slidersCount }}
                            </div>
                            <div v-if="length <= slidersLength" class="flex justify-center my-4">
                                <button  class="uppercase bg-indigo-800 px-4 py-2 rounded-lg text-white
                                transition duration-300 hover:bg-indigo-600">
                                    {{ btnMessage }}
                                    <i class="fa-solid fa-repeat ml-1"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
	            </div>
			</div>
		</div>
	</div>
</template>
<script>
    export default{
        data(){
            return {
                sliders:[],
                slidersCount:'',
                length:5,
                allSlider: [],
                slidersLength:'',
                btnMessage:"load more",
            }
        },

        methods:{
            loadMore:function(){
                this.btnMessage = 'looding...'
                this.length += 5;
                this.sliders = this.allSlider.slice(0, this.length);
                this.btnMessage = 'load more'
                console.log(this.allSlider)
            },
        },
        mounted(){
            axios.get('/api/admin/slider')
            .then(res =>{
                this.allSlider = res.data[0];
                this.sliders = res.data[0].slice(0, this.length);
                this.slidersCount = res.data[1];
                this.slidersLength = res.data[0].length;
            })
        },
    }
</script>
