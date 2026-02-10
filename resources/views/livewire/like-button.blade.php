<div class="flex items-center">
    @if ($isLiked)
        <button wire:click="unlike" class="flex items-center gap-2 text-slate-500 hover:text-pink-500 transition-colors group" aria-label="Unlike post">
            <svg class="w-6 h-6 transition-transform group-hover:scale-110 text-pink-500 fill-pink-500" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>        
        </button>
        @if (count($post->likedUsers))
            @auth
                <a href="{{ route('likedUsers', ['post' => $post->slug]) }}">
                    <span class="ml-2 hover:underline cursor-pointer dark:text-gray-800">{{ $post->likedUsers()->count() }}</span>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <span class="ml-2 hover:underline cursor-pointer dark:text-gray-800">{{ $post->likedUsers()->count() }}</span>
                </a>
            @endauth
        @else
            <span class="text-sm hover:text-ping-500 font-semibold ml-2">Like</span>
        @endif
    @else
        <button wire:click="like" class="flex items-center gap-2 text-slate-500 hover:text-pink-500 transition-colors group" aria-label="Like post">
            <svg class="w-6 h-6 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </button>
        @if (count($post->likedUsers))
            @auth
                <a href="{{ route('likedUsers', ['post' => $post->slug]) }}">
                    <span class="ml-2 hover:underline cursor-pointer dark:text-gray-800">{{ $post->likedUsers()->count() }}</span>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <span class="ml-2 hover:underline cursor-pointer dark:text-gray-800">{{ $post->likedUsers()->count() }}</span>
                </a>
            @endauth
        @else
            <span class="text-sm font-semibold ml-2 hover:text-pink-500">Like</span>
        @endif
    @endif
</div>
