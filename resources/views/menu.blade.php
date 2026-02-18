<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap');
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
    </style>

    <div class="min-h-screen bg-gray-50 font-sans pb-12">
        
        <div class="relative bg-emerald-900 text-white overflow-hidden shadow-lg">
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"/>
                </svg>
            </div>
            
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-emerald-800 border border-emerald-600 text-xs font-semibold tracking-wider mb-4 text-emerald-100">
                    RAMADAN 2026
                </span>
                <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4 text-white">
                    Iftar Menu & Timings
                </h1>
                <p class="text-emerald-100 text-lg max-w-2xl mx-auto">
                    Discover where the community is breaking their fast tonight.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1633945274405-b6c8069047b0?q=80&w=800&auto=format&fit=crop" 
                             alt="Biryani" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h2 class="text-2xl font-serif font-bold">Residence Hall A</h2>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-800 shadow-sm">
                            Students Only
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-6 bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-medium">7:45 PM</span>
                            </div>
                            <div class="h-4 w-px bg-gray-300"></div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium">Main Dining</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Tonight's Menu</h3>
                            <ul class="space-y-2.5">
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Chicken Biryani
                                </li>
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Vegetable Samosa
                                </li>
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Fruit Chaat & Lassi
                                </li>
                            </ul>
                        </div>

                        <div class="flex gap-3 mt-auto">
                            <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-lg hover:bg-emerald-700 transition font-medium shadow-lg shadow-emerald-200">
                                Save
                            </button>
                            <button class="px-4 py-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition">
                                Comment
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=800&auto=format&fit=crop" 
                             alt="Kebabs" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h2 class="text-2xl font-serif font-bold">Campus Mosque</h2>
                        </div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-emerald-800 shadow-sm">
                            Open to All
                        </div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-6 bg-gray-50 p-3 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="font-medium">8:00 PM</span>
                            </div>
                            <div class="h-4 w-px bg-gray-300"></div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-medium">Courtyard</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Tonight's Menu</h3>
                            <ul class="space-y-2.5">
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Lamb Kebabs
                                </li>
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Hummus & Warm Pita
                                </li>
                                <li class="flex items-start text-gray-700">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Dates & Orange Juice
                                </li>
                            </ul>
                        </div>

                        <div class="flex gap-3 mt-auto">
                            <button class="flex-1 bg-emerald-600 text-white py-2.5 rounded-lg hover:bg-emerald-700 transition font-medium shadow-lg shadow-emerald-200">
                                Save
                            </button>
                            <button class="px-4 py-2.5 text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:text-blue-600 transition">
                                Comment
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col justify-center items-center text-center p-8 hover:border-emerald-500 hover:bg-emerald-50 transition cursor-pointer group">
                    <div class="h-16 w-16 bg-emerald-100 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-1">Host an Iftar?</h3>
                    <p class="text-gray-500 text-sm">Share your menu with the community.</p>
                </div>

            </div>

            <div class="mt-12 text-center">
                <button class="inline-flex items-center px-8 py-3 bg-gray-900 border border-transparent rounded-full font-semibold text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-xl">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Add New Menu
                </button>
            </div>
        </div>
    </div>
</x-app-layout>