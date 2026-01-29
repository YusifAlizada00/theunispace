<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[300px]">
        <div class="max-w-3xl mx-auto">
            <div class="mb-10">
                <a href="{{ route('study-groups') }}" class="inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-500 transition-colors mb-6 bg-indigo-50 px-4 py-2 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Groups
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Create New Group</h1>
                <p class="text-slate-500 text-lg">Lead the way. Help others succeed.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden relative">
                
                <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <form x-data="{ submitting: false }" 
                      @submit.prevent="if(submitting) return; submitting = true; $el.submit()" 
                      action="{{ route('study-groups.store') }}" 
                      method="POST" 
                      class="p-8 md:p-10 space-y-10">
                    
                    @csrf
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">1</div>
                            <h3 class="text-lg font-bold text-slate-800">The Basics</h3>
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                <svg class="h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Group Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="group_name" value="{{ old('group_name') }}" placeholder="e.g. Calculus Finals Prep" required
                                class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold placeholder:text-gray-400 placeholder:font-normal">
                            @error('group_name') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="">
                            <div>
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                    <svg class="h-4 w-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="e.g. Math 101" required
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold placeholder:text-gray-400 placeholder:font-normal">
                                @error('subject') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                            </div>

                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-2 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm">2</div>
                            <h3 class="text-lg font-bold text-slate-800">Logistics</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                    <svg class="h-4 w-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" value="{{ old('date') }}" required
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold text-slate-600">
                                @error('date') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                    <svg class="h-4 w-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Location <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. Library Room 3B" required
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold placeholder:text-gray-400 placeholder:font-normal">
                                @error('location') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">From  <span class="text-red-500">*</span></label>
                                <input type="time" name="start_time" value="{{ old('start_time') }}" required
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold text-slate-600 text-center">
                                @error('start_time') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">To  <span class="text-red-500">*</span></label>
                                <input type="time" name="end_time" value="{{ old('end_time') }}" required
                                    class="w-full px-5 py-4 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-semibold text-slate-600 text-center">
                                @error('end_time') <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                            Description <span class="text-gray-400 font-normal text-xs">(Optional)</span>
                        </label>
                        <textarea name="description" rows="4" placeholder="What are the goals for this session?"
                            class="w-full p-5 rounded-2xl bg-gray-50 border-transparent focus:bg-white transition-all font-medium resize-none placeholder:text-gray-400 placeholder:font-normal">{{ old('description') }}</textarea>
                    </div>
                    <div class="pt-6">
                        <button type="submit" 
                            :disabled="submitting"
                            :class="{ 'opacity-50 cursor-not-allowed pointer-events-none': submitting }"
                            class="group relative w-full bg-slate-900 text-white font-bold py-5 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-2xl hover:shadow-indigo-500/30 hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:hover:shadow-xl disabled:hover:bg-slate-900">
                            <span x-show="!submitting" class="relative z-10 flex items-center justify-center gap-2">
                                Create Study Group
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>
                            <span x-show="submitting" x-cloak class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Creating Group...
                            </span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>