<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

@props(['posts', 'user'])

<div class="relative w-full flex justify-center gap-8 px-4 sm:px-6 z-0 pt-6">
    <div class="flex flex-col w-full max-w-[600px] mx-auto">

        {{-- Success Message (Tailwind Styled) --}}
        @if(session('success'))
            <div id="success-msg" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-slate-900 text-white px-6 py-3 rounded-full shadow-xl shadow-indigo-500/20 transition-all duration-500">
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif
        <div class="hidden md:flex items-center justify-between mb-8 sticky top-4 z-40 bg-gray-50/80 backdrop-blur-xl p-3 rounded-3xl border border-white/40 shadow-sm">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight pl-2">The Feed</h1>
            </div>
            
            <a href="{{ route('post.create') }}"
                class="group inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-black text-white px-5 py-2.5 rounded-2xl font-bold shadow-lg shadow-slate-900/10 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-slate-900/20 active:scale-95">
                <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-sm tracking-wide">New Post</span>
            </a>
        </div>

        {{-- The Feed Loop --}}
        @foreach ($posts as $post)
            <div class="mb-8 w-full group">
                
                {{-- Card Container --}}
                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-0 overflow-hidden hover:shadow-md transition-shadow duration-300">

                    {{-- Card Header --}}
                    <div class="p-5 pb-3 flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            {{-- Avatar with Ring --}}
                            <div class="relative">
                                <img src="{{ $post->user->profile_photo_url }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-slate-50 border border-white shadow-sm">
                            </div>
                            
                            {{-- User Meta --}}
                            <div class="leading-tight">
                                <a href="{{ route('posts.all', ['name' => $post->user->slug]) }}"
                                   class="block font-bold text-slate-900 hover:text-indigo-600 transition-colors text-[15px]">
                                    {{ $post->user->name }}
                                    @if($post->user->is_admin)
                                        <img src="{{ asset('icons/check.png') }}" alt="Verified" class="h-5 w-5 inline-block ml-1 align-top relative top-0">
                                    @endif
                                </a>
                                <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium mt-0.5">
                                    <span>{{ $post->user->major ?? 'Student' }}</span>
                                    <span class="w-0.5 h-0.5 rounded-full bg-slate-300"></span>
                                    <span>{{ $post->getTimeAgoAttribute() }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- 3-Dot Menu --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="text-slate-300 hover:text-slate-600 hover:bg-slate-50 rounded-full p-2 transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/></svg>
                            </button>
                            
                            {{-- Dropdown --}}
                            <ul x-show="open" x-cloak @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 z-50 overflow-hidden py-1">

                                <input type="text" id="copyInput-{{ $post->id }}" value="{{ url('dashboard/post/' . $post->slug) }}" class="hidden">

                                <button onclick="copyToClipboard({{ $post->id }})" class="flex items-center gap-3 w-full text-left px-4 py-3 hover:bg-slate-50 text-slate-600 text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                    Copy Link
                                </button>

                                @if (Auth::user()->id === $post->user_id)
                                    <a href="{{ route('post.edit', ['post' => $post->slug]) }}" class="flex items-center gap-3 w-full text-left px-4 py-3 hover:bg-slate-50 text-slate-600 text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        Edit Post
                                    </a>

                                    <form action="{{ route('post.destroy', ['post' => $post->slug]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-3 hover:bg-red-50 text-red-600 text-sm font-medium transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Delete
                                        </button>
                                    </form>
                                @endif

                                @if(Auth::user()->id !== $post->user_id)
                                        <livewire:report-content-livewire :post-id="$post->id" />
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- Post Content --}}
                    <div class="px-5 pb-3">
                        <p class="text-gray-800 text-sm leading-relaxed">
                            {!! \Illuminate\Support\Str::of($post->description)
                                // 1. Convert URLs to clickable links
                                ->replaceMatches(
                                    '/(https?:\/\/[^\s]+)/',
                                    '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline hover:text-blue-800">$1</a>'
                                )
                                // 2. Convert newlines to <br> tags
                                ->replace("\n", '<br>') !!}
                        </p>
                    </div>

                    {{-- Media Swiper --}}
                    @if($post->media->count() > 0)
                        <div class="pb-4 px-2"> {{-- Added padding so images don't touch edges --}}
                            <div class="swiper mySwiper-{{ $post->id }} rounded-2xl overflow-hidden aspect-[4/3] bg-slate-50">
                                <div class="swiper-wrapper">
                                    @foreach($post->media as $media)
                                        <div class="swiper-slide flex items-center justify-center bg-black/5">
                                            @if($media->type === 'image')
                                                <img src="{{ asset('storage/' . $media->path) }}" class="w-full h-full object-cover" loading="lazy">
                                            @elseif($media->type === 'video')
                                                <video controls class="w-full h-full object-contain">
                                                    <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($post->media->count() > 1)
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Engagement Bar (Visual Upgrade) --}}
                    <div class="px-5 py-4 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <livewire:like-button :post="$post">

                            {{-- Comment Button --}}
                            <a href="{{ route('single-post', $post->slug) }}" class="flex items-center gap-2 text-slate-500 hover:text-indigo-500 transition-colors group">
                                <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                @if (count($post->comments) > 0)
                                    <span class="text-sm font-semibold">{{ count($post->comments) }}</span>
                                @else    
                                    <span class="text-sm font-semibold">Comment</span>
                                @endif
                            </a>
                        </div>

                        <div class="flex items-center gap-8 sm:gap-24">
                            <div class="transform transition hover:scale-110 active:scale-95">
                                <livewire:share-button :post="$post" />
                            </div>

                            <div class="hover:text-black-500 transition-colors group">
                                <livewire:save-button :post="$post" />
                            </div>
                        </div>                    
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swipers = document.querySelectorAll('.swiper');
        swipers.forEach((el) => {
            const uniqueClass = '.' + el.classList[1];
            new Swiper(uniqueClass, {
                loop: false,
                pagination: {
                    el: uniqueClass + ' .swiper-pagination',
                    clickable: true,
                    dynamicBullets: true, // Make dots smaller if there are many
                },
                navigation: {
                    nextEl: uniqueClass + ' .swiper-button-next',
                    prevEl: uniqueClass + ' .swiper-button-prev'
                },
            });
        });
    });

    function copyToClipboard(postId) {
        const copyText = document.getElementById('copyInput-' + postId);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        Toastify({
            text: "Link Copied!",
            duration: 2000,
            gravity: "top",
            position: "center",
            style: {
                background: "#4ade80",
                borderRadius: "50px",
                color: "white",
                fontWeight: "600",
                boxShadow: "0 10px 15px -3px rgb(0 0 0 / 0.1)"
            }
        }).showToast();
    };

    setTimeout(() => {
       const msg = document.getElementById('success-msg');
       if (msg) {
           msg.style.opacity = '0';
           setTimeout(() => msg.remove(), 500);
       }
    }, 3000);
</script>

<style>
    /* Clean Swiper Dots */
    .swiper-pagination-bullet {
        background: #fff;
        opacity: 0.5;
        width: 6px;
        height: 6px;
        transition: all 0.3s;
    }
    .swiper-pagination-bullet-active {
        background: #fff !important;
        opacity: 1 !important;
        width: 16px; /* Pill shape for active */
        border-radius: 4px;
    }

    /* Glassmorphism Arrows */
    .swiper-button-next,
    .swiper-button-prev {
        width: 32px !important;
        height: 32px !important;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        border-radius: 50%;
        color: #1e293b !important; /* Slate 800 */
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: white;
        transform: scale(1.1);
    }
    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 12px !important;
        font-weight: bold;
    }

    [x-cloak] { display: none !important; }
</style>