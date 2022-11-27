<template>
    <div>
        <div class="my-10 container mx-auto">
            <h2 class="my-8 text-gray-600 font-semibold capitalize text-xl text-center"> Shopping Cart </h2>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Product Name 
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    product price 
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    size 
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="n in 3" :key="n">
                                <td class="px-4 py-3 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-20 h-20">
                                            <img class="w-full h-full rounded-md"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div>
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    Vera Carpenter
                                                </p>
                                            </div>
                                        </div>
                                </td>
                                <td class="px-4 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        300 TK
                                    </p>
                                </td>
                                <td class="px-4 py-3 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        43
                                    </p>
                                </td>
                                <td class="px-4 py-3 border-b border-gray-200 bg-white text-sm">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <span aria-hidden
                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                    <span class="relative">Activo</span>
                                    </span>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-between mx-4">
                <button class="px-8 py-2 rounded-md text-white bg-cyan-500 trasiton duration-300 hover:bg-cyan-800"> Clear All </button>
            </div>

            <div class="my-8 grid grid-cols-12 gap-4">
                <div class="mx-4 col-span-12 md:col-span-6 lg:col-span-8">
                    <div class="flex items-center">
                        <input type="text" placeholder="Coupon Code"
                        class="px-2 py-2 border-2 border-gray-300 w-full focus:outline-none">
                        <button class="w-40 capitalize font-bold py-2 bg-gray-200 border-2 border-gray-300">
                            apply coppon
                        </button>
                    </div>
                    <div class="my-4 flex flex-col justify-center">
                        <div>Picked: {{ picked }}</div>

                        <input type="radio" id="one" value="One" v-model="picked" />
                        <label for="one">One</label>
                        
                        <input type="radio" id="two" value="Two" v-model="picked" />
                        <label for="two">Two</label>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-4 my-4 md:my-0">
                    <div class="mx-4 border-2 border-gray-200">
                        <h2 class="text-center uppercase py-6"> total Cost </h2>
                        <div class="text-center text-slate-500">
                            <div class="flex justify-between my-2">
                                <p>Subtotal:</p>
                                <span> 400 TK</span>
                            </div>
                            <div class="flex justify-between my-2">
                                <p>shippin:</p>
                                <span> Free</span>
                            </div>
                            <div class="flex justify-between text-gray-600 font-bold my-2">
                                <p>Grand Total::</p>
                                <span> 400 TK</span>
                            </div>

                            <button class="my-6 py-2 w-full uppercase bg-green-500 text-white text-center rounded-md transiton duration-300 hover:bg-green-800">
                                Checkout 
                            </button>
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
        return{
            picked:'',
        }
    },


    created(){
        document.title = 'Cart';
    }
}
</script>