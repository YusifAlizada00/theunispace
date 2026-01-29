<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="min-h-screen bg-gray-50/50 py-12 px-4 md:pl-[100px] lg:pl-[300px]">
        <div class="max-w-3xl mx-auto">
            <div class="mb-10">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                    Add Free Parking Spot
                </h1>
                <p class="text-slate-500 mt-2">
                    Admin-only form to manage student parking locations.
                </p>
            </div>
            <form
                method="POST"
                action="{{ route('parking-spot.store') }}"
                x-data="{ submitting: false }" 
                @submit.prevent="if(submitting) return; submitting = true; $el.submit()" 
                class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 p-8 space-y-8"
            >
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Street Name
                    </label>
                    <input
                        type="text"
                        name="street_name"
                        placeholder="Albert Street"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    >
                </div>

                {{-- Day Range --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Day From
                        </label>
                        <select
                            name="day_from"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Day To
                        </label>
                        <select
                            name="day_to"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Time From
                        </label>
                        <input
                            type="time"
                            name="time_from"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Time To
                        </label>
                        <input
                            type="time"
                            name="time_to"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Walking Distance (meters)
                        </label>
                        <input
                            type="number"
                            step="0.1"
                            name="distance_meters"
                            placeholder="0.5"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Driving Distance (meters)
                        </label>
                        <input
                            type="number"
                            step="0.1"
                            name="driving_distance_meters"
                            placeholder="1.2"
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>

                </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">
                            Description (Optional)
                        </label>
                        <textarea
                            name="description"
                            placeholder="Additional details about the parking spot..."
                            class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        ></textarea>
                    </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">
                        Google Maps Location Link
                    </label>
                    <input
                        type="url"
                        name="map_link"
                        placeholder="https://maps.google.com/..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 truncate"
                    >
                    <p class="text-xs text-slate-400 mt-1">
                        Paste the full Google Maps link to the parking location.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        name="is_free"
                        value="1"
                        checked
                        class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    >
                    <label class="text-sm font-semibold text-slate-700">
                        This parking spot is free
                    </label>
                </div>
                <div class="pt-4 flex flex-col md:flex-row items-center gap-4">
                    <a href="{{ route('parking-spots') }}" class="order-2 md:order-1 text-sm font-semibold text-gray-500 hover:text-gray-700">
                        Cancel
                    </a>
                    <div class="w-full md:w-auto md:ml-auto order-1 md:order-2">
                        <button type="submit" 
                            :disabled="submitting"
                            :class="{ 'opacity-50 cursor-not-allowed pointer-events-none': submitting }"
                            class="group relative w-full md:w-auto px-8 bg-slate-900 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-2xl hover:shadow-indigo-500/30 hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0 disabled:hover:shadow-xl disabled:hover:bg-slate-900">
                            <span x-show="!submitting" class="relative z-10 flex items-center justify-center gap-2">
                                Create Parking Spot
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>
                            <span x-show="submitting" x-cloak class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Creating...
                            </span>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>