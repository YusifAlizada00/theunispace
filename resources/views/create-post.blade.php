<x-app-layout>
    <div class="relative flex justify-center pb-24">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-6 mt-16 md:mt-10 md:ml-[100px] lg:ml-[280px] mx-4"
            x-data="{
                files: [],
                description: '',
                submitting: false,
                fileChosen(event) {
                    const selectedFiles = Array.from(event.target.files);
                    selectedFiles.forEach(file => {
                        this.files.push({
                            url: URL.createObjectURL(file),
                            type: file.type
                        });
                    });
                },
                removeFile(index) {
                    this.files.splice(index, 1);
                }
             }">

            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data"
            @submit="submitting = true">
                @csrf

                    <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800">New Post</h2>
            <button type="submit"
                    :disabled="submitting || (description.trim() === '')"
                    class="btn btn-primary btn-sm rounded-lg bg-blue-600 border-none text-white px-6">
                <span x-show="!submitting">Share</span>
                <span x-show="submitting" class="loading loading-spinner loading-xs"></span>
            </button>
        </div>
                <div class="mb-6">
                    <div x-show="files.length === 0">
                        <label
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="file" name="media[]" class="hidden" multiple accept="image/*,video/*"
                                @change="fileChosen">
                            <img src="{{ asset('icons/add.png') }}" class="w-10 h-10 mb-2 opacity-50">
                            <p class="text-sm text-gray-500 font-bold">Tap to upload photos or videos</p>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" x-show="files.length > 0" x-cloak>
                        <template x-for="(file, index) in files" :key="index">
                            <div
                                class="relative group aspect-square rounded-xl overflow-hidden border bg-black shadow-sm">

                                <!-- Image Preview -->
                                <template x-if="file.type.startsWith('image')">
                                    <img :src="file.url" class="w-full h-full object-cover">
                                </template>

                                <!-- Video Preview -->
                                <template x-if="file.type.startsWith('video')">
                                    <video :src="file.url" class="w-full h-full object-cover" muted autoplay loop
                                        playsinline controls>
                                    </video>
                                </template>

                                <!-- Remove Button -->
                                <button type="button" @click="removeFile(index)" class="absolute top-2 right-2 bg-red-600/90 text-white rounded-full w-8 h-8
                       flex items-center justify-center shadow-lg z-10
                       block md:hidden">
                                    <span class="text-xl font-bold leading-none">&times;</span>
                                </button>

                                <button type="button" @click="removeFile(index)" class="absolute top-2 right-2 bg-red-600/90 text-white rounded-full w-7 h-7
                       items-center justify-center shadow-lg z-10
                       hidden md:flex md:group-hover:flex">
                                    <span class="text-xl font-bold leading-none">&times;</span>
                                </button>

                            </div>
                        </template>

                        <!-- Add More Button -->
                        <label
                            class="flex flex-col items-center justify-center aspect-square border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="file" name="media[]" class="hidden" multiple accept="image/*,video/*"
                                @change="fileChosen">
                            <span class="text-2xl text-gray-400">+</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Add More</span>
                        </label>
                    </div>

                </div>

                <div class="space-y-4">

                    <textarea name="description" placeholder="Write a caption..." rows="3" x-ref="description" x-model="description"
                        class="textarea textarea-bordered w-full rounded-xl resize-none text-base">{{ old('description') }}</textarea>
                        @error('description') <p class="text-sm text-red-500">{{ $message }}</p>@enderror
                </div>
            </form>
        </div>
    </div>
</x-app-layout>