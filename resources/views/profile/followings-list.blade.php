<x-app-layout>
<div>
    <div class="flex flex-col items-center min-h-screen bg-gray-50 py-10 space-y-4 mx-4">
        @foreach ($followings as $following)
            <div
                class="w-full max-w-3xl border border-gray-300 rounded-lg p-4 flex justify-between items-center bg-white shadow-sm hover:shadow-md transition-shadow duration-200">
                <div class="flex flex-row gap-3 items-center flex-1 min-w-0">
                    <img src="{{ asset($following->profile_photo_url) }}" alt="Profile" class="rounded-full w-12 h-12 flex-shrink-0">
                    <div class="flex flex-col overflow-hidden">
                        <span class="font-semibold text-gray-800 truncate">
                            {{ Str::limit($following->name, 15) }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('posts.all', ['name' => $following->slug]) }}"
                        class="px-2 py-2 text-sm md:text-[16px] bg-gray-200 text-gray-800 rounded-md whitespace-nowrap hover:bg-gray-300 transition-colors duration-200">
                        View Profile
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

</x-app-layout>
