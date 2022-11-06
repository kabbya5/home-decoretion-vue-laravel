@extends('layouts.app')

@section('content')
<div class="bg-blue-800 xl:bg-white overflow-hidden">
    <div class="login relative">
        <div class="hidden xl:block login-info">
    
        </div>
        <div class="container sm:px-10 -mt-10">
            <div class="block xl:grid grid-cols-2 ">
                <div class="hidden xl:flex flex-col h-screen relative z-10">
                    <div class="my-auto ml-10">
                        <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="https://rubick-laravel.left4code.com/dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign in to your account.</div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-0 xl:my-0 xl:bg-white">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="font-bold text-2xl xl:text-3xl text-center xl:text-center"> Sign In </h2>
                        <div class="text-slate-500 xl:hidden text-center">
                            A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place
                        </div>  
                        <div class="mt-8">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="w-full flex flex-col">
                                    <label for="email" class="text-gray-600 font-semibold px-4 my-2">
                                        {{ __('Email Address') }}
                                    </label>
                                    <input id="email" type="email" class="border-2 border-gray-200 
                                        focus:outline-none py-2 px-4 @error('email') border-1 border-red-500 @enderror" 
                                        name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
    
                                    @error('email') 
                                        <p class="px-4 text-red-400">{{ $message }}</p>  
                                    @enderror
                                </div>
        
                                <div class="flex flex-col mb-3">
                                    <label for="password" class="text-gray-600 font-semibold px-4 my-2">{{ __('Password') }}</label>

                                    <input id="password" type="password" class="form-control @error('password') border-1 border-red-500 @enderror
                                     border-2 border-gray focus:outline-none py-2 px-4" name="password"  autocomplete="current-password">
    
                                    @error('password')
                                        
                                        <p class="px-4 text-red-500">{{ $message }}</p>
                                       
                                    @enderror
                                </div>
                                <div class="flex justify-between my-4">
                                    <div class="col-md-6 offset-md-4">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
        
                                
                                <button type="submit" class="px-4 py-1 w-full text-xl uppercase 
                                    bg-blue-800 text-white border-2 
                                    transition duration-300 hover:border-blue-800 hover:bg-white hover:text-blue-800">
                                    {{ __('Login') }}
                                </button>

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
@endsection
