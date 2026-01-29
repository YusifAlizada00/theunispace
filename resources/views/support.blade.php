<x-app-layout class="bg-gray-50">
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="flex items-center justify-center mx-4 md:my-12 md:mx-8">
            <div class="bg-white shadow-lg rounded-xl w-full max-w-2xl md:p-10 py-16">

                @if(session('success'))
                    <div id="alert-3"
                        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-green-50 dark:text-green-800"
                        role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Success</span>
                        <div class="ms-3 text-sm font-medium dark:text-green-400">
                            Your support request has been submitted successfully. We'll get back to you soon.
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-green-100 dark:text-green-500 dark:hover:bg-green-200"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif

                <h2 class="text-3xl font-bold mb-6 text-center dark:text-gray-900">Help & Support</h2>

                <form method="POST" action="{{ route('support.submit') }}" enctype="multipart/form-data"
                    class="space-y-4 mx-4">
                    @csrf

                    {{-- Name & Email row --}}
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <div class="flex-1 mb-4 md:mb-0">
                            <label for="name" class="block text-gray-700 font-semibold mb-2">Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:text-gray-900"
                                placeholder="Your name" required>
                            <x-input-error :for="'name'" />
                        </div>

                        <div class="flex-1">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:text-gray-900"
                                placeholder="Your email" required>
                            <x-input-error :for="'email'" />
                        </div>
                    </div>

                    {{-- Select type --}}
                    <div class="mb-4">
                        <label for="type" class="block text-gray-700 font-semibold mb-2 dark:text-gray-900">Select Type *</label>
                        <select id="type" name="type"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:text-gray-900"
                            onchange="showFields(this)" required>
                            <option value="" selected disabled>Choose one</option>
                            <option value="issue" {{ old('type') == 'issue' ? 'selected' : '' }}>Report Issue</option>
                            <option value="feedback" {{ old('type') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                            <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <x-input-error :for="'type'" />
                    </div>

                    {{-- Dynamic Fields --}}
                    <div id="dynamic-fields">
                        {{-- JS will fill these based on type --}}
                    </div>

                    {{-- Always show message --}}
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Message *</label>
                        <textarea name="message" id="message" rows="4"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 dark:text-gray-900"
                            placeholder="Describe your issue or feedback..." required>{{ old('message') }}</textarea>
                        <x-input-error :for="'message'" />
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        function showFields(select) {
            const container = document.getElementById('dynamic-fields');
            container.innerHTML = ''; // clear previous

            if (select.value === 'issue') {
                container.innerHTML = `
                    <div class="mb-4">
                        <label for="page" class="block text-gray-700 font-semibold mb-2">Affected Page/Feature</label>
                        <input type="text" name="page" class="w-full border dark:text-gray-900 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Which page or feature?">
                        <x-input-error :for="'page'" />
                    </div>
                    <div class="mb-4">
                        <label for="solution_steps" class="block text-gray-700 font-semibold mb-2">Steps to Reproduce</label>
                        <textarea name="solution_steps" rows="3" class="w-full border dark:text-gray-900 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Explain what you did..."></textarea>
                        <x-input-error :for="'solution_steps'" />
                    </div>
                `;
            } else if (select.value === 'feedback') {
                container.innerHTML = `
                    <div class="mb-4">
                        <label for="feature" class="block text-gray-700 font-semibold mb-2">Feature or Section</label>
                        <input type="text" name="feature" class="w-full border rounded-lg dark:text-gray-900 px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Which feature?">
                        <x-input-error :for="'feature'" />
                    </div>
                    <div class="mb-4">
                        <label for="suggestions" class="block text-gray-700 font-semibold mb-2">Your Suggestion</label>
                        <textarea name="suggestions" rows="3" class="w-full border rounded-lg dark:text-gray-900 px-4 py-2 focus:ring-2 focus:ring-blue-400" placeholder="Your suggestion..."></textarea>
                        <x-input-error :for="'suggestions'" />
                    </div>
                `;
            } else if (select.value === 'other') {
                container.innerHTML = `
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 font-semibold mb-2">Subject</label>
                        <input type="text" name="subject" class="w-full border rounded-lg px-4 py-2 dark:text-gray-900 focus:ring-2 focus:ring-blue-400" placeholder="Brief subject">
                        <x-input-error :for="'subject'" />
                    </div>
                `;
            }
        }

        // It ensures that when the page loads, if the "type" dropdown already has a value selected, 
        // the corresponding dynamic fields (like page, steps, feature) are shown automatically.
        window.addEventListener('DOMContentLoaded', () => {
            const typeSelect = document.getElementById('type');
            if (typeSelect.value) showFields(typeSelect);
        });
    </script>
</x-app-layout>