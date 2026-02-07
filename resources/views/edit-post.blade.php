<x-app-layout>
    <div class="relative flex justify-center pb-24">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-6 mt-16 md:mt-10 md:ml-[100px] lg:ml-[280px] mx-4"
            x-data="{
                files: @js($post->media->map(fn($m) => [
                    'url' => asset('storage/' . $m->path),
                    'type' => $m->type,
                    'isExisting' => true
                ])),
                description: @js(old('description', $post->description ?? '')),
                submitting: false,

                fileChosen(event) {
                    const selectedFiles = Array.from(event.target.files);
                    selectedFiles.forEach(file => {
                        this.files.push({
                            url: URL.createObjectURL(file),
                            type: file.type,
                            isExisting: false
                        });
                    });
                },
                removeFile(index) {
                    this.files.splice(index, 1);
                    // Note: This only removes the preview. 
                    // To delete existing media from DB, you'd need an extra 'deleted_ids' input.
                }
            }">

            <form action="{{ route('post.update', $post->slug) }}" method="POST" enctype="multipart/form-data"
                @submit="submitting = true">
                @csrf
                @method('PUT')

                <div class="flex items-center justify-between mb-6 border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-800">Edit Post</h2>
                    <button type="submit"
                            :disabled="submitting || !description || description.trim() === ''"
                            class="btn btn-primary btn-sm rounded-lg bg-blue-600 hover:bg-blue-700 border-none text-white px-6 disabled:opacity-50">
                        <span x-show="!submitting">Update</span>
                        <span x-show="submitting" class="flex items-center">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </span>
                    </button>
                </div>

                <div class="mb-6">
                    <div x-show="files.length === 0">
                        <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="file" name="media[]" class="hidden" multiple accept="image/*,video/*" @change="fileChosen">
                            <img src="{{ asset('icons/add.png') }}" class="w-10 h-10 mb-2 opacity-50" alt="Add" loading="lazy">
                            <p class="text-sm text-gray-500 font-bold">Tap to upload photos or videos</p>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" x-show="files.length > 0" x-cloak>
                        <template x-for="(file, index) in files" :key="index">
                            <div class="relative group aspect-square rounded-xl overflow-hidden border bg-black shadow-sm">
                                
                                <template x-if="file.isExisting">
                                    <span class="absolute top-1 left-1 bg-black/50 text-[8px] text-white px-1 rounded z-20">Current</span>
                                </template>

                                <template x-if="file.type.startsWith('image')">
                                    <img :src="file.url" class="w-full h-full object-cover" alt="Preview" loading="lazy">
                                </template>

                                <template x-if="file.type.startsWith('video')">
                                    <video :src="file.url" class="w-full h-full object-cover" muted autoplay loop playsinline></video>
                                </template>

                                <button type="button" @click="removeFile(index)" 
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-7 h-7 flex items-center justify-center shadow-lg z-10 transition hover:bg-red-800">
                                    <span class="text-xl font-bold leading-none">&times;</span>
                                </button>
                            </div>
                        </template>

                        <label class="flex flex-col items-center justify-center aspect-square border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                            <input type="file" name="media[]" class="hidden" multiple accept="image/*,video/*" @change="fileChosen">
                            <span class="text-2xl text-gray-400">+</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Add New</span>
                        </label>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2 italic">* Adding new files will replace current ones upon saving.</p>
                </div>

                <div class="space-y-2">
                    <textarea 
                        name="description" 
                        placeholder="Write a caption..." 
                        rows="4" 
                        x-model="description"
                        class="textarea textarea-bordered w-full rounded-xl resize-none text-base focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    ></textarea>
                    
                    @error('description')
                        <p class="text-sm text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</x-app-layout>