<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if($site_setting)
        <title> {{ $site_setting->page_title }} </title>
        @if ($site_setting->page_title)
        <meta name="title" content="{{ $site_setting->page_title }}">
        @endif
        <link rel="shortcut icon" href="{{ asset($site_setting->title_image)}}" type="image/x-icon">
        
        <meta name="description" content="{{ $site_setting->seo_content }}">
        <meta name="verify-v1" content="{{ $site_setting->page_title }}">
        <meta name="robots" content="{{ $site_setting->seo_tag }}">
        <meta property="og:image" content="{{ asset($site_setting->share_image) }}">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="400">
        <meta property="og:image:height" content="400">
    @endif
    

    {{-- current-user  --}}

    @if (Auth::check()) 
        <meta name="user-slug" content="{{ Auth::user()->slug }}" />
        @if (Auth::user()->profile_img)
            <meta name="user-img" content="{{ Auth::user()->profile_img }}">
        @else
            <meta name="user-img" content="{{ false }}">
        @endif
        
    @else
    <meta name="user-slug" content="{{ false}}" />
    <meta name="user-img" content="{{ false }}">
    @endif 

    

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div id="app">
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
