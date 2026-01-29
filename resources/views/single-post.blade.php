<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* === Custom Styling for "Beautiful" Look === */
    
    /* Clean Swiper Pagination (Pills) */
    .swiper-pagination-bullet {
        background: #fff;
        opacity: 0.6;
        width: 6px;
        height: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .swiper-pagination-bullet-active {
        background: #fff !important;
        opacity: 1 !important;
        width: 20px;
        border-radius: 99px;
    }

    /* Glassmorphism Navigation Arrows */
    .swiper-button-next,
    .swiper-button-prev {
        width: 36px !important;
        height: 36px !important;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-radius: 50%;
        color: #0f172a !important; /* Slate 900 */
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 14px !important;
        font-weight: 800;
    }

    [x-cloak] { display: none !important; }
</style>

@php
    $commentsCount = $singlePost->comments()->count();
@endphp

<x-app-layout>
    <div class="min-h-screen bg-white py-8 font-sans antialiased text-slate-600">
        
        <div class="relative w-full flex justify-center gap-8 px-4 sm:px-6 z-0">
            <div class="flex flex-col w-full max-w-2xl mx-auto">
                
                {{-- Main Card Container with "Beautiful" Styles --}}
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden transition-all duration-500">
                    
                    {{-- 1. Header Section --}}
                    <div class="p-6 flex items-start justify-between">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <a href="{{ route('posts.all', ['name' => $singlePost->user->slug]) }}" class="relative block shrink-0">
                                <img src="{{ $singlePost->user->profile_photo_url }}" 
                                     alt="Profile"
                                     class="w-12 h-12 rounded-full object-cover ring-4 ring-slate-50 transition-transform hover:scale-105">
                            </a>

                            {{-- User Info --}}
                            <div>
                                <div class="leading-tight">
                                    <div class="flex flex-row gap-4">
                                        <a href="{{ route('posts.all', ['name' => $singlePost->user->slug]) }}"
                                        class="block font-bold text-slate-900 hover:text-indigo-600 transition-colors text-[15px]">
                                            {{ $singlePost->user->name }}
                                        </a>
                                        @if($singlePost->user->is_admin)
                                            <img src="{{ asset('icons/check.png') }}" alt="Verified" class="h-4 w-4">
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium mt-0.5">
                                        <span>{{ $singlePost->user->major ?? 'Student' }}</span>
                                        <span class="w-0.5 h-0.5 rounded-full bg-slate-300"></span>
                                        <span>{{ $singlePost->getTimeAgoAttribute() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3-Dot Menu --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="p-2 -mr-2 text-slate-300 hover:text-slate-600 hover:bg-slate-50 rounded-full transition-colors">
                                <img src="{{ asset('icons/dots.png') }}" alt="Dots" class="w-6 h-6 opacity-60 hover:opacity-100">
                            </button>

                            {{-- Dropdown --}}
                            <ul x-show="open" x-cloak @click.away="open = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 z-50 overflow-hidden py-1.5">

                                <input type="text" id="copyInput-{{ $singlePost->id }}" value="{{ url('dashboard/post/' . $singlePost->slug) }}" class="hidden">

                                <button onclick="copyToClipboard({{ $singlePost->id }})" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                    <img src="{{ asset('icons/copy.png') }}" alt="Copy" class="w-5 h-5 opacity-70">
                                    <span>Copy Link</span>
                                </button>

                                @if (Auth::user()->id === $singlePost->user_id)
                                    <a href="{{ route('post.edit', ['post' => $singlePost->slug]) }}" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                                        <img src="{{ asset('icons/edit.png') }}" alt="Edit" class="w-5 h-5 opacity-70">
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('post.destroy', ['post' => $singlePost->slug]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="deleteGoal()" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm font-medium text-rose-500 hover:bg-rose-50 transition-colors">
                                            <img src="{{ asset('icons/delete.png') }}" alt="Delete" class="w-5 h-5 opacity-70">
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                @endif

                                @if(Auth::user()->id !== $singlePost->user_id)
                                        <livewire:report-content-livewire :post-id="$singlePost->id" />
                                @endif
                            </ul>
                        </div>
                    </div>

                    {{-- 2. Text Content --}}
                    <div class="px-6 pb-4">
                        <p class="text-gray-800 text-sm leading-relaxed">
                            {!! \Illuminate\Support\Str::of($singlePost->description)
                                // 1. Convert URLs to clickable links
                                ->replaceMatches(
                                    '/(https?:\/\/[^\s]+)/',
                                    '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-blue-600 underline hover:text-blue-800">$1</a>'
                                )
                                // 2. Convert newlines to <br> tags
                                ->replace("\n", '<br>') !!}
                        </p>
                    </div>

                    {{-- 3. Media Section (Swiper) --}}
                    @if($singlePost->media->count() > 0)
                        <div class="pb-2 px-2">
                            {{-- Full width swiper inside the card --}}
                            <div class="swiper mySwiper-{{ $singlePost->id }} rounded-2xl w-full aspect-[4/3] bg-slate-50">
                                <div class="swiper-wrapper">
                                    @foreach($singlePost->media as $media)
                                        <div class="swiper-slide flex items-center justify-center bg-slate-100">
                                            @if($media->type === 'image')
                                                <img src="{{ asset('storage/' . $media->path) }}" class="w-full h-full object-cover">
                                            @elseif($media->type === 'video')
                                                <video controls class="w-full h-full object-contain">
                                                    <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                
                                @if($singlePost->media->count() > 1)
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
                            {{-- Like Button (Placeholder style) --}}
                            <livewire:like-button :post="$singlePost">

                            {{-- Comment Button --}}
                             <a href="{{ route('single-post', $singlePost->slug) }}" class="flex items-center gap-2 text-slate-500 hover:text-indigo-500 transition-colors group">
                                <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                @if (count($singlePost->comments) > 0)
                                    <span class="text-sm font-semibold">{{ count($singlePost->comments) }}</span>
                                @else    
                                    <span class="text-sm font-semibold">Comment</span>
                                @endif
                            </a>
                        </div>

                        <div class="flex items-center gap-8 sm:gap-24">
                            <div class="transform transition hover:scale-110 active:scale-95">
                                <livewire:share-button :post="$singlePost" />
                            </div>

                            <div class="hover:text-black-500 transition-colors group">
                                <livewire:save-button :post="$singlePost" />
                            </div>
                        </div>
                    </div>

                </div> {{-- End Card --}}

                {{-- Comments Section --}}
                <div class="mt-8">
                    <livewire:comments :model="$singlePost" class="pb-8" />
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swipers = document.querySelectorAll('.swiper');
        swipers.forEach((el) => {
            // Target specific unique class
            const uniqueClass = '.' + el.classList[1]; 
            new Swiper(uniqueClass, {
                loop: false,
                pagination: {
                    el: uniqueClass + ' .swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
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
            text: "Copied!",
            duration: 2000,
            gravity: "top",
            position: "center",
            style: {
                background: "#4ade80",
                color: "#fff",
                borderRadius: "50px",
                fontWeight: "600",
            }
        }).showToast();
    }

    function deleteGoal() {
        // Visual feedback only - form handles actual delete
        setTimeout(() => {
            Toastify({
                text: "Goal deleted!",
                duration: 2000,
                gravity: "top",
                position: "center",
                style: {
                    background: "#ef4444",
                    borderRadius: "50px",
                    color: "white"
                }
            }).showToast();
        }, 500); 
    }

    setTimeout(() => {
        const msg = document.getElementById('success-msg');
        if (msg) msg.remove();
    }, 3000);
</script>