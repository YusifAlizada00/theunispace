<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">




        <!-- Delete User Confirmation Modal -->
        <div class="max-w-xl text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </div>
        <div class="mt-5" x-data="{ open: false }">
            <button @click="open = true"
                class="bg-red-500 text-white px-4 py-2 rounded font-semibold text-xs uppercase tracking-widest hover:bg-red-600 transition">
                Delete My Account
            </button>

            <div x-show="open" style="display: none;" x-transition
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Confirm Deletion</h2>
                    <p class="text-gray-600 mb-6">
                        Are you sure you want to delete your account? This action cannot be undone.
                    </p>
                    <div class="flex justify-end space-x-3">
                        <button @click="open = false" type="button"
                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-800">
                            Cancel
                        </button>

                        <form method="POST" action="{{ route('account.delete') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Yes, Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>
</x-action-section>