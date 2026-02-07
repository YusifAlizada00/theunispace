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
                
                {{-- 2FA Icon --}}
                <div class="relative z-10 bg-white p-4 rounded-full shadow-lg mb-4">
                    <svg class="w-8 h-8 text-[#94CC95]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-800 relative z-10 tracking-tight text-center">
                    Two-Factor Authentication
                </h2>
                <p class="mt-2 text-gray-500 font-medium text-center text-sm max-w-xs relative z-10">
                    Extra security to keep your account safe.
                </p>
            </div>

            {{-- RIGHT SIDE: Form with Toggle Logic --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center" x-data="{ recovery: false }">
                
                {{-- Header (Dynamic Text) --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Verify Identity</h1>
                    
                    {{-- Default Instruction --}}
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </p>

                    {{-- Recovery Instruction --}}
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed" x-cloak x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-6">
                    @csrf

                    {{-- Authentication Code Input --}}
                    <div x-show="! recovery">
                        <x-label for="code" value="{{ __('Authentication Code') }}" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
                        <x-input id="code" 
                                class="block w-full px-4 py-3 bg-gray-50 border-gray-100 focus:bg-white focus:border-[#94CC95] focus:ring-[#94CC95] rounded-xl transition-all text-center tracking-[0.5em] font-bold text-lg" 
                                type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" 
                                placeholder="123 456" />
                    </div>

                    {{-- Recovery Code Input --}}
                    <div x-cloak x-show="recovery">
                        <x-label for="recovery_code" value="{{ __('Recovery Code') }}" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
                        <x-input id="recovery_code" 
                                class="block w-full px-4 py-3 bg-gray-50 border-gray-100 focus:bg-white focus:border-[#94CC95] focus:ring-[#94CC95] rounded-xl transition-all font-mono" 
                                type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" 
                                placeholder="Paste your recovery code" />
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-4 mt-4">
                        <button type="submit" 
                                class="w-full py-3.5 px-4 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl shadow-lg shadow-green-100 transform active:scale-[0.98] transition-all duration-200">
                            {{ __('Log in') }}
                        </button>

                        {{-- Toggle Links --}}
                        <div class="text-center">
                            <button type="button" class="text-sm font-bold text-gray-400 hover:text-[#006BE6] transition underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                                {{ __('Use a recovery code') }}
                            </button>

                            <button type="button" class="text-sm font-bold text-gray-400 hover:text-[#006BE6] transition underline cursor-pointer"
                                    x-cloak
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                                {{ __('Use an authentication code') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>