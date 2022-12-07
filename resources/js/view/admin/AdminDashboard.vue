<template>
    <div class="">
        <div class="flex border-b-2 border-gray-200  px-4 py-2">
            <router-link to="/admin/dashboard" class="capitalize"> dashboard </router-link>
        </div>
        <div class="my-6 grid grid-cols-4 gap-4">
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
            <div class="col-span-2 lg:col-span-1">
                <div class="shoping-report relative z-10 border border-gray-200 mt-3 p-4 bg-white drop-shadow-sm transition duration-300">
                    <a href="#"> 
                        <div class="flex justify-between">
                            <div class="flex flex-col">
                                <i class="fas fa-archive text-3xl text-orange-300"></i>
                                <h4 class="text-black mt-4 text-2xl"> 3.721 </h4>
                                <span class="mt-2 text-gray-500"> New Orders </span>
                            </div>
                            <div>
                                <span class="rounded-full px-2 py-1 bg-red-600  text-white">
                                    2%
                                    <i class="fas fa-angle-down ml-1"></i>
                                </span>
                            </div>  
                        </div>
                    </a>
                </div>
                   
            </div>
        </div>

        <!-- Resent Order  -->
        <div class="flex">
            <h4 class="text-gray-700 font-bold mx-4 my-6 capitalize"> Resent Order </h4>
        </div>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            order id
                        </th>
                        <th scope="col" class="py-3 px-6">
                            status
                        </th>
                        <th scope="col" class="py-3 px-6">
                            coustomer
                        </th>
                        <th scope="col" class="py-3 px-6">
                            date
                        </th>
                        <th scope="col" class="py-3 px-6">
                            total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="py-4 px-6">
                            Sliver
                        </td>
                        <td class="py-4 px-6">
                            Laptop
                        </td>
                        <td class="py-4 px-6">
                            $2999
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Microsoft Surface Pro
                        </th>
                        <td class="py-4 px-6">
                            White
                        </td>
                        <td class="py-4 px-6">
                            Laptop PC
                        </td>
                        <td class="py-4 px-6">
                            $1999
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Magic Mouse 2
                        </th>
                        <td class="py-4 px-6">
                            Black
                        </td>
                        <td class="py-4 px-6">
                            Accessories
                        </td>
                        <td class="py-4 px-6">
                            $99
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Google Pixel Phone
                        </th>
                        <td class="py-4 px-6">
                            Gray
                        </td>
                        <td class="py-4 px-6">
                            Phone
                        </td>
                        <td class="py-4 px-6">
                            $799
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apple Watch 5
                        </th>
                        <td class="py-4 px-6">
                            Red
                        </td>
                        <td class="py-4 px-6">
                            Wearables
                        </td>
                        <td class="py-4 px-6">
                            $999
                        </td>
                        <td class="py-4 px-6">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Top saleing product  -->

        <div class="grid grid-cols-12 gap-4 my-6">
            <div class="col-span-12 lg col-span-8">
                <div class="flex">
                    <h4 class="text-gray-700 font-bold mx-4 my-6 capitalize"> Top saleing product </h4>
                </div>
        
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    product name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Images
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    quatity
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    date
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="py-4 px-6">
                                    Sliver
                                </td>
                                <td class="py-4 px-6">
                                    Laptop
                                </td>
                                <td class="py-4 px-6">
                                    $2999
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Microsoft Surface Pro
                                </th>
                                <td class="py-4 px-6">
                                    White
                                </td>
                                <td class="py-4 px-6">
                                    Laptop PC
                                </td>
                                <td class="py-4 px-6">
                                    $1999
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Magic Mouse 2
                                </th>
                                <td class="py-4 px-6">
                                    Black
                                </td>
                                <td class="py-4 px-6">
                                    Accessories
                                </td>
                                <td class="py-4 px-6">
                                    $99
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Google Pixel Phone
                                </th>
                                <td class="py-4 px-6">
                                    Gray
                                </td>
                                <td class="py-4 px-6">
                                    Phone
                                </td>
                                <td class="py-4 px-6">
                                    $799
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Apple Watch 5
                                </th>
                                <td class="py-4 px-6">
                                    Red
                                </td>
                                <td class="py-4 px-6">
                                    Wearables
                                </td>
                                <td class="py-4 px-6">
                                    $999
                                </td>
                                <td class="py-4 px-6">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-12 my-6 lg:my-0 lg:col-span-4">
                <div v-for="n in 10" :key="n" class="w-full">
                    <img src="https://media.istockphoto.com/id/1350859272/photo/luxury-furniture-goods.jpg?b=1&s=170667a&w=0&k=20&c=608apow7e_EtKc-N899ru7BiYxrOt_8ar1_Ydh01sn4=" alt="">
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss" scoped>
.relative::before{
    position: absolute;
    content: '';
    width: 80%;
    top:100%;
    left: 50%;
    transform: translate(-50%);
    height: 0%;
    z-index: -1;
    background-color: rgb(245, 238, 238);
    transition: all 0.3s;

}
.relative:hover:before{
    height: 10%;
}
</style>>
