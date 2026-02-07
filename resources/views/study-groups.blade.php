<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<x-app-layout>
    {{-- Added x-data here to control the modal --}}
    <div x-data="{ showJoinedGroups: false }" class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[300px]">
        <div class="max-w-6xl mx-auto">

            @if(session('success'))
                <div id="success-msg"
                    class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative transition-opacity duration-500 ease-out"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Create new Study Groups</h1>
                    <p class="text-slate-500 mt-2 text-lg">Find your squad, ace your exams.</p>
                </div>

                {{-- Buttons Container --}}
                <div class="flex items-center gap-2 w-full sm:w-auto">

                    {{-- My Groups Button --}}
                    <button @click="showJoinedGroups = true" class="flex-1 sm:flex-none w-full sm:w-auto whitespace-nowrap inline-flex items-center justify-center gap-2 
               bg-white text-slate-700 border border-gray-200 
               hover:bg-gray-50 hover:text-indigo-600 
               px-3 py-3 sm:px-6 rounded-2xl font-bold shadow-sm transition-all hover:-translate-y-1
               text-sm sm:text-base">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>My Groups</span>
                    </button>

                    {{-- Create Group Button --}}
                    <a href="{{ route('study-groups.create') }}" class="flex-1 sm:flex-none w-full sm:w-auto whitespace-nowrap inline-flex items-center justify-center gap-2 
               bg-indigo-600 hover:bg-indigo-700 text-white 
               px-3 py-3 sm:px-6 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1
               text-sm sm:text-base">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Create Group</span>
                    </a>

                </div>
            </div>

            {{-- Groups Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @php
                    $colors = [
                        'bg-rose-100 text-rose-700',
                        'bg-violet-100 text-violet-700',
                        'bg-sky-100 text-sky-700',
                        'bg-emerald-100 text-emerald-700',
                        'bg-amber-100 text-amber-700',
                        'bg-cyan-100 text-cyan-700',
                    ];
                @endphp

                @foreach($studyGroups as $index => $studyGroup)
                    @php
                        $colorClass = $colors[$index % count($colors)];
                    @endphp

                    <div
                        class="group bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 hover:-translate-y-1 flex flex-col h-full">

                        {{-- Card Header --}}
                        <div class="p-6 pb-4">
                            <div class="flex justify-between items-start mb-4">
                                <a href="{{ route('study-groups.show', $studyGroup->slug) }}">
                                    <span class="{{ $colorClass }} rounded-full py-1 px-3 font-semibold truncate">
                                        {{ $studyGroup->group_name }}
                                    </span>
                                </a>
                                <div class="flex items-center gap-2 sm:gap-3">
                                    @if($studyGroup->date->isFuture())
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100 ring-1 ring-emerald-500/10">
                                            <span class="relative flex h-2 w-2">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            <span class="uppercase tracking-wider text-[10px] sm:text-xs">Upcoming</span>
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-xs font-semibold bg-red-50 text-red-500 border border-red-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                            <span class="uppercase tracking-wider text-[10px] sm:text-xs">Past</span>
                                        </span>
                                    @endif

                                    <div x-data="{ open: false }" class="relative mt-2">
                                        <button @click="open = !open" class="text-gray-300 hover:text-gray-600 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                            </svg>
                                        </button>

                                        <ul x-show="open" x-cloak @click.away="open = false"
                                            class="absolute right-0 mt-2 w-max min-w-[100px] bg-white border rounded shadow-lg z-50 overflow-hidden whitespace-nowrap"
                                            role="menu">

                                            <input type="text" id="copyInput-{{ $studyGroup->id }}"
                                                value="{{ url('study-groups/' . $studyGroup->slug) }}" class="hidden">

                                            <button onclick="copyToClipboard({{ $studyGroup->id }})"
                                                class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 text-sm">
                                                <img src="{{ asset('icons/copy.png') }}" class="w-4 h-4">
                                                <span>Copy Link</span>
                                            </button>

                                            @if (Auth::user()->id === $studyGroup->leader->id)
                                                <a href="{{ route('study-groups.edit', $studyGroup->slug) }}"
                                                    class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-50 text-gray-700 text-sm">
                                                    <img src="{{ asset('icons/edit.png') }}" class="w-4 h-4">
                                                    <span>Edit Group</span>
                                                </a>

                                                <form action="{{ route('study-group.destroy', $studyGroup->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteReport()"
                                                        class="flex items-center gap-2 w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 text-sm">
                                                        <img src="{{ asset('icons/delete.png') }}" class="w-4 h-4">
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('study-groups.show', $studyGroup->slug) }}">
                                <h3
                                    class="text-xl font-bold text-slate-900 leading-tight mb-2 group-hover:text-indigo-600 transition-colors truncate">
                                    {{ $studyGroup->subject }}
                                </h3>
                            </a>

                            <div class="flex items-center gap-2 mb-6">
                                <div
                                    class="w-6 h-6 rounded-full bg-slate-100 border border-white shadow-sm overflow-hidden">
                                    <img src="{{ $studyGroup->leader->profile_photo_url }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm text-slate-500 font-medium truncate">
                                    Hosted by
                                    <a href="{{ route('posts.all', ['name' => $studyGroup->leader->slug]) }}"
                                        class="hover:underline">
                                        <span class="text-slate-800">{{ $studyGroup->leader->name }}</span>
                                    </a>
                                </span>
                            </div>

                            {{-- Info Grid --}}
                            <div class="space-y-3 bg-gray-50 rounded-2xl p-4 border border-gray-100">
                                {{-- Date --}}
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-indigo-500 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase">Date</p>
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ \Carbon\Carbon::parse($studyGroup->date)->format('D, M jS') }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Time --}}
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-orange-500 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase">Time</p>
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ $studyGroup->start_time->format('g:ia') }} -
                                            {{ $studyGroup->end_time->format('g:ia') }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-emerald-500 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-gray-400 uppercase truncate">Location</p>
                                        <p class="text-sm font-semibold text-slate-700 truncate">{{ $studyGroup->location }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <livewire:join-study-group :studyGroup="$studyGroup" />
                    </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            @if(count($studyGroups) === 0)
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">No study groups found</h3>
                    <p class="text-gray-500 mt-1">Be the first to create one!</p>
                </div>
            @endif

        </div>

        {{-- JOINED GROUPS MODAL --}}
        <div x-show="showJoinedGroups" style="display: none;" class="relative z-50" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            {{-- Backdrop --}}
            <div x-show="showJoinedGroups" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
            </div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">

                    {{-- Modal Panel --}}
                    <div x-show="showJoinedGroups" @click.outside="showJoinedGroups = false"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-xl transition-all w-full max-w-sm sm:max-w-2xl">

                        <div class="bg-white px-6 pb-6 pt-6">
                            <div class="flex flex-col h-full">
                                {{-- Header --}}
                                <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-4">
                                    <h3 class="text-2xl font-black text-gray-900" id="modal-title">My Groups</h3>
                                    <button @click="showJoinedGroups = false" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                {{-- List Container --}}
                                <div class="overflow-y-auto max-h-[70vh] sm:max-h-[600px] pr-1">
                                    {{-- FIX: Updated to use $myGroups passed from Controller --}}
                                    @if($myGroups && count($myGroups) > 0)
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @foreach($myGroups as $group)
                                                <a href="{{ route('study-groups.show', $group->slug) }}"
                                                    class="flex flex-col bg-gray-50 border border-gray-100 rounded-xl p-4 hover:border-indigo-200 hover:bg-indigo-50/50 hover:shadow-md transition-all group">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <span
                                                            class="inline-flex items-center justify-center rounded-full bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-700">
                                                            {{ $group->subject }}
                                                        </span>
                                                        <svg class="h-5 w-5 text-gray-300 group-hover:text-indigo-500"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </div>
                                                    <h4
                                                        class="text-lg font-bold text-gray-900 group-hover:text-indigo-700 mb-1">
                                                        {{ $group->group_name }}
                                                    </h4>
                                                    <p class="text-xs text-gray-500">Joined
                                                        {{ $group->pivot->created_at->diffForHumans() }}
                                                    </p>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div
                                            class="text-center py-12 text-gray-500 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <p class="font-medium text-gray-900">You haven't joined any groups yet.</p>
                                            <p class="text-sm mt-1">Join a group to see it here!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse">
                            <button type="button" @click="showJoinedGroups = false"
                                class="inline-flex w-full justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:w-auto sm:py-2">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function copyToClipboard(studyGroupId) {
        const copyText = document.getElementById('copyInput-' + studyGroupId);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);

        Toastify({
            text: "Copied!",
            duration: 2000,
            gravity: "top",
            position: "center",
            backgroundColor: "#4ade80",
        }).showToast();
    }

    setTimeout(() => {
        const msg = document.getElementById('success-msg');
        if (msg) msg.classList.add('hide');
    }, 2000);

    function deleteReport() {
        Toastify({
            text: "Lost Report has been deleted!",
            duration: 2000,
            gravity: "top",
            position: "center",
            backgroundColor: "red",
        }).showToast();
    }
</script>