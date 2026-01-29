<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GOAL') }}</title>

    <!-- SEO -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description"
        content="Achieve your goals with friends. Share goals, get motivated, and stay consistent.">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description"
        content="Achieve your goals with friends. Share goals, get motivated, and stay consistent.">
    <meta property="og:image" content="/icons/icon-512.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#10b981">
    <link rel="apple-touch-icon" href="/icons/icon-192.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased" x-data="{ showReportModal: false }">

    <!-- Inactivity Notice -->
    <div id="awayNotice"
        style="display:none; position:fixed; bottom:20px; right:20px; background:#111; color:#fff; padding:12px 16px; border-radius:12px; z-index:9999;">
        You were away for a while
        <button onclick="resumeSession()"
            style="margin-left:10px; background:#22c55e; color:white; padding:4px 10px; border-radius:6px;">
            Continue
        </button>
    </div>

    <script>
        window.Laravel = { user: @json(auth()->user()) };

        let awayTimer;
        let isOut = false;

        /* ------------------ INACTIVITY SYSTEM ------------------ */

        function showAwayNotice() {
            if (!window.Laravel.user) return;
            const notice = document.getElementById('awayNotice');
            if (notice.style.display === 'block') return;
            notice.style.display = 'block';
        }

        function resumeSession() {
            document.getElementById('awayNotice').style.display = 'none';

            fetch(window.location.href, { method: 'HEAD' })
                .then(() => window.location.reload())
                .catch(() => window.location.reload());
        }

        function resetAwayTimer() {
            clearTimeout(awayTimer);
            awayTimer = setTimeout(showAwayNotice, 1000 * 60 * 60); // 1 hour
        }

        ['mousemove', 'keydown', 'scroll', 'click'].forEach(evt =>
            document.addEventListener(evt, resetAwayTimer)
        );

        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') resetAwayTimer();
        });

        resetAwayTimer();

        /* ------------------ LOGOUT DETECTION ------------------ */

        document.addEventListener('submit', e => {
            if (e.target.action?.includes('logout')) isOut = true;
        });

        document.addEventListener('click', e => {
            if (e.target.closest('a')?.href?.includes('logout')) isOut = true;
        });

        /* ------------------ LIVEWIRE ERROR HANDLING ------------------ */

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

            fetch(window.location.href, { method: 'HEAD' })
                .then(r => {
                    if (r.status === 419 || r.status === 401) {
                        window.location.reload();
                    }
                })
                .catch(() => {});
        };

        setInterval(checkSession, 1000 * 60 * 15);

        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') checkSession();
        });

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
