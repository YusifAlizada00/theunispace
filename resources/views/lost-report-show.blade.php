<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[300px] md:pb-16 pb-32">
        <div class="max-w-5xl mx-auto">

            {{-- Title Header --}}
            <div class="mb-8">
                <a href="{{ route('lost-found') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1 mb-4 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    Back to List
                </a>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    {{ $reportLost->item_name }}
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Reported {{ $reportLost->getTimeAgoAttribute() }} • Lost on {{ \Carbon\Carbon::parse($reportLost->lost_date)->format('M d, Y') }}
                </p>
            </div>
 
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Image Slider Column --}}
                <div class="lg:col-span-2">
                    <div class="bg-gray-200 rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden relative group">
                        @if($reportLost->images_lost && count($reportLost->images_lost) > 0)
                            <div class="swiper mySwiper-{{ $reportLost->id }}">
                                <div class="swiper-wrapper">
                                    @foreach($reportLost->images_lost as $image)
                                        <div class="swiper-slide flex items-center justify-center h-80 md:h-96">
                                            <img src="{{ asset('storage/' . $image) }}" loading="lazy"
                                                 class="max-w-full max-h-full object-contain"
                                                 alt="{{ $reportLost->item_name }}">
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Navigation Controls with Custom SVGs --}}
                                @if(count($reportLost->images_lost) > 1)
                                    <div class="swiper-pagination"></div>
                                    
                                    <div class="swiper-button-next absolute top-1/2 -translate-y-1/2 right-4 z-10 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>

                                    <div class="swiper-button-prev absolute top-1/2 -translate-y-1/2 left-4 z-10 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center shadow-md cursor-pointer hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-80 bg-gray-50">
                                <p class="text-gray-400 font-medium">No images available</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Information Sidebar --}}
                <div class="space-y-4">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 space-y-6">
                        
                        {{-- Description --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Description</label>
                            <p class="text-slate-700 leading-relaxed text-sm">
                                {{ $reportLost->detailed_description }}
                            </p>
                        </div>

                        {{-- Location --}}
                        <div class="space-y-2 pt-6 border-t border-gray-50">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Last Seen Location</label>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <p class="font-bold text-slate-900">{{ $reportLost->location_lost }}</p>
                            </div>
                        </div>

                        {{-- Email Address --}}
                        <div class="space-y-2 pt-6 border-t border-gray-50">
                            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Email Address</label>
                            <div class="flex items-start gap-2">
                                <p class="font-bold text-slate-900">{{ $reportLost->user->email }}</p>
                            </div>
                        </div>

                        {{-- Time Range --}}
                        <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">From</label>
                                <p class="font-bold text-slate-900 text-lg">{{ $reportLost->time_from_lost->format('g:ia') }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">To</label>
                                <p class="font-bold text-slate-900 text-lg">{{ $reportLost->time_to_lost->format('g:ia') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <a href="{{ route('contact-form', $reportLost->slug) }}"
                       class="flex items-center justify-center gap-3 w-full bg-slate-900 text-white font-bold py-5 rounded-2xl hover:bg-indigo-600 transition-all shadow-xl shadow-slate-200 hover:shadow-indigo-200 hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Contact Owner
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.mySwiper-{{ $reportLost->id }}', {
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>

<style>
    .swiper-pagination-bullet-active { background: #6366f1 !important; }

    /* IMPORTANT: Disable Swiper's default blue arrows so they don't overlap our SVG */
    .swiper-button-next:after, .swiper-button-prev:after {
        content: "" !important;
    }

    .swiper-slide {
        padding: 10px;
    }
</style>