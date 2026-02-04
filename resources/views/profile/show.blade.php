<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-8 md:pl-[80px] xl:pl-[220px]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                
                {{-- LEFT SIDEBAR (Profile) --}}
                <div class="md:col-span-4 lg:col-span-3">
                    <div class="md:sticky md:top-24 space-y-6 max-h-[calc(100vh-8rem)] overflow-y-auto scrollbar-hide">                       
                        <div class="bg-white rounded-3xl p-6 shadow-xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden group">                
                            <div class="relative flex flex-col items-center text-center">
                                <div class="relative mb-4">
                                    @if (Auth::check() && $user->id === Auth::id())
                                        <a href="{{ route('profile.edit', ['name' => Auth::user()->slug]) }}" class="block relative group/avatar">
                                            <img src="{{ $user->profile_photo_url }}" alt="Profile"
                                                class="w-32 h-32 sm:w-48 sm:h-48 rounded-2xl object-cover shadow-lg border-4 border-white transform transition duration-300 group-hover/avatar:scale-105 group-hover/avatar:rotate-2">
                                            <div class="absolute inset-0 bg-black/30 rounded-2xl flex items-center justify-center opacity-0 group-hover/avatar:opacity-100 transition duration-300 backdrop-blur-[2px]">
                                                <span class="text-white text-xs font-bold uppercase tracking-wider">Edit</span>
                                            </div>
                                        </a>
                                    @else
                                        <img src="{{ $user->profile_photo_url }}" alt="Profile"
                                            class="w-32 h-32 sm:w-48 sm:h-48 rounded-2xl object-cover shadow-lg border-4 border-white">
                                    @endif
                                </div>

                                <h1 class="text-2xl font-black text-gray-900 tracking-tight">
                                    {{ $user->name }}
                                    @if($user->is_admin)
                                        <img src="{{ asset('icons/check.png') }}" alt="Verified" class="h-5 w-5 inline-block ml-1 align-top relative top-1">
                                    @endif
                                </h1>
                                <p class="text-sm font-medium text-gray-400 mt-1">{{ $user->major ?? null }}</p>

                                <div class="mt-6 w-full text-left bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">About</h3>
                                    @if($user->bio)
                                        <p class="text-gray-700 text-sm leading-relaxed font-medium">
                                            {!! \Illuminate\Support\Str::of($user->bio)
                                            // 1. Convert URLs to clickable links
                                            ->replaceMatches(
                                                '/(https?:\/\/[^\s]+)/',
                                                '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline hover:text-blue-800">$1</a>'
                                            )
                                            // 2. Convert newlines to <br> tags
                                            ->replace("\n", replace: '<br>') !!}
                                        </p>
                                    @else
                                        <p class="text-gray-400 text-sm italic">No bio added yet.</p>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-4 w-full mt-6 pt-6 border-t border-gray-100">
                                    <a href="{{ route('follower.list', ['name' => $user->slug]) }}" class="group/stat flex flex-col items-center p-2 rounded-xl hover:bg-gray-50 transition">
                                        <span class="text-xl font-black text-gray-800 group-hover/stat:text-blue-600 transition-colors">{{ $user->followers()->count() }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase tracking-wider font-bold">Followers</span>
                                    </a>
                                    <a href="{{ route('followings.list', ['name' => $user->slug]) }}" class="group/stat flex flex-col items-center p-2 rounded-xl hover:bg-gray-50 transition">
                                        <span class="text-xl font-black text-gray-800 group-hover/stat:text-blue-600 transition-colors">{{ $user->following()->count() }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase tracking-wider font-bold">Following</span>
                                    </a>
                                </div>

                                <div class="w-full mt-6 space-y-3">
                                    @if(auth()->id() === $user->id)
                                        <a href="{{ route('profile.edit', ['name' => Auth::user()->slug]) }}" 
                                        class="block w-full py-2.5 bg-black text-white rounded-xl font-bold text-sm hover:bg-gray-800 transition shadow-lg shadow-gray-200 transform hover:-translate-y-0.5">
                                            Edit Profile
                                        </a>
                                        <div class="md:hidden">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full py-2.5 border-2 border-gray-100 text-gray-500 rounded-xl font-bold text-sm hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition">
                                                    Log Out
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="w-full">
                                            <livewire:follow-button :user="$user" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-8 lg:col-span-9">
                    
                    <div class="z-30 bg-gray-50/95 backdrop-blur-md py-4 mb-6 -mx-4 px-4 sm:mx-0 sm:px-0 transition-all">
                        <nav class="flex items-center justify-center w-full py-2 md:py-4">
                            <div class="flex items-center w-full md:w-auto p-1 space-x-1 md:space-x-2 bg-white/50 backdrop-blur-sm border border-gray-100 rounded-xl md:rounded-full shadow-sm">
                                
                                @php
                                    $baseClass = "group flex-1 md:flex-none flex items-center justify-center py-3 md:px-6 md:py-3 rounded-lg md:rounded-full transition-all duration-300 ease-out select-none whitespace-nowrap";
                                    
                                    $activeClass = "bg-indigo-600 text-white shadow-lg shadow-indigo-500/30 ring-1 ring-indigo-600";
                                    
                                    $inactiveClass = "text-gray-500 hover:bg-indigo-50 hover:text-indigo-600";
                                @endphp

                                {{-- 1. FEED --}}
                                <a href="{{ route('posts.all', ['name' => $user->slug]) }}" 
                                class="{{ $baseClass }} {{ request()->routeIs('posts.all') ? $activeClass : $inactiveClass }}"
                                title="Feed">
                                    <svg class="w-6 h-6 md:w-5 md:h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="hidden md:block md:ml-2 font-semibold text-sm">Feed</span>
                                </a>

                                @if(auth()->id() === $user->id)
                                    {{-- 2. SAVED --}}
                                    <a href="{{ route('posts.saved', ['name' => $user->slug]) }}" 
                                    class="{{ $baseClass }} {{ request()->routeIs('posts.saved') ? $activeClass : $inactiveClass }}"
                                    title="Saved">
                                        <svg class="w-6 h-6 md:w-5 md:h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                        <span class="hidden md:block md:ml-2 font-semibold text-sm">Saved</span>
                                    </a>

                                    {{-- 3. LIKED --}}
                                    <a href="{{ route('posts.liked', ['name' => $user->slug]) }}" 
                                    class="{{ $baseClass }} {{ request()->routeIs('posts.liked') ? $activeClass : $inactiveClass }}"
                                    title="Liked">
                                        <svg class="w-6 h-6 md:w-5 md:h-5 transition-transform group-hover:scale-110 {{ request()->routeIs('posts.liked') ? 'fill-white stroke-white' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        <span class="hidden md:block md:ml-2 font-semibold text-sm">Liked</span>
                                    </a>
                                @endif

                                {{-- 4. LOST ITEMS --}}
                                <a href="{{ route('lost.items', ['name' => $user->slug]) }}" 
                                class="{{ $baseClass }} {{ request()->routeIs('lost.items') ? $activeClass : $inactiveClass }}"
                                title="Lost Items">
                                    <svg class="w-6 h-6 md:w-5 md:h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span class="hidden md:block md:ml-2 font-semibold text-sm">Lost & Found</span>
                                </a>

                                {{-- 5. STUDY GROUPS --}}
                                <a href="{{ route('study.groups.currently.in', ['name' => $user->slug]) }}" 
                                class="{{ $baseClass }} {{ request()->routeIs('study.groups.currently.in') ? $activeClass : $inactiveClass }}"
                                title="Study Groups">
                                    <svg class="w-6 h-6 md:w-5 md:h-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="hidden md:block md:ml-2 font-semibold text-sm">Groups</span>
                                </a>

                            </div>
                        </nav>
                        @if(request()->routeIs('study.groups.currently.in'))
                            @php $groupTab = $tab ?? request()->get('tab', 'current'); @endphp
                            <div class="flex items-center justify-center gap-3 mt-3 w-full">
                                @php
                                    $baseBtn = 'inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-shadow border select-none';
                                    $activeBtn = 'bg-indigo-600 text-white border-indigo-600 shadow-lg';
                                    $inactiveBtn = 'bg-white text-slate-700 border border-gray-200 hover:bg-gray-50 hover:text-indigo-600 shadow-sm';
                                @endphp

                                <a href="{{ route('study.groups.currently.in', ['name' => $user->slug]) }}"
                                   class="{{ $baseBtn }} {{ $groupTab === 'current' ? $activeBtn : $inactiveBtn }}"
                                   aria-current="{{ $groupTab === 'current' ? 'true' : 'false' }}">
                                    <svg class="w-4 h-4 {{ $groupTab === 'current' ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M17 8a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Currently In
                                </a>

                                <a href="{{ route('study.groups.currently.in', ['name' => $user->slug]) }}?tab=created"
                                   class="{{ $baseBtn }} {{ $groupTab === 'created' ? $activeBtn : $inactiveBtn }}"
                                   aria-current="{{ $groupTab === 'created' ? 'true' : 'false' }}">
                                    <svg class="w-4 h-4 {{ $groupTab === 'created' ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-3.866 0-7 1.79-7 4v2a2 2 0 002 2h10a2 2 0 002-2v-2c0-2.21-3.134-4-7-4zM12 4v4"/>
                                    </svg>
                                    Has Created
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- POSTS GRID CONTENT --}}
                    @if(request()->routeIs('posts.all', 'posts.saved', 'posts.liked'))
                        @if($posts->count() > 0)
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 pb-24">
                                
                                @foreach ($posts as $post)
                                    @if($post->media->count() > 0)
                                        <div class="group relative flex flex-col bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-1">
                                            
                                            <div class="absolute top-0 left-0 w-full h-1 sm:h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                                            <div class="p-2 sm:p-4 flex items-center justify-between bg-white border-b border-gray-50">
                                                <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $post->created_at->format('M d') }}</span>
                                                <div class="items-center gap-1 sm:gap-2 flex flex-row">
                                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 transition-transform group-hover:scale-110 text-pink-500 fill-pink-500" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg> 
                                                    <span class="text-[10px] sm:text-xs font-semibold">{{ $post->likedUsers()->count() }}</span>
                                                </div>
                                                <div class="flex items-center gap-1 sm:gap-2 text-gray-400">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                    <span class="text-[10px] sm:text-xs font-semibold">{{ $post->comments()->count() }}</span>
                                                </div>
                                            </div>
                                            
                                            <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="relative w-full aspect-[4/5] overflow-hidden bg-gray-100">
                                                @foreach($post->media as $media)
                                                    @if($media->type === 'image')
                                                        <img src="{{ asset('storage/' . $media->path) }}" class="w-full h-full object-cover" alt="Post Image">
                                                    @elseif($media->type === 'video')
                                                        <video class="w-full h-full object-cover">
                                                            <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                                        </video>
                                                    @endif
                                                @endforeach
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 sm:p-6">
                                                    @if($post->description)
                                                        <p class="text-white text-xs sm:text-sm font-medium line-clamp-2 mb-2">{{ $post->description }}</p>
                                                    @endif
                                                </div>
                                            </a>

                                            @if(auth()->id() === $user->id && request()->routeIs('posts.goals.active', 'posts.goals.completed'))
                                                <div class="p-2 sm:p-3 bg-white border-t border-gray-100">
                                                    <a href="{{ route('profile.my-goals', ['name' => $user->slug, 'post' => $post->id]) }}"
                                                    class="flex items-center justify-center w-full py-1.5 sm:py-2 bg-blue-50 text-blue-600 rounded-lg text-[10px] sm:text-xs font-bold hover:bg-blue-600 hover:text-white transition-colors uppercase tracking-wide">
                                                        Manage
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    @else
                                        <div class="group relative flex flex-col justify-between bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500 hover:-translate-y-1 h-full min-h-[180px] sm:min-h-[300px] overflow-hidden">
                                            <div class="absolute top-0 left-0 w-full h-1 sm:h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                                            
                                            <div class="p-2 sm:p-4 flex items-center justify-between bg-white border-b border-gray-50">
                                                <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $post->created_at->format('M d') }}</span>
                                                <div class="items-center gap-1 sm:gap-2 flex flex-row">
                                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 transition-transform group-hover:scale-110 text-pink-500 fill-pink-500" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg> 
                                                    <span class="text-[10px] sm:text-xs font-semibold">{{ $post->likedUsers()->count() }}</span>
                                                </div>
                                                <div class="flex items-center gap-1 sm:gap-2 text-gray-400">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                                    <span class="text-[10px] sm:text-xs font-semibold">{{ $post->comments()->count() }}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="p-3 sm:p-8 flex flex-col flex-grow">
                                                <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="block flex-grow">
                                                    <p class="text-sm sm:text-xl font-serif text-gray-800 leading-relaxed group-hover:text-purple-900 transition-colors line-clamp-6">
                                                        {{ $post->description }}
                                                    </p>
                                                </a>

                                                <div class="pt-3 sm:pt-6 mt-2 sm:mt-4 border-t border-gray-50 flex justify-between items-center">
                                                    <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="text-[10px] sm:text-sm font-bold text-purple-600 hover:text-purple-800 transition-colors">
                                                        Read
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-48 bg-white rounded-[3rem] border border-dashed border-gray-200 mb-24">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <span class="text-3xl">📭</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">No posts yet</h3>
                                <p class="text-gray-500 mt-2">This feed is looking a little quiet.</p>
                            </div>
                        @endif
                    @elseif(request()->routeIs('lost.items'))
                        {{-- LOST ITEMS GRID --}}
                        @if($lostItems->count() > 0)
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 pb-24">
                                
                                @foreach ($lostItems as $lostItem)
                                    @if(!empty($lostItem->images_lost) && count($lostItem->images_lost) > 0)
                                        <div class="group relative flex flex-col bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-1">
                                            
                                            <div class="absolute top-0 left-0 w-full h-1 sm:h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                                            <div class="p-2 sm:p-4 flex items-center justify-between bg-white border-b border-gray-50">
                                                <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider whitespace-nowrap">{{ $lostItem->created_at->format('M d') }}</span>   
                                                <strong class="line-clamp-2 text-sm whitespace-nowrap truncate ... ml-2 fond-bold">{{ $lostItem->item_name }}</strong>                                     
                                            </div>
                                            
                                            <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="relative w-full aspect-[4/5] overflow-hidden bg-gray-100">
                                                @foreach($lostItem->images_lost as $images_lost)
                                                        <img src="{{ asset('storage/' . $images_lost) }}" class="w-full h-full object-cover" alt="Lost Image">
                                                          <div class="absolute top-4 left-4">
                                                    <span id="badge-{{ $lostItem->id }}" 
                                                        class="status-badge px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest backdrop-blur-md shadow-lg transition-colors duration-300
                                                        {{ $lostItem->found 
                                                            ? 'bg-emerald-500 text-white shadow-emerald-500/20' 
                                                            : 'bg-red-500 text-white shadow-red-500/20' }}">
                                                        {{ $lostItem->found ? 'Found' : 'Lost' }}
                                                    </span>
                                                </div>
                                                @endforeach
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 sm:p-6">
                                                    @if($lostItem->item_name)
                                                        <p class="text-white text-md sm:text-md font-medium line-clamp-2 mb-2">{{ $lostItem->item_name }}</p>
                                                    @endif
                                                    @if($lostItem->detailed_description)
                                                        <p class="text-white text-xs sm:text-sm font-medium line-clamp-2 mb-2">{{ $lostItem->detailed_description }}</p>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>

                                    @else
                                        <div class="group relative flex flex-col justify-between bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 hover:shadow-2xl hover:shadow-purple-500/10 transition-all duration-500 hover:-translate-y-1 h-full min-h-[180px] sm:min-h-[300px] overflow-hidden">
                                            <div class="absolute top-0 left-0 w-full h-1 sm:h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                                            
                                            <div class="p-2 sm:p-4 flex items-center justify-between bg-white border-b border-gray-50">
                                                <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $lostItem->created_at->format('M d') }}</span>
                                                <strong class="line-clamp-2 text-sm whitespace-nowrap truncate ... ml-2 fond-bold">{{ $lostItem->item_name }}</strong>                                     
                                            </div>
                                            
                                            <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="relative aspect-[4/3] h-full w-full overflow-hidden bg-gray-100 block">
                                                    <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 text-slate-300">
                                                        <svg class="w-full h-full object-cover" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                        <span class="text-xs font-bold uppercase tracking-wider">No Image</span>
                                                    </div>

                                                <div class="absolute top-4 left-4">
                                                    <span id="badge-{{ $lostItem->id }}" 
                                                        class="status-badge px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest backdrop-blur-md shadow-lg transition-colors duration-300
                                                        {{ $lostItem->found 
                                                            ? 'bg-emerald-500 text-white shadow-emerald-500/20' 
                                                            : 'bg-red-500 text-white shadow-red-500/20' }}">
                                                        {{ $lostItem->found ? 'Found' : 'Lost' }}
                                                    </span>
                                                </div>
                                            </a>
                                            <div class="p-3 sm:p-8 flex flex-col flex-grow">
                                                <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="block flex-grow">
                                                    <p class="text-sm sm:text-xl font-serif text-gray-800 leading-relaxed group-hover:text-purple-900 transition-colors line-clamp-6">
                                                        {{ $lostItem->description }}
                                                    </p>
                                                </a>

                                                <div class="pt-3 sm:pt-6 mt-2 sm:mt-4 border-t border-gray-50 flex justify-between items-center">
                                                    <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="w-full text-[10px] sm:text-sm font-bold text-purple-600 hover:text-purple-800 transition-colors">
                                                        Read
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-48 bg-white rounded-[3rem] border border-dashed border-gray-200 mb-24">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <span class="text-3xl">📭</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">No Lost Items yet</h3>
                                <p class="text-gray-500 mt-2">This feed is looking a little quiet.</p>
                            </div>
                        @endif
                    
                    @elseif(request()->routeIs('study.groups.currently.in'))
                        {{-- STUDY GROUPS GRID --}}
                        @if($studyGroups->count() > 0)
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 pb-24">

                                @foreach ($studyGroups as $studyGroup)
                                    <div class="group relative flex flex-col bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                                        <!-- Top Gradient Bar -->
                                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                                        <!-- Date + Status -->
                                        <div class="px-3 pt-3 pb-2 flex items-start justify-between gap-2">
                                            <span class="text-[10px] sm:text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                                {{ $studyGroup->created_at->format('M d') }}
                                            </span>

                                            @if($studyGroup->date->isFuture())
                                                <span
                                                    class="inline-flex w-fit items-center rounded-full font-bold uppercase
                                                        px-2 py-0.5 text-[10px] tracking-normal
                                                        sm:px-3 sm:py-1 sm:text-xs sm:tracking-widest
                                                        bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                    
                                                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1 sm:mr-2 animate-pulse"></span>

                                                    {{-- Short text on mobile, full text on bigger screens --}}
                                                    <span class="sm:hidden">Upcoming</span>
                                                    <span class="hidden sm:inline">Upcoming Session</span>
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex w-fit items-center rounded-full font-bold uppercase
                                                        px-2 py-0.5 text-[10px] tracking-normal
                                                        sm:px-3 sm:py-1 sm:text-xs sm:tracking-widest
                                                        bg-red-200 text-red-600 border border-red-100">
                                                    
                                                    <span class="w-2 h-2 rounded-full bg-red-500 mr-1 sm:mr-2"></span>

                                                    {{-- Short text on mobile, full text on bigger screens --}}
                                                    <span class="sm:hidden">Past</span>
                                                    <span class="hidden sm:inline">Past Session</span>
                                                </span>
                                            @endif
                                        </div>   
                                        <!-- Body -->
                                        <div class="p-3 flex flex-col flex-grow">

                                            <!-- Group Name -->
                                            <a href="{{ route('study-groups.show', $studyGroup->slug) }}" class="block mb-1">
                                                <h3 class="text-sm sm:text-base font-semibold text-gray-800 line-clamp-2 group-hover:text-indigo-700 transition">
                                                    {{ $studyGroup->group_name }}
                                                </h3>
                                            </a>

                                            <!-- Description -->
                                            @if($studyGroup->description)
                                                <a href="{{ route('study-groups.show', $studyGroup->slug) }}" class="block mb-1">
                                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                                        {{ $studyGroup->description }}
                                                    </p>
                                                </a>
                                            @endif

                                            <!-- Info -->
                                            <div class="mt-3 space-y-1 text-[11px] text-gray-500">

                                                    <div class="flex items-center gap-1">
                                                        📅 <span>{{ \Carbon\Carbon::parse($studyGroup->date)->format('D, M jS') }}</span>
                                                    </div>

                                                    <div class="flex items-center gap-1">
                                                        ⏰ <span>{{ $studyGroup->start_time->format('g:ia') }} - {{ $studyGroup->end_time->format('g:ia')  }}</span>
                                                    </div>

                                                @if($studyGroup->location)
                                                    <div class="flex items-center gap-1">
                                                        📍 <span class="truncate">{{ $studyGroup->location }}</span>
                                                    </div>
                                                @endif

                                                <div class="flex items-center gap-1">
                                                    👥 <span>{{ $studyGroup->members()->count() }} members</span>
                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="pt-3 mt-auto border-t border-gray-100 flex justify-between items-center">
                                                <span class="text-[11px] text-gray-400 truncate">
                                                    Leader: {{ $studyGroup->leader->name }}
                                                </span>

                                                <a href="{{ route('study-groups.show', $studyGroup->slug) }}"
                                                class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">
                                                    View →
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center py-48 bg-white rounded-[3rem] border border-dashed border-gray-200 mb-24">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <span class="text-3xl">📚</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">No Study Groups yet</h3>
                                <p class="text-gray-500 mt-2">Looks like there are no groups created yet.</p>
                            </div>
                        @endif
                    @else
                        <p>Nope</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>