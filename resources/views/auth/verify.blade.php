@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8">
    <div class="flex justify-center">
        <div class="email_veriy_mesage w-96">
            <div class="company_name_or_logo flex items-center">
                @if ($site_setting->title_image)
                <img class="w-32 h-20"  src="{{ asset($site_setting->title_image) }}" alt="">
                @endif
                @if ($site_setting->title_image)
                <h2 class="px-4 uppercase font-bold text-slate-500 text-[20px]"> {{ $site_setting->page_title }}</h2>
                @endif
                
                
            </div>
            <div class="my-5">
                <p class="my-4 capitalize font-semibold text-xl text-gray-600"> hi {{ auth()->user()->last_name }} </p>
                <p class="my-2 font-semibold text-gray-600">
                    You registered an account on customer portal, before being able
                    to use your account you need to verify that this is your email address. <br>
                </p>
                <p class="my-2 font-semibold text-gray-600">
                    A fresh verification link has been sent to your email address.
                    Before proceeding, please check your email for a verification link
                    If you did not receive the email
                    
                </p>
                <form class="my-4" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="bg-orange-500 px-6 py-2 rounded-md text-white transition duration-300 hover:bg-orange-600">{{ __('click here to request another') }}</button>.
                </form>
                <p class="my-4 capitalize font-semibold text-xl text-gray-600">Regards, {{ $site_setting->page_title }} </p>
            </div>
        </div>
    </div>
</div>
@endsection
