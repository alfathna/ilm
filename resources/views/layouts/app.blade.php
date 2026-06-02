<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Dynamic SEO Meta Tags --}}
    @php
        $siteName = \App\Models\WebSetting::get('site_name', config('news_portal.site.name', 'Info Lantas Mojokerto'));
        $siteDesc = \App\Models\WebSetting::get('site_description', config('news_portal.site.description', ''));
    @endphp
    <title>{{ $seo['title'] ?? $siteName }}</title>
    <meta name="description" content="{{ $seo['description'] ?? $siteDesc }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? config('news_portal.seo.default_keywords', '') }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seo['title'] ?? $siteName }}">
    <meta property="og:description" content="{{ $seo['description'] ?? $siteDesc }}">
    @if(!empty($seo['og_image']))
    <meta property="og:image" content="{{ $seo['og_image'] }}">
    @endif
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Dynamic Theme Color from Admin --}}
    @php $themeColor = \App\Models\WebSetting::get('theme_color', '#dc2626'); @endphp
    <style>:root { --color-primary: {{ $themeColor }}; }</style>

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="flex flex-col min-h-[100dvh]">
        {{-- Top Bar --}}
        @include('layouts.partials.topbar')

        {{-- Navigation --}}
        @include('layouts.partials.navbar')

        {{-- Breaking News Ticker --}}
        <x-breaking-news />

        {{-- Page Content --}}
        <main class="flex-grow bg-white">
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </main>

        {{-- Footer --}}
        @include('layouts.partials.footer')
    </div>

    {{-- Popup (once per session) --}}
    <x-popup />

    @stack('scripts')
</body>
</html>
