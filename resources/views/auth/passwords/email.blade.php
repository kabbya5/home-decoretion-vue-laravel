@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8">
    <div class="w-96 mx-auto">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="flex justify-center">
        <div class="w-96 bg-gray-200/60 px-4 py-4">
            <div class="flex items-center">
                {{ __('Reset Password')  }}
            </div>
            <div class="my-5">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="">{{ __('Email Address') }}</label>

                        <div class="">
                            <input id="email" type="email" class="mt-3 py-2 px-2 outline-none bg-gray-200 w-full border-2 border-gray-200 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="bg-cyan-500 px-4 py-2 text-white rounded-lg my-4">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
