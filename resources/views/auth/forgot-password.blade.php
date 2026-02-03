<x-guest-layout>
    {{-- Outer Container --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        
        {{-- Main Card: Split Design --}}
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- LEFT SIDE: Branding --}}
            <div class="w-full md:w-1/2 bg-gradient-to-br from-green-50 to-[#E8F5E9] flex flex-col items-center justify-center p-10 relative overflow-hidden">
                {{-- Decorative Blobs --}}
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute top-[-50px] left-[-50px] w-64 h-64 bg-[#94CC95] rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[-50px] right-[-50px] w-64 h-64 bg-[#006BE6] rounded-full blur-3xl"></div>
                </div>

                {{-- Logo --}}
                <img src="{{ asset('webImages/theunispace-logo.png') }}"
                     alt="TheUniSpace Logo"
                     class="relative z-10 w-40 h-40 object-contain transition-transform duration-500 hover:scale-110 drop-shadow-xl">
                
                <h2 class="mt-6 text-2xl font-black text-gray-800 relative z-10 tracking-tight text-center">
                    Account Recovery
                </h2>
                <p class="mt-2 text-gray-500 font-medium text-center text-sm max-w-xs relative z-10">
                    Don't worry, it happens to the best of us. Let's get you back on track.
                </p>
            </div>

            {{-- RIGHT SIDE: Form --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center">
                
                {{-- Header --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Forgot Password?</h1>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                        {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-100 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $value }}
                    </div>
                @endsession

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    {{-- Email Input --}}
                    <div>
                        <x-label for="email" value="{{ __('Email Address') }}" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
                        <x-input id="email" 
                                class="block w-full px-4 py-3 bg-gray-50 border-gray-100 focus:bg-white focus:border-[#94CC95] focus:ring-[#94CC95] rounded-xl transition-all" 
                                type="email" name="email" :value="old('email')" 
                                required autofocus autocomplete="username" 
                                placeholder="name@student.sl.on.ca" />
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" 
                            class="w-full py-3.5 px-4 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl shadow-lg shadow-green-100 transform active:scale-[0.98] transition-all duration-200">
                        {{ __('Email Password Reset Link') }}
                    </button>

                    {{-- Back to Login Link --}}
                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-400 hover:text-[#006BE6] transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Back to Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>