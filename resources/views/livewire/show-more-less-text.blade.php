<div>
    <p>
        <span class="dark:text-gray-800 {{ $expanded ? '' : 'truncate-text' }}">
            {!! 
                preg_replace(
                    '~((https?://|www\.)[^\s]+)~i',
                    '<a href="$1" target="_blank" class="text-blue-600 underline">$1</a>',
                    e($post->description)
                )
            !!}
        </span>
    </p>

    @if(Str::length(strip_tags($post->description)) > 70)
        <button wire:click="toggle" class="text-blue-500 hover:underline mt-1">
            {{ $expanded ? 'Show Less' : 'Show More' }}
        </button>
    @endif

    <style>
        .truncate-text {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* lines to show when collapsed */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .dark:text-gray-800 a {
            color: #2563EB; /* Tailwind blue-600 */
            text-decoration: underline;
        }
    </style>
</div>
