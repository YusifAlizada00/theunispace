<nav x-data="{ mobileMenuOpen: false }">
    <style>
        @media (max-width: 768px) {
            main {
                padding-top: 5rem !important;
                /* For Top Bar */
                padding-bottom: 8rem !important;
                /* For Bottom Bar */
            }
        }
    </style>

    {{-- 1. DESKTOP TOP BAR (Teams) --}}
    <div class="hidden md:block">
        <div class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-3 bg-white/80 backdrop-blur-xl border-b border-gray-100 shadow-sm ml-[80px] xl:ml-[220px] w-[calc(100%-80px)] xl:w-[calc(100%-220px)] transition-all">
            <div class="flex items-center ml-auto">
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-bold rounded-2xl text-gray-600 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                                    {{ Auth::user()->currentTeam->name }}
                                    <svg class="ms-2 -me-0.5 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <div class="block px-4 py-2 text-xs text-gray-400 uppercase tracking-wider font-bold">
                                        {{ __('Manage Team') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">{{ __('Team Settings') }}</x-dropdown-link>
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">{{ __('Create New Team') }}</x-dropdown-link>
                                    @endcan
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-100 my-1"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-400 uppercase tracking-wider font-bold">
                                            {{ __('Switch Teams') }}
                                        </div>
                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif
            </div>
        </div>

        {{-- 2. DESKTOP SIDEBAR --}}
        <div class="fixed h-full bg-white/95 backdrop-blur-2xl px-4 xl:w-[220px] w-[80px] border-r border-gray-100 shadow-[4px_0_24px_rgba(0,0,0,0.02)] flex flex-col pt-6 pb-6 z-50">

            {{-- Logo Area --}}
            <div class=" md:-ml-1 -mr-9 px-0 py-0 mb-4 -mt-4">
                <a href="{{ auth()->check() ? route('dashboard.all.posts') : '/' }}" class="whitespace-nowrap flex items-center gap-2" aria-label="TheUniSpace Home">
                    <img src="{{ asset('webImages/theunispace-logo-tiny.png') }}" alt="TheUniSpace Logo" loading="eager" class=" w-26 h-12 mt-8">
                </a>
            </div>

            {{-- Profile --}}
            <div class="mb-4">
                @auth
                    {{-- LOGGED IN PROFILE --}}
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <a href="{{ route('posts.all', ['name' => Auth::user()->slug]) }}" aria-label="View Profile"
                           class="{{ (request()->routeIs('posts.all', 'posts.saved', 'posts.liked', 'lost.items', 'study.groups.currently.in', 'profile.edit') && (request()->routeIs('profile.edit') || request()->route('name') === Auth::user()->slug))
                            ? 'flex items-center gap-3 w-full rounded-2xl bg-gray-200 text-gray-900 p-3 shadow-lg shadow-slate-900/20 transform transition-all duration-200'
                            : 'group flex items-center gap-3 w-full rounded-2xl hover:bg-gray-300 hover:shadow-md border border-transparent hover:border-gray-100 p-3 transition-all duration-200'}}">
                            <div class="w-10 h-10 flex-shrink-0 relative">
                                <img class="rounded-full object-cover w-full h-full border-2 border-white shadow-sm group-hover:scale-105 transition-transform duration-300 -ml-2"
                                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" loading="lazy">
                                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="xl:flex flex-col hidden overflow-hidden">
                                <span class="font-bold text-sm truncate {{ (request()->routeIs('posts.all', 'posts.saved', 'posts.liked', 'lost.items', 'study.groups.currently.in', 'profile.edit') && (request()->routeIs('profile.edit') || request()->route('name') === Auth::user()->slug)) ? 'text-gray-900' : 'text-gray-900 group-hover:text-gray-900' }}">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] uppercase tracking-wider font-bold {{ (request()->routeIs('posts.all', 'posts.saved', 'posts.liked', 'lost.items', 'study.groups.currently.in', 'profile.edit') && (request()->routeIs('profile.edit') || request()->route('name') === Auth::user()->slug)) ? 'text-gray-400' : 'text-gray-400' }}">View Profile</span>
                            </div>
                        </a>
                    @endif
                @else
                    {{-- GUEST PROFILE TEASER --}}
                    <a href="{{ route('login') }}" class="group flex items-center gap-3 w-full rounded-2xl hover:bg-emerald-50 border border-transparent hover:border-emerald-100 p-3 transition-all duration-200">
                        <div class="w-10 h-10 flex-shrink-0 relative">
                            <div class="w-full h-full rounded-full bg-emerald-100 flex items-center justify-center -ml-2">
                                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                        </div>
                        <div class="xl:flex flex-col hidden overflow-hidden">
                            <span class="font-bold text-sm truncate text-gray-900">Welcome!</span>
                            <span class="text-[10px] uppercase tracking-wider font-bold text-emerald-600">Log In Now</span>
                        </div>
                    </a>
                @endauth
            </div>

            {{-- Main Links (Visible to ALL, but redirect Guests to Login) --}}
            <div class="flex-1 space-y-2 relative overflow-y-auto scrollbar-hide px-1">

                {{-- Feed --}}
                <a href="{{ auth()->check() ? route('dashboard.all.posts') : '/' }}" aria-label="Feed"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('dashboard.all.posts') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="relative flex-shrink-0 -ml-2">
                        <svg class="w-6 h-6 {{ request()->routeIs('dashboard.all.posts') ? 'text-black' : 'text-gray-700' }}"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        @if(request()->routeIs('dashboard.all.posts'))
                            <span class="absolute -right-1 -top-1 w-2 h-2 bg-purple-500 rounded-full animate-pulse"></span>
                        @endif
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Feed</span>
                </a>

                {{-- Search --}}
                <a href="{{ auth()->check() ? route('search') : route('login') }}" aria-label="Search"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('search', 'search.results') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="flex-shrink-0 -ml-2">
                        <img src="{{ asset('icons/search.png') }}" alt="Search" loading="lazy"
                             class="w-6 h-6 transition-transform duration-300
                             {{ request()->routeIs('search', 'search.results') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0 group-hover:scale-110' }}">
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Search</span>
                </a>

                {{-- Study Groups --}}
                <a href="{{ auth()->check() ? route('study-groups') : route('login') }}" aria-label="Study Groups"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('study-groups', 'study-groups.show', 'study-groups.edit', 'study-groups.create') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="flex-shrink-0 -ml-2">
                        <img src="{{ asset('icons/group.png') }}" alt="Study Groups" loading="lazy"
                             class="w-6 h-6 transition-transform duration-300 group-hover:scale-110
                             {{ request()->routeIs('study-groups', 'study-groups.show', 'study-groups.edit', 'study-groups.create') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0' }}">
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Study Groups</span>
                </a>

                {{-- Lost & Found --}}
                <a href="{{ auth()->check() ? route('lost-found') : route('login') }}" aria-label="Lost & Found"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('lost-found', 'contact-form', 'report-lost', 'lost-report.show') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="flex-shrink-0 -ml-2">
                        <img src="{{ asset('icons/lost.png') }}" alt="Lost" loading="lazy"
                             class="w-6 h-6 transition-transform duration-300 group-hover:scale-110
                             {{ request()->routeIs('lost-found', 'contact-form', 'report-lost', 'lost-report.show') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0' }}">
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Lost & Found</span>
                </a>

                {{-- Parking --}}
                <a href="{{ auth()->check() ? route('map.show') : route('login') }}" aria-label="Free Parking"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('map.show') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="flex-shrink-0 -ml-2">
                        <img src="{{ asset('icons/car-parking.png') }}" alt="Parking" loading="lazy"
                             class="w-6 h-6 transition-transform duration-300 group-hover:scale-110
                             {{ request()->routeIs('map/show') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0' }}">
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Free Parking</span>
                </a>

                {{-- Notifications --}}
                <div class="px-1 py-1">
                    @auth
                        <livewire:get-number-of-notification />
                    @else
                        {{-- Dummy Bell for Guests --}}
                        <a href="{{ route('login') }}" class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl text-gray-500 hover:bg-gray-300 hover:text-gray-900 transition-all duration-200">
                            <div class="flex-shrink-0 -ml-2 relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            </div>
                            <span class="font-bold text-sm min-w-[90px]">Notifications</span>
                        </a>
                    @endauth
                </div>

                {{-- Help & Support --}}
                <a href="{{ auth()->check() ? route('help-support', parameters: ['name' => Auth::user()->slug]) : route('login') }}" aria-label="Help & Support"
                   class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                        {{ request()->routeIs('help-support') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                    <div class="flex-shrink-0 -ml-2">
                        <img src="{{ asset('icons/help.png') }}" alt="Help" loading="lazy"
                             class="w-6 h-6 transition-transform duration-300 group-hover:scale-110
                             {{ request()->routeIs('help-support') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0' }}">
                    </div>
                    <span class="font-bold text-sm min-w-[90px]">Help & Support</span>
                </a>
            </div>


            {{-- Logout / Sign Up --}}
            <div class="absolute bottom-5 left-0 w-full border-t border-gray-100 bg-white/60 backdrop-blur-xl px-2 lg:px-3 xl:px-4 py-6 pl-5">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="group flex items-center gap-3 w-full rounded-xl py-2 text-slate-500 transition-all duration-300 hover:text-red-600 hover:bg-red-100">
                            <div class="flex items-center justify-center transition-transform group-hover:scale-110 group-hover:rotate-6 pl-2">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-6 h-6 text-slate-400 transition-colors duration-300 group-hover:text-red-500"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <span class="xl:block hidden text-sm font-bold tracking-tight whitespace-nowrap">Log Out</span>
                        </button>
                    </form>
                @else
                    {{-- GUEST: Show Sign Up Link --}}
                    <a href="{{ route('register') }}"
                       class="group flex items-center gap-3 w-full rounded-xl py-2 text-slate-500 transition-all duration-300 hover:text-emerald-600 hover:bg-emerald-50">
                        <div class="flex items-center justify-center transition-transform group-hover:scale-110 pl-2">
                            <svg class="w-6 h-6 text-slate-400 transition-colors duration-300 group-hover:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        </div>
                        <span class="xl:block hidden text-sm font-bold tracking-tight whitespace-nowrap">Sign Up</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- MOBILE HEADER --}}
    <div class="md:hidden">
        <div class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-xl border-b border-gray-100 px-2 sm:px-4 py-3 flex items-center justify-between gap-4 sm:gap-8 transition-all duration-300 shadow-sm">

            <div class="shrink-0 flex items-center relative z-50 pr-4">
                <a href="/" class="block" aria-label="TheUniSpace Home">
                    <img src="{{ asset('webImages/theunispace-logo-tiny.png') }}" 
                        alt="TheUniSpace Logo" loading="eager"
                        class="h-10 w-auto object-contain -mt-3">
                </a>
            </div>

            {{-- SEARCH COMPONENT (Visual for Guest, Functional for Auth) --}}
            @auth
                {{-- LOGGED IN: FUNCTIONAL SEARCH --}}
                <div class="flex-1 relative min-w-0 max-w-md -ml-5" x-data="searchComponent()" @click.outside="open = false">
                    <form action="" onsubmit="return false;"
                        class="relative flex items-center bg-gray-100 rounded-full px-2 sm:px-3 py-1.5 w-full">
                        <button type="button" @click="toggleScope"
                            class="shrink-0 flex items-center text-xs font-semibold text-gray-500 mr-1.5 border-r border-gray-300 pr-1.5">
                            <span x-text="scopeLabel" class="truncate max-w-[50px] sm:max-w-none"></span>
                            <span class="ml-0.5">▾</span>
                        </button>
                        <input type="search" name="site_search_unique" autocomplete="off" placeholder="Search..."
                            x-model="query" @input.debounce.300ms="search" @keydown.escape="open = false"
                            class="w-full bg-transparent border-none p-0 text-sm text-gray-700 placeholder-gray-400 focus:ring-0 focus:outline-none h-6 leading-6">
                        <svg class="w-4 h-4 text-gray-400 shrink-0 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </form>
                    <div x-show="showScope" x-transition style="display: none;"
                        class="absolute left-0 top-full z-50 mt-1 bg-white border rounded-lg shadow-lg w-32 sm:w-44 text-sm">
                        <template x-for="option in scopes">
                            <button @click="selectScope(option)"
                                class="block w-full text-left px-3 py-2 hover:bg-gray-100 truncate">
                                <span x-text="option.label"></span>
                            </button>
                        </template>
                    </div>
                    <div x-show="open" x-transition style="display: none;"
                        class="absolute left-0 top-full z-40 w-full mt-2 bg-white border rounded-xl shadow-lg max-h-72 overflow-y-auto">
                        <template x-if="results.students?.length && scope === 'students'">
                            <div>
                                <p class="px-4 pt-3 text-xs font-bold text-gray-400 uppercase">Students</p>
                                <template x-for="user in results.students" :key="user.id">
                                    <a :href="`/profile/@${user.slug}/posts`"
                                        class="block px-4 py-2 text-sm hover:bg-indigo-50 truncate" x-text="user.name"></a>
                                </template>
                            </div>
                        </template>
                        <template x-if="results.groups?.length && scope === 'groups'">
                            <div>
                                <p class="px-4 pt-3 text-xs font-bold text-gray-400 uppercase">Groups</p>
                                <template x-for="group in results.groups" :key="group.id">
                                    <a :href="`/groups/${group.id}`"
                                        class="block px-4 py-2 text-sm hover:bg-indigo-50 truncate"
                                        x-text="group.group_name"></a>
                                </template>
                            </div>
                        </template>
                        <template x-if="results.items?.length && scope === 'items'">
                            <div>
                                <p class="px-4 pt-3 text-xs font-bold text-gray-400 uppercase">Lost</p>
                                <template x-for="item in results.items" :key="item.id">
                                    <a :href="`/lost-found/${item.id}`"
                                        class="block px-4 py-2 text-sm hover:bg-indigo-50 truncate"
                                        x-text="item.item_name"></a>
                                </template>
                            </div>
                        </template>
                        <div x-show="noResults" class="px-4 py-3 text-sm text-gray-400">
                            No results found.
                        </div>
                    </div>
                </div>
            @else
                {{-- GUEST: FAKE INPUT (REDIRECTS TO LOGIN) --}}
                <div class="flex-1 relative min-w-0 max-w-md -ml-5">
                    <a href="{{ route('login') }}" class="relative flex items-center bg-gray-100 rounded-full px-2 sm:px-3 py-1.5 w-full">
                        <span class="shrink-0 flex items-center text-xs font-semibold text-gray-500 mr-1.5 border-r border-gray-300 pr-1.5">All ▾</span>
                        <span class="w-full text-sm text-gray-400 h-6 leading-6">Search...</span>
                        <svg class="w-4 h-4 text-gray-400 shrink-0 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" /></svg>
                    </a>
                </div>
            @endauth

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Menu Button" id="Menu Button" title="Menu Button"
                class="shrink-0 p-2 rounded-2xl text-slate-600 hover:bg-slate-100 transition active:scale-95 focus:outline-none">
                <div class="relative w-5 h-5">
                    <span class="absolute block w-5 h-0.5 bg-current rounded-full transition-all duration-300 ease-in-out" :class="mobileMenuOpen ? 'top-2.5 rotate-45' : 'top-1'"></span>
                    <span class="absolute block w-3 h-0.5 bg-current rounded-full right-0 transition-all duration-300 ease-in-out" :class="mobileMenuOpen ? 'opacity-0' : 'top-2.5'"></span>
                    <span class="absolute block w-5 h-0.5 bg-current rounded-full transition-all duration-300 ease-in-out" :class="mobileMenuOpen ? 'top-2.5 -rotate-45' : 'top-4'"></span>
                </div>
            </button>
        </div>

        {{-- Search Script --}}
        <script>
            function searchComponent() {
                return {
                    query: '',
                    open: false,
                    showScope: false,
                    scope: 'students',

                    scopes: 
                        [
                            { 
                                value: 'students', 
                                label: 'People' 
                            }, 
                            { 
                                value: 'groups', 
                                label: 'Groups' 
                            }, 
                            { 
                                value: 'items',
                                label: 'Lost' }],
                    results: { 
                        students: [], 
                        groups: [], 
                        items: [] 
                    },

                    get scopeLabel() { 
                        return this.scopes.find(s => s.value === this.scope).label; 
                    },
                    
                    get noResults() { 
                        return this.open && ((this.scope === 'students' && !this.results.students.length) 
                        || (this.scope === 'groups' && !this.results.groups.length) 
                        || (this.scope === 'items' && !this.results.items.length)); 
                    },

                    toggleScope() { 
                        this.showScope = !this.showScope; 
                    },

                    selectScope(option) { 
                        this.scope = option.value; 
                        this.showScope = false; 
                        this.search(); 
                    },

                    search() {
                        if (!this.query.trim()) { 
                            this.open = false; return; 
                        }
                        fetch(`/search-results?query=${encodeURIComponent(this.query)}&type=${this.scope}`).then(res => res.json()).then(data => { this.results = data; this.open = true; });
                    }
                }
            }
        </script>

        {{-- MOBILE MENU DROPDOWN --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-full"
            class="fixed inset-0 z-40 bg-slate-50/95 backdrop-blur-3xl pt-24 pb-32 px-6 overflow-y-auto"
            style="display: none;">
            
            {{-- Guest Login Buttons in Mobile Menu --}}
            @guest
                <div class="mb-8 text-center">
                    <a href="{{ route('register') }}" class="block w-full py-3 bg-slate-900 text-white font-bold rounded-xl mb-3">Sign Up</a>
                    <a href="{{ route('login') }}" class="block w-full py-3 text-slate-700 font-bold border border-gray-200 rounded-xl">Log In</a>
                </div>
            @endguest

            <div class="mb-8">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 pl-1">Applications</h2>
                <div class="grid grid-cols-2 gap-4">
                    {{-- Lost & Found --}}
                    <a href="{{ auth()->check() ? route('lost-found') : route('login') }}" aria-label="Lost & Found"
                        class="flex flex-col items-center justify-center p-5 rounded-[2rem] bg-white border border-gray-100 shadow-sm active:scale-95 transition-all duration-200 hover:border-orange-200 hover:shadow-orange-100/50">
                        <div class="p-3 bg-orange-50 rounded-2xl mb-3 text-orange-600"><img loading="lazy"
                                src="{{ asset('icons/lost.png') }}" class="w-7 h-7" alt="Lost"></div>
                        <span class="font-bold text-slate-700 text-sm">Lost & Found</span>
                    </a>

                    {{-- Notifications --}}
                    <livewire:get-number-of-notification>
                    {{-- Support --}}
                    <a href="{{ auth()->check() ? route('help-support', ['name' => Auth::user()->slug]) : route('login') }}" aria-label="Help & Support"
                        class="flex flex-col items-center justify-center p-5 rounded-[2rem] bg-white border border-gray-100 shadow-sm active:scale-95 transition-all duration-200 hover:border-purple-200 hover:shadow-purple-100/50">
                        <div class="p-3 bg-purple-50 rounded-2xl mb-3 text-purple-600"><img loading="lazy"
                                src="{{ asset('icons/help.png') }}" class="w-7 h-7" alt="Help"></div>
                        <span class="font-bold text-slate-700 text-sm">Support</span>
                    </a>

        
                </div>
            </div>
        </div>
    </div>

    {{-- 3. MOBILE FLOATING BOTTOM BAR (Visible to All) --}}
    <div class="fixed bottom-5 left-4 right-4 flex justify-between items-center px-5 py-3 bg-white/90 backdrop-blur-xl border border-white/40 shadow-[0_8px_32px_rgba(0,0,0,0.12)] rounded-3xl z-40 md:hidden">
        
        {{-- Home --}}
        <a href="{{ auth()->check() ? route('dashboard.all.posts') : '/' }}" aria-label="Feed"
            class="flex flex-col hover:bg-gray-100 p-2 rounded-xl items-center gap-1 transition-all duration-300 {{ request()->routeIs('dashboard.all.posts') ? 'scale-110 bg-gray-300' : 'opacity-60' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
        </a>

        {{-- Study Groups (Redirects Guest) --}}
        <a href="{{ auth()->check() ? route('study-groups') : route('login') }}" aria-label="Study Groups"
            class="flex flex-col hover:bg-gray-100 p-2 rounded-xl items-center gap-1 transition-all duration-300 {{ request()->routeIs('study-groups', 'study-groups.show', 'study-groups.edit', 'study-groups.create') ? 'scale-110 bg-gray-300' : 'opacity-60' }}">
            <img src="{{ asset('icons/group.png') }}" class="w-7 h-7" alt="Study Groups" loading="lazy">
        </a>

        {{-- CREATE BUTTON (Redirects Guest) --}}
        <div class="-mt-12">
            <a href="{{ auth()->check() ? route('post.create') : route('login') }}" aria-label="Create Post"
                class="flex items-center justify-center w-16 h-16 bg-slate-900 rounded-full shadow-xl shadow-slate-900/40 border-[4px] border-white transition-transform duration-300 active:scale-90 hover:scale-110 hover:rotate-90">
                <img src="{{ asset('icons/add.png') }}" class="w-7 h-7 invert brightness-0" alt="Add Icon" loading="lazy">
            </a>
        </div>

        {{-- Parking (Redirects Guest) --}}
        <a href="{{ auth()->check() ? route('map.show') : route('login') }}" aria-label="Free Parking"
            class="flex flex-col hover:bg-gray-100 p-2 rounded-xl items-center gap-1 transition-all duration-300 {{ request()->routeIs('map.show') ? 'scale-110 bg-gray-300' : 'opacity-60' }}">
            <img src="{{ asset('icons/car-parking.png') }}" class="w-7 h-7" alt="Parking Icon" loading="lazy">
        </a>

        {{-- Profile (Redirects Guest) --}}
        @auth
            <a href="{{ route('posts.all', ['name' => Auth::user()->slug]) }}" aria-label="View Profile"
                class="flex flex-col hover:bg-gray-100 p-2 rounded-xl items-center gap-1 transition-all duration-300 {{ request()->routeIs('posts.all', 'posts.saved', 'posts.liked', 'lost.items', 'study.groups.currently.in', 'profile.edit') ? 'scale-110 bg-gray-300' : 'opacity-60' }}">
                <img class="rounded-full object-cover w-8 h-8 border border-gray-200" loading="lazy" alt="Photo"
                    src="{{ Auth::user()->profile_photo_url }}" />
            </a>
        @else
            <a href="{{ route('login') }}" aria-label="Log In"
                class="flex flex-col hover:bg-gray-100 p-2 rounded-xl items-center gap-1 transition-all duration-300 opacity-60">
                {{-- Generic User Icon --}}
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            </a>
        @endauth
    </div>
</nav>