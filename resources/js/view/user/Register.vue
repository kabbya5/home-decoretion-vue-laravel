<template>
    <div class="bg-blue-800 w-full py-20 ">
        <div class="w-full">
            <div class="flex justify-center items-center">
                <div class="w-96 bg-white py-8 px-4">
                    <h4 class="text-black font-semibold border-t-2 border-gray-400
                        px-4 pt-4 uppercase">
                         new account register
                    </h4>
                    <form action="px-4 py-6">
                        <input type="text" placeholder="First Name"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">

                        <input type="text" placeholder="Last Name"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">

                        <input type="text" placeholder="User Name"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">
                        
                        <input type="text" placeholder="Your Phone"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">

                        <input type="gmail" placeholder="Password"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">

                        <input type="password" placeholder="Password"
                            class="py-2 my-2 px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none">

                        <input type="checkbox" class="mx-4">  I agree to the terms.

                        <button type="submit" class="my-4 px-4 py-2 uppercase text-center bg-blue-800 w-full text-white transition duration-300 hover:bg-blue-600">
                             Create An Accoutn  
                        </button>
                    </form>
                    <div class="py-4">
                        Already have an account ?
                        <router-link to="/login" class="text-blue-800"> Log in instead </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>