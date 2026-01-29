<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        
        <div class="w-full max-w-md md:max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- LEFT: Branding (Desktop only) --}}
            <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-green-50 to-[#E8F5E9] items-center justify-center p-10 relative">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute bottom-[-40px] left-[-40px] w-60 h-60 bg-[#94CC95] rounded-full blur-3xl"></div>
                    <div class="absolute top-[-40px] right-[-40px] w-60 h-60 bg-[#006BE6] rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10 text-center">
                    <img src="{{ asset('webImages/thegoalify-logo.png') }}"
                         class="w-40 h-40 mx-auto object-contain drop-shadow-xl"
                         alt="TheGoalify Logo">

                    <h2 class="mt-6 text-2xl font-black text-gray-800">
                        Welcome to TheGoalify!
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm max-w-xs mx-auto">
                        Set your goals, track your major, and achieve your dreams.
                    </p>
                </div>
            </div>

            {{-- RIGHT: Register --}}
            <div class="w-full md:w-1/2 px-6 py-8 md:px-12 md:py-12">
                
                {{-- Mobile Logo --}}
                <div class="md:hidden text-center mb-6">
                    <img src="{{ asset('webImages/thegoalify-logo.png') }}"
                         class="w-24 h-24 mx-auto object-contain"
                         alt="Logo">
                </div>

                {{-- Header --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-2xl md:text-3xl font-black text-gray-900">
                        Create Account
                    </h1>
                    <p class="text-gray-400 text-sm mt-1">
                        Join us — it takes less than a minute.
                    </p>
                </div>

                <x-validation-errors class="mb-4" />

                {{-- SOCIAL SIGN UP --}}
                <div class="space-y-3">
                    <a href="{{ route('google.redirect') }}"
                       class="w-full flex items-center justify-center gap-3 py-3 rounded-xl border border-gray-200 font-semibold text-gray-700 hover:bg-gray-50 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5">
                        Sign up with Google
                    </a>

                    <a href="{{ route('facebook.redirect') }}"
                       class="w-full flex items-center justify-center gap-3 py-3 rounded-xl font-semibold text-white bg-[#1877F2] hover:bg-[#166FE5] transition">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-5 h-5">
                        Sign up with Facebook
                    </a>
                </div>

                {{-- Divider --}}
                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">OR</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Register Form --}}
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    {{-- Name --}}
                    <x-input
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                        type="text" name="name" :value="old('name')" required
                        placeholder="Full name" />

                    {{-- Email --}}
                    <x-input
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                        type="email" name="email" :value="old('email')" required
                        placeholder="name@student.sl.on.ca" />

                    {{-- Major --}}
                    <x-input
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                        type="text" name="major" :value="old('major')" required
                        placeholder="Major (e.g. Computer Science)" />

                    {{-- Password --}}
                    <x-input
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                        type="password" name="password" required
                        placeholder="Password" />

                    {{-- Confirm Password --}}
                    <x-input
                        class="block w-full px-4 py-3 rounded-xl bg-gray-50 border-gray-200 focus:border-[#94CC95] focus:ring-[#94CC95]"
                        type="password" name="password_confirmation" required
                        placeholder="Confirm password" />

                    {{-- Terms --}}
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <label class="flex items-start gap-2 text-xs text-gray-500">
                            <x-checkbox name="terms" required class="text-[#94CC95]" />
                            <span>
                                I agree to the
                                <a target="_blank" href="{{ route('terms.show') }}"
                                   class="font-bold text-[#006BE6] underline">Terms</a>
                                and
                                <a target="_blank" href="{{ route('policy.show') }}"
                                   class="font-bold text-[#006BE6] underline">Privacy Policy</a>
                            </span>
                        </label>
                    @endif

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full py-3.5 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl transition active:scale-95">
                        Sign Up
                    </button>
                </form>

                {{-- Login --}}
                <p class="text-center text-sm text-gray-500 mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-bold text-[#006BE6]">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
