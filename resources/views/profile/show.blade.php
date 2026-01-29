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

                {{-- RIGHT CONTENT AREA --}}
                <div class="md:col-span-8 lg:col-span-9">
                    
                    {{-- NEW BEAUTIFUL TABS --}}
                    <div class="sticky top-20 md:top-0 z-30 bg-gray-50/95 backdrop-blur-md py-4 mb-6 -mx-4 px-4 sm:mx-0 sm:px-0 transition-all">
                        <nav class="flex items-center space-x-3 overflow-x-auto no-scrollbar pb-1">
                            @php
                                $baseClass = "flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 border select-none whitespace-nowrap";
                                // Active: Dark Theme
                                $activeClass = "bg-slate-900 text-white border-slate-900 shadow-xl shadow-slate-900/10 transform scale-105";
                                // Inactive: White Theme
                                $inactiveClass = "bg-white text-slate-500 border-gray-200 hover:border-gray-300 hover:text-slate-900 hover:shadow-md hover:-translate-y-0.5";
                            @endphp

                            {{-- Feed Tab --}}
                            <a href="{{ route('posts.all', ['name' => $user->slug]) }}" 
                               class="{{ $baseClass }} {{ request()->routeIs('posts.all') ? $activeClass : $inactiveClass }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('posts.all') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Feed
                            </a>

                            {{-- Saved Tab --}}
                            <a href="{{ route('posts.saved', ['name' => $user->slug]) }}" 
                               class="{{ $baseClass }} {{ request()->routeIs('posts.saved') ? $activeClass : $inactiveClass }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('posts.saved') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                                Saved
                            </a>

                            {{-- Lost Items Tab --}}
                            <a href="{{ route('lost.items', ['name' => $user->slug]) }}" 
                               class="{{ $baseClass }} {{ request()->routeIs('lost.items') ? $activeClass : $inactiveClass }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('lost.items') ? 'text-white' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Lost Items
                            </a>

                            {{-- Liked Tab --}}
                            <a href="{{ route('posts.liked', ['name' => $user->slug]) }}" 
                               class="{{ $baseClass }} {{ request()->routeIs('posts.liked') ? $activeClass : $inactiveClass }}">
                                <svg class="w-4 h-4 {{ request()->routeIs('posts.liked') ? 'text-pink-500 fill-pink-500' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Liked
                            </a>
                        </nav>
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
                    @else
                        {{-- LOST ITEMS GRID --}}
                        @if($lostItems->count() > 0)
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 sm:gap-6 pb-24">
                                
                                @foreach ($lostItems as $lostItem)
                                    @if(count($lostItem->images_lost) > 0)
                                        <div class="group relative flex flex-col bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 hover:-translate-y-1">
                                            
                                            <div class="absolute top-0 left-0 w-full h-1 sm:h-2 bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500"></div>
                                            <div class="p-2 sm:p-4 flex items-center justify-between bg-white border-b border-gray-50">
                                                <span class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider whitespace-nowrap">{{ $lostItem->created_at->format('M d') }}</span>   
                                                <span class="line-clamp-2 text-sm whitespace-nowrap truncate ... ml-2 fond-bold">There is me inside of me and that me is within me</span>                                     
                                            </div>
                                            
                                            <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="relative w-full aspect-[4/5] overflow-hidden bg-gray-100">
                                                @foreach($lostItem->images_lost as $images_lost)
                                                        <img src="{{ asset('storage/' . $images_lost) }}" class="w-full h-full object-cover" alt="Lost Image">
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
                                            </div>
                                            
                                            <div class="p-3 sm:p-8 flex flex-col flex-grow">
                                                <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="block flex-grow">
                                                    <p class="text-sm sm:text-xl font-serif text-gray-800 leading-relaxed group-hover:text-purple-900 transition-colors line-clamp-6">
                                                        {{ $lostItem->description }}
                                                    </p>
                                                </a>

                                                <div class="pt-3 sm:pt-6 mt-2 sm:mt-4 border-t border-gray-50 flex justify-between items-center">
                                                    <a href="{{ route('lost-report.show', $lostItem->slug) }}" class="text-[10px] sm:text-sm font-bold text-purple-600 hover:text-purple-800 transition-colors">
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
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>