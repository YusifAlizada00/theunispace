<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 pb-24">
        <main class="w-full transition-all duration-300 md:pl-[100px] lg:pl-[300px]">
            <div class="max-w-7xl mx-auto p-4 pt-16 md:pt-10">

                 @if(session('success'))
                    <div id="success-msg" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-slate-900 text-white px-6 py-3 rounded-full shadow-xl shadow-indigo-500/20 transition-all duration-500">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                     @if(session('warning'))
                        <div id="warning-msg" class="fixed top-5 left-1/2 -translate-x-1/2 z-50 flex items-center gap-3 bg-slate-900 text-white px-6 py-3 rounded-full shadow-xl shadow-indigo-500/20 transition-all duration-500">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="font-medium text-sm">{{ session('warning') }}</span>
                        </div>
                    @endif
                {{-- Header Section --}}
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                    <div>
                        <h2 class="text-4xl font-black text-slate-900 tracking-tight">Lost & Found</h2>
                        <p class="text-slate-500 mt-2 text-lg">Reuniting students with their stuff.</p>
                    </div>

                    <a href="{{ route('report-lost') }}"
                        class="group inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-slate-200 transition-all duration-300 hover:-translate-y-1 hover:shadow-indigo-500/30">
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Report Lost Item
                    </a>
                </div>

                {{-- Items Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 w-full">
                    @forelse ($reported_items as $reported_item)
                        {{-- Added ID to container for JS targeting --}}
                        <div id="item-card-{{ $reported_item->id }}" data-report-id="{{ $reported_item->id }}"
                            class="group relative bg-white border border-slate-100 rounded-[2rem] overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-1 flex flex-col">
                            
                            {{-- Image Area --}}
                            <a href="{{ route('lost-report.show', $reported_item->slug) }}" class="relative aspect-[4/3] w-full overflow-hidden bg-gray-100 block">
                                @if($reported_item->images_lost && count($reported_item->images_lost) > 0)
                                    <img src="{{ asset('storage/' . $reported_item->images_lost[0]) }}" alt="Lost Item" loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 text-slate-300">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-xs font-bold uppercase tracking-wider">No Image</span>
                                    </div>
                                @endif

                                {{-- Status Badge --}}
                                <div class="absolute top-4 left-4">
                                    <span id="badge-{{ $reported_item->id }}" 
                                        class="status-badge px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest backdrop-blur-md shadow-lg transition-colors duration-300
                                        {{ $reported_item->found 
                                            ? 'bg-emerald-500 text-white shadow-emerald-500/20' 
                                            : 'bg-red-500 text-white shadow-red-500/20' }}">
                                        {{ $reported_item->found ? 'Found' : 'Lost' }}
                                    </span>
                                </div>
                            </a>

                            {{-- Content Area --}}
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <a href="{{ route('lost-report.show', $reported_item->slug) }}">
                                            <h3 class="text-lg font-bold text-slate-900 leading-tight group-hover:text-indigo-600 transition-colors mb-1">
                                                {{ $reported_item->item_name }}
                                            </h3>
                                        </a>
                                        <p class="text-xs font-medium text-slate-400">
                                            {{ $reported_item->getTimeAgoAttribute() }}
                                        </p>
                                    </div>
                                    
                                    {{-- Options Menu --}}
                                    @if (Auth::user()->id == $reported_item->user_id)  
                                        <div x-data="{ open: false }" class="relative">
                                            <button
                                                @click="open = !open"
                                                class="p-2 rounded-full
                                                    text-slate-500
                                                    hover:text-slate-800
                                                    hover:bg-slate-100
                                                    transition-all duration-200">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <circle cx="10" cy="4" r="1.5"/>
                                                    <circle cx="10" cy="10" r="1.5"/>
                                                    <circle cx="10" cy="16" r="1.5"/>
                                                </svg>
                                            </button>
                                            <div x-show="open" x-cloak @click.away="open = false"
                                                class="absolute right-0 top-full mt-1 w-44 bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden py-1">
                                                
                                                {{-- Copy Link --}}
                                                <input type="text" id="copyInput-{{ $reported_item->id }}" value="{{ url('lost-found/' . $reported_item->slug) }}" class="hidden">
                                                <button onclick="copyToClipboard({{ $reported_item->id }})" class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                                    Copy Link
                                                </button>
                                                
                                                {{-- Toggle Found --}}
                                                <button type="button" data-url="{{ url('/lost-found/' . $reported_item->id . '/found') }}" onclick="markAsFound({{ $reported_item->id }}, this)"
                                                    class="w-full text-left px-4 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors flex items-center gap-2">
                                                    
                                                    {{-- We use a generic icon here, or you can swap logic to change icon based on state --}}
                                                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    
                                                    <span id="toggle-text-{{ $reported_item->id }}">
                                                        {{ $reported_item->found ? 'Mark as Lost' : 'Mark as Found' }}
                                                    </span>
                                                </button>

                                                {{-- Delete --}}
                                                <form action="{{ route('report-lost.delete', $reported_item->slug) }}" method="POST">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 transition-colors flex items-center gap-2">
                                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <p class="text-slate-500 text-sm leading-relaxed line-clamp-2 mb-6">
                                    {{ $reported_item->detailed_description }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                                    <div class="flex items-center gap-1.5 text-slate-400 text-xs font-bold truncate max-w-[50%]">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span class="truncate">{{ $reported_item->location_lost }}</span>
                                    </div>

                                    <a href="{{ route('contact-form', $reported_item->slug) }}"
                                        class="group inline-flex items-center gap-1.5 text-xs font-black
                                                bg-gradient-to-r from-indigo-600 to-indigo-500 text-white
                                                px-3.5 py-2 rounded-xl
                                                shadow-sm shadow-indigo-200 hover:shadow-md hover:shadow-indigo-300
                                                hover:-translate-y-0.5 transition-all duration-200">
                                        <svg class="w-3.5 h-3.5 opacity-90 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.2-3.2A7.963 7.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <h3 class="text-slate-900 font-bold text-lg">No lost items reported</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
<script>
    function copyToClipboard(reportedItemId) {
        const copyText = document.getElementById('copyInput-' + reportedItemId);
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
                fontWeight: "bold",
                boxShadow: "0 10px 15px -3px rgb(0 0 0 / 0.1)"
            }
        }).showToast();
    };

    function markAsFound(id, btnElement) {
        const url = btnElement.getAttribute('data-url');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(url, {
            method: 'POST', // or 'PUT' depending on your route
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            // 1. Update the Badge UI
            const badge = document.getElementById('badge-' + id);
            
            if (data.found) {
                // Switch to Found Styles
                badge.textContent = 'Found';
                badge.classList.remove('bg-red-500', 'shadow-red-500/20');
                badge.classList.add('bg-emerald-500', 'shadow-emerald-500/20');
            } else {
                // Switch to Lost Styles
                badge.textContent = 'Lost';
                badge.classList.remove('bg-emerald-500', 'shadow-emerald-500/20');
                badge.classList.add('bg-red-500', 'shadow-red-500/20');
            }

            // 2. Update the Dropdown Button Text
            const btnText = document.getElementById('toggle-text-' + id);
            if (btnText) {
                btnText.textContent = data.found ? 'Mark as Lost' : 'Mark as Found';
            }

            // 3. Show Toast
            Toastify({
                text: data.message,
                duration: 3000,
                gravity: "top",
                position: "center",
                style: {
                    background: data.found ? "#10b981" : "#ef4444", // Emerald for found, Red for lost
                    borderRadius: "50px",
                    color: "white",
                    fontWeight: "bold",
                    boxShadow: "0 10px 15px -3px rgb(0 0 0 / 0.1)"
                }
            }).showToast();
        })
        .catch(error => {
            console.error('Error:', error);
            Toastify({
                text: "Something went wrong",
                duration: 3000,
                style: { background: "#ef4444" }
            }).showToast();
        });
    }
</script>