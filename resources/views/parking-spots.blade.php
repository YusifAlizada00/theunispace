<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[300px]">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight">Parking Spots</h1>
                    <p class="text-slate-500 text-lg mt-1">Find the best spot near campus.</p>
                </div>
                
                <div class="flex gap-2">
                    <div class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-xl text-xs font-bold uppercase tracking-wider border border-emerald-100">
                        {{ $parking_spots->where('is_free', true)->count() }} Free
                    </div>
                    <div class="px-4 py-2 bg-white text-slate-500 rounded-xl text-xs font-bold uppercase tracking-wider border border-gray-200">
                        {{ $parking_spots->count() }} Total
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-8 bg-emerald-500 text-white p-4 rounded-2xl shadow-lg shadow-emerald-200 flex justify-between items-center">
                    <span class="font-bold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                    </span>
                    <button @click="show = false" class="hover:bg-emerald-600 rounded-full p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                
                @forelse($parking_spots as $parkingSpot)
                    <div class="group relative bg-white rounded-[2rem] shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 flex flex-col h-full">
                        
                        <div class="h-1.5 w-full {{ $parkingSpot->is_free ? 'bg-emerald-400' : 'bg-orange-400' }}"></div>

                        <div class="p-6 flex flex-col h-full">
                            
                            <div class="flex justify-between items-start mb-4">
                                <div class="bg-gray-50 p-2 rounded-xl">
                                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                
                                @if($parkingSpot->is_free)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        Free
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-orange-50 text-orange-600 border border-orange-100">
                                        Paid
                                    </span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-black text-slate-900 mb-3 leading-tight group-hover:text-indigo-600 transition-colors">
                                    {{ $parkingSpot->street_name }}
                                </h2>
                                
                                <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 space-y-3">
                                    
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center text-indigo-400 shadow-sm shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">
                                            {{ $parkingSpot->day_from }} - {{ $parkingSpot->day_to }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2.5">
                                        <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center text-indigo-600 shadow-sm shrink-0">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <span class="text-lg font-black text-slate-800">
                                            {{ \Carbon\Carbon::parse($parkingSpot->time_from)->format('g:i A') }} 
                                            <span class="text-gray-300 font-normal px-0.5">-</span> 
                                            {{ \Carbon\Carbon::parse($parkingSpot->time_to)->format('g:i A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-xs font-bold text-gray-400 uppercase mb-3">
                                From Main Library
                            </p>

                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Walking</p>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L11 2m0 0l-2.5 2.5M11 2v4.5m0 0l-3 3m3-3l3 3m-3-3v3.5m0 0l-4 4m4-4l4 4"/></svg>
                                        <span class="font-bold text-slate-700">{{ number_format($parkingSpot->distance_meters / 1000, 1) }} <span class="text-xs text-gray-400 font-normal">km</span></span>
                                    </div>
                                </div>
                                <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Driving</p>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                        <span class="font-bold text-slate-700">{{ number_format($parkingSpot->driving_distance_meters / 1000, 1) }} <span class="text-xs text-gray-400 font-normal">km</span></span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-sm text-gray-500 leading-relaxed mb-6">
                                {{ $parkingSpot->description ?? 'No additional details provided for this location.' }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ $parkingSpot->map_link }}" target="_blank" 
                                   class="flex items-center justify-center gap-2 w-full py-3 bg-slate-900 hover:bg-indigo-600 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-indigo-200">
                                    <span>Open Map</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-[2.5rem] border border-dashed border-gray-200">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">No spots found</h3>
                        <p class="text-slate-500">Check back later for updates.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>