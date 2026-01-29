<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-teal-50 py-12 px-4">
        <div class="max-w-3xl mx-auto md:ml-[100px] lg:ml-[300px]">
            
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">Tell Us About It</h1>
                <p class="text-slate-500 font-medium">We appreciate your help</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-blue-100/50 p-8 md:p-12 border border-white">
                <form action="{{ route('contact-lost-report', $reportLost->id) }}" method="POST" enctype="multipart/form-data" x-data="{ type: 'lost' }">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Item Name</label>
                            <input type="text" name="item_name" placeholder="e.g. iPhone 13, Blue Wallet" 
                                   class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 ml-1 required">Date</label>
                            <input type="date" name="date_found" 
                                   class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                    </div>

                    <div class="space-y-2 mb-8">
                        <label class="text-sm font-bold text-slate-700 ml-1 required">Specific Location</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <input type="text" name="location_found" placeholder="e.g. Central Park, near the fountain" 
                                   class="w-full bg-slate-50 border-none rounded-2xl p-4 pl-12 focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                        </div>
                    </div>

                    <div class="space-y-2 mb-8">
                        <label class="text-sm font-bold text-slate-700 ml-1 required">Detailed Description</label>
                        <textarea name="detailed_description" rows="4" placeholder="Describe unique marks, colors, size..." 
                                  class="w-full bg-slate-50 border-none rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 transition shadow-inner resize-none" required>
                        </textarea>
                    </div>

                    <div class="mb-10">
                        <label class="text-sm font-bold text-slate-700 ml-1 block mb-2">Upload Photos</label>
                        <label class="group cursor-pointer flex flex-col items-center justify-center w-full h-44 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] hover:bg-indigo-50 hover:border-indigo-300 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="p-3 bg-white rounded-2xl shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                </div>
                                <p class="text-sm font-bold text-slate-600">Browse Files</p>
                                <p class="text-xs text-slate-400 mt-1">Drag & Drop or click to upload</p>
                            </div>
                            <input type="file" name="images_found[]" class="hidden" multiple accept="image/*">
                        </label>
                    </div>

                    <button type="submit" 
                            class="w-full bg-slate-900 text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-slate-200 hover:bg-indigo-600 hover:-translate-y-1 transition-all active:scale-95">
                        Message Owner
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
  .required:after {
    content:" *";
    color: red;
  }
</style>