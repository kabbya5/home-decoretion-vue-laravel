@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="bg-blue-800 w-full py-4 h-screen">
        <div class="w-full">
            <div class="flex justify-center items-center">
                <div class="w-96 bg-white py-8 px-4">
                    <h4 class="text-black font-semibold border-t-2 border-gray-400
                        px-4 pt-4 uppercase">
                         new account register
                    </h4>
                    <form  action="{{ route('register') }}" method="POST">
                        @csrf

                        <input type="text" placeholder="First Name"
                            class="@error('first_name') border-2 border-red-500 @enderror 
                            py-2  px-4 text-gray-800 w-full border-2 focus:border-gray-200 focus:outline-none"
                            value="{{ old('first_name') }}" name="first_name">
                        
                        @error('first_name')
                            <p class="text-red-500"> {{ $message }}</p>
                        @enderror

                        <input type="text" placeholder="Last Name"
                            class="@error('last_name') border-2 border-red-500 @enderror 
                            py-2  px-4 text-gray-800 w-full border-2 
                            focus:border-gray-200 focus:outline-none"
                            value="{{ old('last_name')}}">
                            
                        @error('last_name')
                            <p class="text-red-500"> {{ $message }}</p>
                        @enderror     

                        <input type="text" placeholder="User Name"
                            class="@error('user_name') border-2 border-red-500 @enderror 
                            py-2  px-4 text-gray-800 w-full border-2 
                            focus:border-gray-200 focus:outline-none"
                            
                            value="{{ old('user_name') }}" name="user_name">

                        @error('user_name')
                            <p class="text-red-500"> {{ $message }}</p>
                        @enderror 
                        
                        <input type="text" placeholder="Your Phone"
                            class="@error('phone') border-2 border-red-500 @enderror 
                                py-2  px-4 text-gray-800 w-full border-2 
                                focus:border-gray-200 focus:outline-none"
                                value="{{ old('phone') }}" name="phone">
                        @error('phone')
                            <p class="text-red-500"> {{ $message }}</p>
                        @enderror 

                        <input type="email" placeholder="Mail Account"
                            class="@error('email') border-2 border-red-500 @enderror 
                                py-2  px-4 text-gray-800 w-full border-2 
                                focus:border-gray-200 focus:outline-none"
                                
                                value="{{ old('email') }}" name="email">

                        @error('email')
                            <p class="text-red-500"> {{ $message }}</p>
                        @enderror 

                        <div class="flex justify-between">

                            <input class="@error('password') border-2 border-red-500 @enderror 
                                w-full appearance-none text-xl focus:outline-none border-2 border-gray-200 py-2 px-4"
                                type="password" name="password"
                                placeholder="password">
                        </div>
                        <input type="password" placeholder="Password"
                             class="py-2  px-4 text-gray-800 w-full border-2 focus:outline-none" 
                            name="password_confirmation">

                        <input type="checkbox" class="mx-4"
                            value="user.checked">
                            I agree to the terms and condition.
                           
                            @error('checked')
                            <p class="text-red-500"> {{ $message }}</p>
                            @enderror

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
</div>
@endsection
