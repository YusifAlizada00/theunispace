<x-guest-layout>
    {{-- Outer Container --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        
        {{-- Main Card: Split Design --}}
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- LEFT SIDE: Branding & Security Context --}}
            <div class="w-full md:w-1/2 bg-gradient-to-br from-green-50 to-[#E8F5E9] flex flex-col items-center justify-center p-10 relative overflow-hidden">
                {{-- Decorative Blobs --}}
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute top-[-50px] left-[-50px] w-64 h-64 bg-[#94CC95] rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[-50px] right-[-50px] w-64 h-64 bg-[#006BE6] rounded-full blur-3xl"></div>
                </div>

                {{-- Logo --}}
                <img src="{{ asset('webImages/theunispace-logo-tiny.png') }}"
                     alt="TheUniSpace Logo" loading="lazy"
                     class="relative z-10 w-40 h-40 object-contain drop-shadow-xl mb-6">
                
                {{-- Security Icon (Lock) --}}
                <div class="relative z-10 bg-white p-4 rounded-full shadow-lg mb-4">
                    <svg class="w-8 h-8 text-[#94CC95]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-800 relative z-10 tracking-tight text-center">
                    Security Check
                </h2>
                <p class="mt-2 text-gray-500 font-medium text-center text-sm max-w-xs relative z-10">
                    For your security, please confirm your password to continue.
                </p>
            </div>

            {{-- RIGHT SIDE: Password Form --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center">
                
                {{-- Header --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Confirm Password</h1>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    {{-- Password Input --}}
                    <div>
                        <x-label for="password" value="{{ __('Password') }}" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
                        <x-input id="password" 
                                class="block w-full px-4 py-3 bg-gray-50 border-gray-100 focus:bg-white focus:border-[#94CC95] focus:ring-[#94CC95] rounded-xl transition-all" 
                                type="password" name="password" 
                                required autocomplete="current-password" autofocus
                                placeholder="••••••••" />
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-4">
                        <button type="submit" 
                                class="w-full py-3.5 px-4 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl shadow-lg shadow-green-100 transform active:scale-[0.98] transition-all duration-200">
                            {{ __('Confirm') }}
                        </button>
                        
                        {{-- Optional Cancel Button (Goes back) --}}
                        <a href="{{ url()->previous() }}" class="text-center text-sm font-bold text-gray-400 hover:text-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>