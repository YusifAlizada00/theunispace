<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
        .required:after { content:" *"; color: red; }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-teal-50 py-12 px-4">
        <div class="max-w-3xl mx-auto md:ml-[100px] lg:ml-[300px]">

            <div class="text-center mb-10">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Report a Lost Item</h1>
                <p class="text-slate-500 font-medium">Let’s help reunite you with your item.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-100/50 p-8 md:p-12 border border-white">
                <form action="{{ route('lost-report') }}"
                    x-data="{ submitting: false }" 
                    @submit.prevent="if(submitting) return; submitting = true; $el.submit()" 
                    method="POST" 
                    enctype="multipart/form-data">
                    
                    @csrf

                    <div class="gap-6 mb-8">
                        <div class="space-y-2 w-full">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Short Item Description</label>
                            <input type="text" name="item_name" placeholder="e.g. iPhone 13, Blue Wallet"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                        @error('item_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        <br>
                        <div class="space-y-2 w-full">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Detailed Item Description</label>
                            <textarea name="detailed_description" placeholder="Describe the item..."
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required></textarea>
                        </div>
                        @error('detailed_description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        <br>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Date</label>
                            <input type="date" name="date_lost"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                        @error('date_lost')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        
                        <div class="mt-8">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Time Between</label>
                            <div class="flex items-center mt-2 gap-3 bg-slate-50 p-4 rounded-2xl shadow-inner max-w-sm">
                                <div class="flex flex-col">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">From</label>
                                    <input type="time" name="time_from_lost" class="bg-transparent border-none focus:ring-0 text-slate-900 font-bold p-0" required>
                                </div>
                                @error('time_from_lost')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror

                                <span class="text-slate-300 font-black">—</span>

                                <div class="flex flex-col">
                                    <label class="text-[10px] font-bold text-slate-400 uppercase ml-1">Until</label>
                                    <input type="time" name="time_to_lost" class="bg-transparent border-none focus:ring-0 text-slate-900 font-bold p-0" required>
                                </div>
                                @error('time_to_lost')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 mb-8">
                        <label class="text-sm font-bold text-slate-700 ml-1 required">Specific Location</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <input type="text" name="location_lost" placeholder="e.g. Central Park, near the fountain"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 pl-12 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                        @error('location_lost')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-10">
                        <label class="text-sm font-bold text-slate-700 ml-1 block mb-2">Upload Photos</label>
                        <label class="group cursor-pointer flex flex-col items-center justify-center w-full h-44 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] hover:bg-indigo-50 hover:border-indigo-300 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="p-3 bg-white rounded-2xl shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold text-slate-600">Browse Files</p>
                                <p class="text-xs text-slate-400 mt-1">Drag & Drop or click to upload</p>
                            </div>
                            <input type="file" name="images_lost[]" class="hidden" multiple accept="image/*">
                        </label>
                    </div>

                    <div class="pt-6">
                        <button type="submit" 
                            :disabled="submitting"
                            :class="{ 'opacity-50 cursor-not-allowed pointer-events-none': submitting }"
                            class="group relative w-full bg-slate-900 text-white font-bold py-5 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-2xl hover:shadow-indigo-500/30 hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            
                            <span x-show="!submitting" class="relative z-10 flex items-center justify-center gap-2">
                                Create Lost Report
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>

                            <span x-show="submitting" x-cloak class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Creating Report...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>