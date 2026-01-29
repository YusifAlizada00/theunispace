<x-guest-layout>
    {{-- Outer Container --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
        
        {{-- Main Card: Split Design --}}
        <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            
            {{-- LEFT SIDE: Branding & Context --}}
            <div class="w-full md:w-1/2 bg-gradient-to-br from-green-50 to-[#E8F5E9] flex flex-col items-center justify-center p-10 relative overflow-hidden">
                {{-- Decorative Blobs --}}
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute top-[-50px] left-[-50px] w-64 h-64 bg-[#94CC95] rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[-50px] right-[-50px] w-64 h-64 bg-[#006BE6] rounded-full blur-3xl"></div>
                </div>

                {{-- Logo --}}
                <img src="{{ asset('webImages/thegoalify-logo.png') }}"
                     alt="TheGoalify Logo"
                     class="relative z-10 w-40 h-40 object-contain drop-shadow-xl mb-6">
                
                {{-- Email Icon --}}
                <div class="relative z-10 bg-white p-4 rounded-full shadow-lg mb-4">
                    <svg class="w-8 h-8 text-[#94CC95]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-800 relative z-10 tracking-tight text-center">
                    Check Your Inbox
                </h2>
                <p class="mt-2 text-gray-500 font-medium text-center text-sm max-w-xs relative z-10">
                    We've sent a verification link to your email address.
                </p>
            </div>

            {{-- RIGHT SIDE: Actions --}}
            <div class="w-full md:w-1/2 p-8 md:p-12 bg-white flex flex-col justify-center">
                
                {{-- Header --}}
                <div class="mb-6 text-center md:text-left">
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Verify Email</h1>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                        {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>
                </div>

                {{-- Success Message --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-100 flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}</span>
                    </div>
                @endif

                {{-- Primary Action: Resend Email --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full py-3.5 px-4 bg-[#94CC95] hover:bg-[#82b983] text-white font-bold rounded-xl shadow-lg shadow-green-100 transform active:scale-[0.98] transition-all duration-200">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                {{-- Secondary Actions: Edit Profile & Logout --}}
                <div class="mt-6 flex items-center justify-between border-t border-gray-100 pt-6">
                    
                    {{-- Edit Profile Link --}}
                    <a href="{{ route('posts.all', ['name' => Auth::user()->slug]) }}"
                       class="text-sm font-bold text-gray-400 hover:text-[#006BE6] transition flex items-center gap-2">
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                       {{ __('Edit Profile') }}
                    </a>

                    {{-- Logout Form --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-400 hover:text-red-500 transition flex items-center gap-2">
                            {{ __('Log Out') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>