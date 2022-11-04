<template>
    <div class="bg-blue-800 xl:bg-white overflow-hidden">
        <div class="login relative">
            <div class="hidden xl:block login-info">
        
            </div>
            <div class="container sm:px-10">
                <div class="block xl:grid grid-cols-2 ">
                    <div class="hidden xl:flex flex-col h-screen relative z-10">
                        <div class="my-auto ml-10">
                            <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="https://rubick-laravel.left4code.com/dist/images/illustration.svg">
                            <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign in to your account.</div>
                            <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                        </div>
                    </div>
                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 xl:bg-white">
                        <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="font-bold text-2xl xl:text-3xl text-center xl:text-center"> Sign In </h2>
                            <div class="text-slate-500 xl:hidden text-center">
                                A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place
                            </div>  
                                <div class="mb-4 font-medium text-sm text-red-600">
                                    <ul>
                                        
                                            <li></li>
                                    </ul>
                                </div>
                            <div class="mt-8">
                                <form class="login-form text-center">
                                    <input type="text" id="auth" class="py-3 px-4 w-96"  name="auth" value=""  autofocus placeholder="Email/Username/Phone Number"> 
                                    <input type="password" class="py-3 px-4 mt-4 w-96" id="password"  name="password"  autocomplete="current-password" placeholder="**********">
                                    <div class="w-96 flex justify-between mx-auto mt-5 text-slate-500">
                                        <div class="form-group">
                                            <input type="checkbox" id="remember_me" name="remember"  class="bg-blue-800 text-white xl:bg-white text-blue-800">
                                            <label for="remember"> Remember Me </label>
                                        </div>
                                        <a href=""> Forget Password </a>
                                    </div>
                                    <button type="submit" class="mt-5 w-96 text-center bg-blue-800 text-white py-3 hover:bg-blue-600 transition duration-300"> Login </button>
                                </form>
                                <router-link to="/register" class="py-3 px-4 w-full inline-block mt-3 xl:mt-0 text-center">
                                    Register
                                </router-link>                            
                                <div class="mt-10 xl:mt-24 text-slate-600 text-center">     
                                    By signin up, you agree to our <a class="text-blue-800" href="">Terms and Conditions</a>
                                    & <a class="text-blue-800" href="">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>