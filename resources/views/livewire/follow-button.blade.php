<div>
    @if($isFollowing)
        @if(auth()->id() !== $user->id)
            <x-button 
                wire:click="unfollow" 
                class="w-32 justify-center bg-red-600 hover:bg-red-500 active:bg-red-600"
            >
                Unfollow
            </x-button>
        @endif
    @else
        @if(auth()->id() !== $user->id)
            <x-button
                wire:click="follow" 
                class="w-32 justify-center bg-blue-600 hover:bg-blue-500 active:bg-blue-800"
            >
                Follow
            </x-button>
        @endif
    @endif
</div>
