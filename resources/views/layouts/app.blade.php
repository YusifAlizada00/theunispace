<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TheUniSpace') }} – Track Goals, Stay Motivated, Achieve Together</title>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <meta name="description"
        content="Join TheUniSpace to track your goals, stay motivated with friends, and achieve your dreams together. Collaborate, share, and succeed!">

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description"
        content="Achieve your goals with friends. Share goals, get motivated, and stay consistent.">
    <meta property="og:image" content="/icons/icon-512.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#10b981">
    <link rel="apple-touch-icon" href="/icons/apple-icon-180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="apple-touch-startup-image" href="/icons/apple-splash-2048-2732.png"
        media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ showReportModal: false }">

    <div id="awayNotice" class="hidden fixed bottom-5 right-5 bg-gray-900 text-white px-4 py-3 rounded-xl z-50 shadow-lg items-center gap-3">
        <span>You were away for a while</span>
        <button onclick="resumeSession()"
            class="ml-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-3 py-1 rounded-md transition">
            Continue
        </button>
    </div>

    <script>
        // Register Service Worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then(reg => console.log('Service Worker registered')) // Removed reg object to reduce console noise
                .catch(err => console.error('Service Worker failed:', err));
        }

        window.Laravel = { user: @json(auth()->user()) };

        let awayTimer;
        let isOut = false;
        const awayNotice = document.getElementById('awayNotice');

        /* ------------------ INACTIVITY SYSTEM ------------------ */
        function showAwayNotice() {
            if (!window.Laravel.user) return;
            // Use Tailwind 'flex' to show, 'hidden' to hide
            awayNotice.classList.remove('hidden');
            awayNotice.classList.add('flex');
        }

        function resumeSession() {
            // Hide immediately for better UX
            awayNotice.classList.add('hidden');
            awayNotice.classList.remove('flex');

            // Ping server to refresh session - DO NOT RELOAD unless error
            fetch(window.location.href, { method: 'HEAD' })
                .then(r => {
                    if (r.status === 419 || r.status === 401) {
                        window.location.reload(); // Only reload if session actually died
                    }
                })
                .catch(e => console.log('Network error, session might be intact'));
        }

        function resetAwayTimer() {
            clearTimeout(awayTimer);
            awayTimer = setTimeout(showAwayNotice, 1000 * 60 * 60); // 1 hour
        }

        // Reduced event listeners for better performance
        ['mousemove', 'keydown', 'click'].forEach(evt =>
            document.addEventListener(evt, resetAwayTimer, { passive: true })
        );

        /* ------------------ LOGOUT DETECTION ------------------ */
        document.addEventListener('submit', e => {
            if (e.target.action && e.target.action.includes('logout')) isOut = true;
        });

        document.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (link && link.href && link.href.includes('logout')) isOut = true;
        });

        /* ------------------ LIVEWIRE ERROR HANDLING ------------------ */
        // Support for Livewire v3
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request.fail', ({ status, preventDefault }) => {
                if (isOut) return;
                if (status === 419) {
                    preventDefault();
                    window.location.reload();
                }
            });
        });

        // Fallback for Livewire v2 (You can remove this block if using v3)
        document.addEventListener('livewire:load', () => {
             Livewire.onError(code => {
                if (isOut) return false;
                if (code === 419) {
                    window.location.reload();
                    return false;
                }
            });
        });

        /* ------------------ SESSION AUTO-HEALER ------------------ */
        const checkSession = () => {
            if (!window.Laravel.user || isOut) return;
            if (document.visibilityState !== 'visible') return; // Don't ping if tab is hidden

            fetch(window.location.href, { method: 'HEAD' })
                .then(r => {
                    if (r.status === 419 || r.status === 401) {
                        window.location.reload();
                    }
                })
                .catch(() => {}); // Do nothing on network error to avoid loops
        };

        setInterval(checkSession, 1000 * 60 * 15);

    </script>

    @auth
        <livewire:follow-unfollow-toast />
    @endauth

    <x-banner />

    <div class="min-h-screen bg-white">
        @livewire('navigation-menu')

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @livewireScripts
</body>
</html>