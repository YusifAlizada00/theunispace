<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[250px]">
        <div class="max-w-6xl mx-auto">

            {{-- 1. HERO HEADER --}}
            <div class="mb-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <a href="{{ route('study-groups') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Groups
                    </a>

                    {{-- Status Badge --}}
                    @if($studyGroup->date->isFuture())
                        <span class="inline-flex w-fit items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest
                                    bg-emerald-50 text-emerald-600 border border-emerald-100">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                            Upcoming Session
                        </span>
                    @else
                        <span class="inline-flex w-fit items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest
                                    bg-red-200 text-red-600 border border-red-100">
                            <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                            Past Session
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-3">
                    {{ $studyGroup->group_name }}
                </h1>
                <p class="text-xl text-slate-500 font-medium">{{ $studyGroup->subject }} • Academic Study Group</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: Main Info --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Main Content Card --}}
                    <div
                        class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden p-8 md:p-10">

                        {{-- Logistics Strip --}}
                        <div class="flex flex-col gap-6 mb-10 pb-10 border-b border-gray-100">
                            {{-- Date --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Date</p>
                                    <p class="text-sm md:text-lg font-bold text-slate-800">
                                        {{ $studyGroup->date->format('D, M jS') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Time --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Time</p>
                                    <p class="text-sm md:text-lg font-bold text-slate-800">
                                        {{ $studyGroup->start_time->format('g:ia') }} -
                                        {{ $studyGroup->end_time->format('g:ia') }}</p>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-600 shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Location</p>
                                    <p class="text-sm md:text-lg font-bold text-slate-800 break-words">
                                        {{ $studyGroup->location }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-10">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                About this session
                            </h3>
                            <div
                                class="prose prose-slate max-w-none text-slate-600 leading-relaxed bg-slate-50 rounded-2xl p-6 border border-slate-100">
                                @if(!$studyGroup->description)
                                    <p class="italic text-gray-400">No description provided for this study group.</p>
                                @else
                                    <p>{{ $studyGroup->description }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Members Area --}}
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-slate-900">Joined Members</h3>
                                <span
                                    class="bg-gray-100 text-gray-600 py-1 px-3 rounded-full text-xs font-bold">{{ count($studyGroup->members) + 1 }}
                                    Active</span>
                            </div>

                            <div class="flex flex-col gap-4">

                                {{-- 1. GROUP LEADER (Highlighted) --}}
                                <div
                                    class="flex items-center gap-3 p-3 bg-indigo-50 border border-indigo-100 rounded-xl">
                                    <div class="relative">
                                        <a href="{{ route('posts.all', ['name' => $studyGroup->leader->slug]) }}" class="flex items-center gap-3">
                                            <img class="w-12 h-12 rounded-full object-cover ring-2 ring-indigo-200"
                                                src="{{ $studyGroup->leader->profile_photo_url }}" loading="lazy"
                                                alt="{{ $studyGroup->leader->name }}">
                                        </a>
                                        <div
                                            class="absolute -bottom-1 -right-1 bg-indigo-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white">
                                            HOST
                                        </div>
                                    </div>

                                    <div class="flex flex-col">
                                        <a href="{{ route('posts.all', ['name' => $studyGroup->leader->slug]) }}" class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-gray-900">{{ $studyGroup->leader->name }}</span>
                                            <span class="text-xs text-indigo-600 font-medium">Group Leader</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3 px-2">
                                    @foreach($studyGroup->members as $member)
                                        @continue($member->id === $studyGroup->leader_id)

                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('posts.all', ['name' => $member->slug]) }}" class="flex items-center gap-3">
                                                <img class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-100" loading="lazy"
                                                    src="{{ $member->profile_photo_url }}" alt="{{ $member->name }}">
                                            </a>

                                            <div class="flex flex-col leading-tight">
                                                <a href="{{ route('posts.all', ['name' => $member->slug]) }}" class="hover:underline">
                                                    <span class="text-sm font-semibold text-gray-700">
                                                        {{ $member->name }}
                                                    </span>
                                                </a>

                                                @if(Auth::id() === $studyGroup->leader_id || Auth::id() === $member->id)
                                                    <span class="text-[11px] text-gray-400">
                                                        {{ $member->email }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- RIGHT COLUMN: Sidebar --}}
                <div class="space-y-6">

                    {{-- Host Card --}}
                    <div
                        class="bg-white rounded-[2rem] p-6 pt-12 shadow-xl shadow-gray-200/50 border border-gray-100 text-center relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-r from-indigo-500 to-purple-500">
                        </div>

                        <div class="relative -mt-8 mb-3">
                            <img src="{{ asset($studyGroup->leader->profile_photo_url) }}" loading="lazy" alt="Photo"
                                class="w-20 h-20 rounded-full border-4 border-white shadow-md mx-auto">
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 break-words">{{ $studyGroup->leader->name }}</h3>
                        <p class="text-xs font-bold uppercase tracking-wider text-indigo-500">Group Leader</p>
                        <p class="mb-6 text-sm md:text-md text-slate-600 break-words">{{ $studyGroup->leader->email }}
                        </p>
                        <a href="{{ route('posts.all', ['name' => $studyGroup->leader->slug]) }}"
                            class="w-full py-2.5 px-12 rounded-xl border border-gray-200 text-gray-700 font-bold text-sm hover:bg-gray-50 transition">
                            View Profile
                        </a>
                    </div>

                    {{-- Action Card --}}
                    <div class="bg-white rounded-[2rem] p-6 shadow-xl shadow-gray-200/50 border border-gray-100">
                        <h4 class="text-sm font-bold text-slate-900 mb-2">Management</h4>
                        <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                            You are currently a member of this group. If you can no longer attend, please leave to free
                            up a spot.
                        </p>

                        <livewire:nice-join-study-group-button :studyGroup="$studyGroup">
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>