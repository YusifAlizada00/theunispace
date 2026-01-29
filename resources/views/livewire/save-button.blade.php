<div class="ml-auto md:-ml-8">
    @if ($isSaved)
        <button wire:click="unsave" class="ml-auto md:-ml-8">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="black" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        </button>
    @else
        <button wire:click="save" class="ml-auto md:-ml-8">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
        </button>
    @endif
</div>
