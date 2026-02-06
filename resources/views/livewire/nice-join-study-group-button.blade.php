<div>
    @if(Auth::id() !== $studyGroup->leader_id)
        @if($isJoined)
            <button wire:click="leaveGroup" type="button" {{-- Critical: Prevents form submit reload --}}
                wire:loading.attr="disabled" class="w-full py-3.5 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2
                            bg-red-100 text-red-600 hover:bg-red-100 hover:text-red-700">

                {{-- Icon / Loading Logic --}}
                <svg wire:loading.remove wire:target="leaveGroup" class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <svg wire:loading wire:target="leaveGroup" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>

                <span wire:loading.remove wire:target="leaveGroup">Leave Group</span>
                <span wire:loading wire:target="leaveGroup">Leaving...</span>
            </button>
        @else
            {{-- YOUR ORIGINAL JOIN BUTTON STYLE --}}
            <button wire:click="joinGroup" type="button" wire:loading.attr="disabled" class="w-full py-3.5 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2
                            bg-indigo-600 text-white hover:bg-indigo-700">

                <svg wire:loading.remove wire:target="joinGroup" class="w-4 h-4" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <svg wire:loading wire:target="joinGroup" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>

                <span wire:loading.remove wire:target="joinGroup">Join Group</span>
                <span wire:loading wire:target="joinGroup">Joining...</span>
            </button>
        @endif
    @endif
</div>