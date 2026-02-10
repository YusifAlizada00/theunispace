<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'TheUniSpace') }} – Track Goals, Stay Motivated, Achieve Together</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="description" content="Join TheUniSpace to track your goals, stay motivated with friends, and achieve your dreams together. Collaborate, share, and succeed!">

    <!-- SEO -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- OG Tags -->
    <meta property="og:title" content="{{ config('app.name', 'TheUniSpace') }}">
    <meta property="og:description" content="Achieve your goals with friends. Share goals, stay motivated, and accomplish more.">
    <meta property="og:image" content="/icons/icon-512.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#10b981">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" media="print" onload="this.media='all'" />
    <noscript>
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    </noscript>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire -->
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased bg-white">

<script>
         if('serviceWorker' in navigator)
        {
            navigator.serviceWorker.register('/service-worker.js');
        }
</script>

    <!-- PAGE CONTENT -->
    <div>
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
