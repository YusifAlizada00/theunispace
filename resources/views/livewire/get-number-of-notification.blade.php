<div>
    {{-- Desktop Notification Link --}}
    <div class="md:block hidden">
        <div class="relative" wire:poll.2s="refreshCount">
            <a href="{{ route('notifications') }}" id="notification-link"
               class="group flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 ease-in-out
                      {{ request()->routeIs('notifications') ? 'bg-gray-200 text-gray-900 shadow-lg shadow-slate-900/10' : 'text-gray-500 hover:bg-gray-300 hover:text-gray-900' }}">
                
                <div class="relative flex-shrink-0 -ml-3">
                    <img src="{{ asset('icons/notification.png') }}" alt="Notification" 
                         class="w-6 h-6 transition-transform duration-300 group-hover:scale-110
                         {{ request()->routeIs('notifications') ? 'brightness-200 grayscale' : 'grayscale group-hover:grayscale-0' }}">
                    
                    @if($unreadNotificationCount > 0)
                        <span id="notification-count"
                              class="absolute -top-1.5 -right-1.5 flex items-center justify-center min-w-[16px] h-[16px] px-0.5 text-[9px] font-bold text-white bg-red-600 border-2 border-white rounded-full {{ request()->routeIs('notifications') ? 'border-slate-900' : '' }}">
                            {{ $unreadNotificationCount }}
                        </span>
                    @endif
                </div>

                <!-- Reserve space for text to prevent icon shifting -->
                <span class="font-bold text-sm min-w-[90px]">Notifications</span>
            </a>
        </div>
    </div>

    {{-- Mobile Notification Link --}}
    <div class="md:hidden block">
        <div class="relative">
            <a href="{{ route('notifications') }}" 
                class="flex flex-col items-center justify-center p-5 rounded-[2rem] bg-white border border-gray-100 shadow-sm active:scale-95 transition-all duration-200 hover:border-orange-200 hover:shadow-orange-100/50">
                
                <div class="p-3 bg-indigo-50 rounded-2xl mb-3 text-indigo-600">
                    <img src="{{ asset('icons/notification.png') }}" alt="Notification" 
                         class="w-7 h-7">

                    {{-- Mobile Badge --}}
                    @if(auth()->user()->unreadNotifications()->count() > 0)
                        <span id="notification-count"
                              class="absolute -top-1 -right-1 flex items-center justify-center min-w-[16px] h-[16px] px-0.5 text-[9px] font-bold text-white bg-red-600 border border-white rounded-full z-10">
                            {{ auth()->user()->unreadNotifications()->count() }}
                        </span>
                    @endif
                </div>

                <!-- Reserve space for label so icon doesn't jump -->
                <span class="text-xs font-bold min-w-[60px] text-center">Notifications</span>
            </a>
        </div>
    </div>
</div>
