<template>
    <div>
        <!-- Banner  -->
        <Slider> 

        </Slider>
        <!-- End banner  -->

        <!-- Entery  -->
        <div class="entery container mx-auto my-4">
            <div class="grid grid-cols-4 gap-4 border-2 border-gray-200 py-6">
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-truck-fast fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Free shipping </h2>
                            <p class="pt-2 text-gray-500"> Upto 400 tk</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-sack-dollar fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Money guarantee</h2>
                            <p class="pt-2 text-gray-500">  within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-headphones fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Online support </h2>
                            <p class="pt-2 text-gray-500">  available 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 md:col-span-2 lg:col-span-1">
                    <div class="flex flex-col md:flex-row items-center justify-center">
                        <i class="fa-solid fa-money-check-dollar fa-2x text-gray-700 font-bold"></i>
                        <div class="px-4 sm:flex flex-col justify-center">
                            <h2 class="text-gray-800 font-bold text-lg"> Pay with Multiple </h2>
                            <p class="pt-2 text-gray-500">  Credit Cards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-center">
                <h4 class="text-black uppercase font-bold text-[30px]">
                    All Popular Category 
                    <span v-if="loading" class="text-yellow-600 text-sm font-bold text-right"> loding... </span>
                </h4>
            </div>

            <div class="grid grid-cols-6 gap-2">
                <div class="bg-white h-[200px] md:h-full lg:h-[405px] col-span-2 md:row-span-2 md:col-span-2 xl:col-span-2">
                    <div class="h-full relative overflow-hidden">
                        <img class="block object-cover boject-center w-full h-full brightness-75
                            transition duration-300 hover:scale-[1.2]" 
                            :src="firstCategory.categoryImg"  :alt="firstCategory.categoryImgName">
                        <p class="text-2xl font-bold absolute bottom-3 w-full left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                            {{ firstCategory.categoryName }}
                        </p>
                    </div>
                </div>
                <div v-for="category in categories" :key="category.id" class="h-[200px] bg-white col-span-2 md:col-span-2 xl:col-span-1">
                    <div class="h-full w-full relative overflow-hidden">
                        <img class="block object-cover boject-center w-full h-full 
                            transition duration-300 -z-1 hover:scale-[1.2] hover:brightness-75" 
                            :src="category.categoryImg"  :alt="category.categoryImgName">
                        <p class="text-2xl w-full font-bold absolute bottom-3 left-[50%] translate-x-[-50%]  z-10 text-white text-center drop-shadow-lg shadow-gray-400">
                            {{ category.categoryName }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- END Category  -->

        <!-- Resent Product  -->
        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 text-center">
                <h4 class="text-black uppercase font-bold text-[30px]">
                    Resent ALL Popular Product 
                    <span v-if="loading" class="text-yellow-600 text-sm font-bold text-right"> loding... </span>
                </h4>
            </div>
            <div class="my-8">
                <div class="grid grid-cols-12 gap-4">
                    <div v-for="n in 12" :key="n" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 transition duration-300 hover:bg-gray-200">
                       
                        <div class="h-[300px] w-full relative">
                            <router-link to="/product-detail"> 
                                <img class="block object-cover h-full w-full" :src="img" alt="">
                            </router-link>
                        
                            <!-- produt-status -->
                            <span class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> sole !</span>
                            <span class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 30%</span>
                            <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> New </span>

                            <!-- action div  -->
                            <div class="absolute top-[20%] right-2">
                                <div class="flex flex-col">
                                    <button @mouseenter="actionTitel='cart'+n"
                                        @mouseleave="actionTitel=false" 
                                        class="relative bg-white my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span v-if="actionTitel=='cart'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                    </button>
                                    <button @mouseenter="actionTitel='qickView'+n"
                                        @mouseleave="actionTitel=false"
                                        @click="quickViewModal=!quickViewModal"
                                        class="relative bg-white  w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-regular fa-eye"></i>
                                        <span v-if="actionTitel=='qickView'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Quick view </span> 
                                    </button>
                                    <button @mouseenter="actionTitel='compair'+n"
                                        @mouseleave="actionTitel=false" class="relative bg-white  my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-right-left"></i>
                                        <span v-if="actionTitel=='compair'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Compair </span> 
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product detail my-4 px-2">
                            <router-link to="/product/detalids" class="w-ful uppercase text-gray-600 transition duration-300 hover:font-bold text-sm">
                                table
                            </router-link><br>
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-bold h-10 text-sm">
                                9 Iconic Bed Decoration Ideas To ed Decoration
                            </router-link>
                            <div class="review flex items-center text-orange-500 text-sm my-2 -ml-2">
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star-half"></i>
                                <span>
                                    (10)
                                </span>
                            </div>
                            <div class="price">
                                <del class="text-gray-400 font-semibold"> 400 Tk</del>
                                <span class="mx-2 text-orange-500"> 300 taka </span>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <!-- Recomadation  -->

        <div class="my-5 container mx-auto" id="category">
            <div class="my-8 flex flex-col justify-center items-center lg:flex-row lg:justify-between border-b-2 border-slate-200 px-2 md:px-4">
                <h4 class="text-black uppercase font-semibold text-[18px] pb-2">
                    Recomadation products
                </h4>
                <div class="flex">
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> New arrivals </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> Best rated </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> all </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                    <button class="capitalize border-b-2 border-orange-500 -mb-2 mx-4"> top 24 </button>
                </div>
            </div>
            <div class="my-8">
                <div class="grid grid-cols-12 gap-4">
                    <div v-for="n in 12" :key="n" class="my-4 col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3 transition duration-300 hover:bg-white">
                        <div class="h-[300px] w-full relative">
                            <img class="block object-cover h-full w-full" :src="img" alt="">
                            <!-- produt-status -->
                            <span class="absolute left-2 top-2 rounded-md bg-red-500 text-white  px-4 py-1 text-white"> sole !</span>
                            <span class="absolute right-2 top-2 rounded-md bg-orange-500 text-white  px-4 py-1 text-white"> 30%</span>
                            <span class="absolute bg-orange-500 text-white px-4 py-1 rounded-md text-bold mx-4 left-[40%] bottom-[-10px]"> New </span>

                            <!-- action div  -->
                            <div class="absolute top-[20%] right-2">
                                <div class="flex flex-col">
                                    <button @mouseenter="actionTitel='cart'+n"
                                        @mouseleave="actionTitel=false" class="relative bg-white my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span v-if="actionTitel=='cart'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                    </button>
                                    <button @mouseenter="actionTitel='qickView'+n"
                                        @mouseleave="actionTitel=false" class="relative bg-white  w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-regular fa-eye"></i>
                                        <span v-if="actionTitel=='qickView'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Quick view </span> 
                                    </button>
                                    <button @mouseenter="actionTitel='compair'+n"
                                        @mouseleave="actionTitel=false" class="relative bg-white  my-2 w-10 h-10 flex items-center justify-center  rounded-full
                                        transition duration-300 hover:bg-black hover:text-white"> 
                                        <i class="fa-solid fa-right-left"></i>
                                        <span v-if="actionTitel=='compair'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Compair </span> 
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product detail my-4 px-2">
                            <router-link to="/product/detalids" class="w-ful uppercase text-gray-600 transition duration-300 hover:font-bold text-sm">
                                table
                            </router-link><br>
                            <router-link to="/product/detalids" class="w-ful text-gray-600 font-bold h-10 text-sm">
                                9 Iconic Bed Decoration Ideas To ed Decoration
                            </router-link>
                            <div class="review flex items-center text-orange-500 text-sm my-2 -ml-2">
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star mx-2"></i>
                                <i class="fa-solid fa-star-half"></i>
                                <span>
                                    (10)
                                </span>
                            </div>
                            <div class="price">
                                <del class="text-gray-400 font-semibold"> 400 Tk</del>
                                <span class="mx-2 text-orange-500"> 300 taka </span>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <!-- Quick view modal  -->
        <div v-if="quickViewModal" class="quickview-modal w-full h-screen bg-gray-300/60 fixed top-0 z-50">
            <div class="flex items-center justify-center h-full px-4">
                <div class="bg-white relative w-[450px] md:w-[1000px]">
                    <button @click="quickViewModal=!quickViewModal"
                    class="absolute -top-4 -right-3 w-10 h-10 rounded-full bg-white
                        trasition duration-300 hover:text-white hover:bg-black shadow-md">
                    <i class="fa-solid fa-xmark"></i>

                    </button>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2 md:col-span-1">
                            <div class="owl-carousel owl-theme">
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
                                <button @mouseenter="actionTitel='cart'+n"
                                    @mouseleave="actionTitel=false" 
                                    class="relative mr-4 w-10 h-10 flex items-center justify-center  rounded-full
                                    transition duration-300 border-2 border-gray-200 hover:bg-black hover:text-white"> 
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span v-if="actionTitel=='cart'+n" class="absolute right-[100%] w-[100px] px-2 bg-orange-500 text-white"> Add to cart </span> 
                                </button>
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
                                people are vieied
                            </div>
                            <!-- form section  -->

                            <form class="w-full"> 
                                <div class="flex justify-between">
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
        
<footer class="bg-white dark:bg-gray-900">
    <div class="grid grid-cols-2 gap-8 py-8 px-6 md:grid-cols-4">
        <div>
            <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Company</h2>
            <ul class="text-gray-500 dark:text-gray-400">
                <li class="mb-4">
                    <a href="#" class=" hover:underline">About</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Careers</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Brand Center</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Blog</a>
                </li>
            </ul>
        </div>
        <div>
            <h2 class="mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Help center</h2>
            <ul class="text-gray-500 dark:text-gray-400">
                <li class="mb-4">
                    <a href="#" class="hover:underline">Discord Server</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Twitter</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Facebook</a>
                </li>
                <li class="mb-4">
                    <a href="#" class="hover:underline">Contact Us</a>
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
            <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                <span class="sr-Only">Facebook page</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path></svg>
                <span class="sr-Only">Instagram page</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg>
                <span class="sr-Only">Twitter page</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                <span class="sr-Only">GitHub account</span>
            </a>
            <a href="#" class="text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd"></path></svg>
                <span class="sr-Only">Dribbble account</span>
            </a>
        </div>
    </div>
</footer>


    </div>
</template>
<script>
import Slider from '../components/Slider.vue';

export default {
    components:{Slider},
  data: function() {
    return {
        quickViewModal: false,
        loading:false,
        categories:[],
        firstCategory:'',
        img:null,
        actionTitel:false,
        w: window.innerWidth,
        
    }; 
  },
  methood:{
  },
  mounted(){
    axios.get('/api/get/cateogry/index')
    .then(res => {
        this.loading = true
        this.categories = res.data[1];
        this.firstCategory = res.data[0];
        this.loading = false
    })
  },
  created(){
    this.img = 'https://media.istockphoto.com/id/1182454657/photo/bohemian-living-room-interior-3d-render.jpg?s=612x612&w=0&k=20&c=qw37MGIiTL_jML3_Tbm4bM-jNLCrocSWj7DanhBr_bY=';
  }
};
</script>
