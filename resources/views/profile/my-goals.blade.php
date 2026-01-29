<x-app-layout>
    <!-- Desktop Layout (md and above) -->
    <div class="hidden md:grid grid-cols-2 gap-12 w-full px-8 sm:px-20 lg:px-40 h-full pb-4 mt-12">
        <!-- Left Column: Post Title + Image + Button -->
        <div class="flex flex-col ml-8 md:ml-32 items-center">
            <h1 class="font-bold md:whitespace-nowrap dark:text-gray-900">{{ $post->title }}</h1>

            <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="mt-8 w-full max-w-[400px]">
                <img class="mx-auto w-full h-auto object-cover rounded-lg"
                     src="{{ asset('storage/' . $post->image) }}" alt="Random Image">
            </a>

            <!-- Centered Livewire Button under image -->
            <div class="mt-16 w-full flex justify-center">
                <livewire:toggle-activate :post="$post" />
            </div>
        </div>

        <!-- Right Column: Notes -->
        <div class="flex flex-col gap-4 h-full max-h-[450px] overflow-y-auto ml-20 w-full mt-4 mx-auto">
            <form action="{{ route('notes.save') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <h2 class="text-xl font-semibold dark:text-gray-900">Your Notes</h2>
                <textarea name="content" placeholder="Write your note..."
                          class="w-full border rounded p-2 mt-2 h-[200px]">{{ old('content', $post->note->content ?? '') }}</textarea>

                <button type="submit" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                    Save
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Layout (below md) -->
    <div class="flex flex-col md:hidden w-full px-8 sm:px-20 lg:px-40 h-full mt-6 items-center overflow-y-auto pb-24">
        <h1 class="font-bold dark:text-gray-900">{{ $post->title }}</h1>

        <a href="{{ route('single-post', ['slug' => $post->slug]) }}" class="mt-4 w-full max-w-[400px]">
            <img class="mx-auto w-full h-auto object-cover rounded-lg"
                 src="{{ asset('storage/' . $post->image) }}" alt="Random Image">
        </a>

 

        <div class="flex flex-col gap-4 h-full max-h-[500px] overflow-y-auto w-full">
            <form action="{{ route('notes.save') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <h2 class="text-xl font-semibold dark:text-gray-900">Your Notes</h2>
                <textarea name="content" placeholder="Write your note..."
                          class="w-full border rounded p-2 mt-2 h-[200px]">{{ old('content', $post->note->content ?? '') }}</textarea>

                <button type="submit" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">
                    Save
                </button>
            </form>
                   <!-- Centered Livewire Button under image -->
            <div class="w-full flex justify-center">
                <livewire:toggle-activate :post="$post" />
            </div>
        </div>
    </div>
</x-app-layout>
