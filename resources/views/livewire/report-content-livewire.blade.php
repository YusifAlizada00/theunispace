<div>
    
    <button type="button" @click="showReportModal = true"
        class="gap-2 flex flex-row w-full text-left px-4 py-2 text-red-500 hover:bg-red-200">
        <img src="{{ asset('icons/report.png') }}" loading="lazy" alt="Report" class="w-6 h-6 -ml-3">
        <span class="-ml-1">Report</span>
    </button>

    <!-- Modal Backdrop -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-50 bg-opacity-10 backdrop-blur-[1px] md:mt-16 px-8 pb-16"
        x-show="showReportModal"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="showReportModal = false">

        <!-- Modal Box -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md p-6 overflow-y-auto max-h-[70vh] md:max-h-[90vh] border border-gray-300 dark:border-gray-600"
            x-show="showReportModal"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            @click.stop>

            <span class="text-gray-400 dark:text-gray-400">Please note that you must at least check 1 checkbox,
                otherwise report will not be submitted</span>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 mt-4">Report</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-6">
                Select a reason for reporting this post:
            </p>

            <!-- Form -->
            <form wire:submit.prevent="submit" @submit.prevent="showReportModal = false"  class="space-y-3">
                @foreach (['spam' => 'Spam or misleading', 'hate_speech' => 'Hate speech or graphic violence', 'harassment' => 'Harassment or bullying', 'sexual' => 'Sexual Content', 'property_violation' => 'Intellectual property violation', 'other' => 'Other'] as $key => $label)
                    <label class="flex items-center gap-3">
                        <input type="checkbox" value="{{ $key }}" wire:model="reasons"
                            class="form-checkbox h-5 w-5 text-red-500">
                        <span class="text-gray-900 dark:text-gray-900">{{ $label }}</span>
                    </label>
                @endforeach

                <label class="flex items-center gap-3 text-gray-900 dark:text-gray-900 text-xl pt-4">Describe
                    More</label>
                <textarea wire:model="additional_info"
                    class="rounded-lg border dark:bg-white border-gray-300 dark:border-gray-600 w-full p-3 mt-4 focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-700 dark:text-gray-200"
                    rows="4" placeholder="Additional details (optional)"></textarea>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="showReportModal = false"
                        class="px-4 py-2 dark:text-gray-900 dark:hover:bg-gray-200 rounded-lg border border-gray-300 hover:bg-gray-100 dark:border-gray-600 dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
