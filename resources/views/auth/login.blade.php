<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        
        <div class="w-full max-w-md md:max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- LEFT: Brand (hidden on mobile) --}}
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-green-50 to-[#E8F5E9] items-center justify-center p-10 relative">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute top-[-40px] left-[-40px] w-60 h-60 bg-[#94CC95] rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[-40px] right-[-40px] w-60 h-60 bg-[#006BE6] rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 text-center">
                    <img src="{{ asset('webImages/thegoalify-logo.png') }}"
                         class="w-44 h-44 mx-auto object-contain drop-shadow-xl"
                         alt="Logo">
                    <p class="mt-6 text-gray-500 font-medium">
                        Track your goals,<br>achieve your dreams.
                    </p>
                </div>
            </div>

            {{-- RIGHT: Login --}}
            <div class="w-full md:w-1/2 px-6 py-8 md:px-14 md:py-14">
                
                {{-- Mobile Logo --}}
                <div class="md:hidden text-center mb-6">
                    <img src="{{ asset('webImages/thegoalify-logo.png') }}"
                         class="w-24 h-24 mx-auto object-contain"
                         alt="Logo">
                </div>

                {{-- Header --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-2xl md:text-3xl font-black text-gray-900">
                        Welcome Back
                    </h1>
                    <p class="text-gray-400 text-sm mt-1">
                        Sign in to continue
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                @session('status')
                    <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                        {{ $value }}
                    </div>
                @endsession

                {{-- Social Login --}}
                <div class="space-y-3">
                    <a href="{{ route('google.redirect') }}"
                       class="w-full flex items-center justify-center gap-3 py-3 rounded-xl border border-gray-200 font-semibold text-gray-700 hover:bg-gray-50 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                        Continue with Google
                    </a>

                    <a href="{{ route('facebook.redirect') }}"
                       class="w-full flex items-center justify-center gap-3 py-3 rounded-xl font-semibold text-white bg-[#1877F2] hover:bg-[#166FE5] transition">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-5 h-5">
                        Continue with Facebook
                    </a>
                </div>

                {{-- Divider --}}
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">OR</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input id="email"
                            class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                            type="email" name="email" :value="old('email')" required
                            placeholder="Email address" />
                    </div>

                    <div>
                        <x-input id="password"
                            class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                            type="password" name="password" required
                            placeholder="Password" />
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <x-checkbox name="remember" class="text-[#94CC95]" />
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="font-semibold text-[#006BE6]">
                                Forgot Password ?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full py-3.5 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl transition active:scale-95">
                        Log in
                    </button>
                </form>

                {{-- Sign Up --}}
                <p class="text-center text-sm text-gray-500 mt-6">
                    Don't have an account ?
                    <a href="{{ route('register') }}" class="font-bold text-[#006BE6]">
                        Sign up
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
