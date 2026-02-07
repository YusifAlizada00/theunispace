<x-app-layout>
    <div class="max-w-2xl mx-auto mt-6 px-4" x-data="searchForm()">
        <form action="{{ route('search.results') }}" method="GET" class="relative z-20">

            {{-- Hidden Input to send the selected 'scope' to Laravel --}}
            <input type="hidden" name="type" x-bind:value="scope">

            {{-- Visual Input Bar --}}
            <div
                class="relative flex items-center bg-gray-100 border border-gray-300 rounded-full px-4 py-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-transparent transition-all">

                {{-- Scope/Category Selector --}}
                <div class="relative">
                    <button type="button" @click="showScope = !showScope" @click.outside="showScope = false"
                        class="flex items-center text-xs font-bold text-gray-600 uppercase tracking-wide mr-3 whitespace-nowrap border-r border-gray-300 pr-3 hover:text-gray-900">
                        <span x-text="scopeLabel"></span>
                        <svg class="w-3 h-3 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    {{-- Scope Dropdown Menu --}}
                    <div x-show="showScope" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute top-full left-0 mt-2 w-40 bg-white border border-gray-100 rounded-lg shadow-xl py-1 z-50 overflow-hidden"
                        style="display: none;">

                        <template x-for="option in scopes" :key="option.value">
                            <button type="button" @click="selectScope(option)"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                <span x-text="option.label"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <input type="text" name="search" value="{{ request('search') }}" x-model="query"
                    class="flex-1 bg-transparent border-none p-0 text-sm text-gray-700 placeholder-gray-400 focus:ring-0 focus:outline-none"
                    placeholder="Search..." autocomplete="off">

                {{-- Submit Button (Icon) --}}
                <button type="submit"
                    class="ml-2 p-1 rounded-full text-gray-400 hover:text-indigo-600 hover:bg-gray-200 transition-colors focus:outline-none">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </button>
            </div>
        </form>

        <div class="w-full border-b border-gray-200 mt-6 mb-4"></div>

        {{-- Search Results --}}
        @if (!empty($query) || request()->has('search'))
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-4">

                {{-- 1. USERS RESULTS --}}
                @if($users->isNotEmpty())
                    <p class="px-5 pt-4 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">People</p>
                    <div class="divide-y divide-gray-50">
                        @foreach ($users as $user)
                            <a href="{{ route('posts.all', ['name' => $user->slug]) }}"
                                class="flex items-center gap-4 px-5 py-3 hover:bg-indigo-50 transition-colors group">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" loading="lazy"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1">
                                        <span class="font-semibold text-gray-800 text-sm">{{ $user->name }}</span>
                                        @if($user->is_admin)
                                            <img src="{{ asset('icons/check.png') }}" class="h-3 w-3" alt="Check Icon" loading="lazy">
                                        @endif
                                    </div>
                                    <span class="text-xs text-gray-400">{{ '@' . $user->slug }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    {{-- 2. STUDY GROUPS RESULTS --}}
                @elseif($studyGroups->isNotEmpty())
                    <p class="px-5 pt-4 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Study Groups</p>
                    <div class="divide-y divide-gray-50">
                        @foreach ($studyGroups as $group)
                            <a href="{{ route('study-groups.show', $group->slug) }}" class="block px-5 py-3 hover:bg-indigo-50 transition-colors">
                                <span class="font-semibold text-gray-800 text-sm">{{ $group->group_name }}</span><br>
                                <span class="text-gray-400 text-sm">{{ $group->subject }}</span>
                            </a>
                        @endforeach
                    </div>

                    {{-- 3. LOST & FOUND ITEMS RESULTS --}}
                @elseif($lostItems->isNotEmpty())
                    <p class="px-5 pt-4 pb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Lost & Found</p>
                    <div class="divide-y divide-gray-50">
                        @foreach ($lostItems as $item)
                            <a href="{{ route('lost-report.show', $item->slug) }}" class="block px-5 py-3 hover:bg-indigo-50 transition-colors">
                                <span class="font-semibold text-gray-800 text-sm">{{ $item->item_name }}</span>
                            </a>
                        @endforeach
                    </div>

                @else
                    {{-- 4. NO RESULTS --}}
                    <div class="px-5 py-8 text-center">
                        <p class="text-sm text-gray-500">
                            No results found for "<span class="font-semibold text-gray-700">{{ request('search') }}</span>"
                            in {{ rtrim(request('type', 'People'), 's') }}.
                        </p>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <script>
        function searchForm() {
            return {
                query: '{{ request('search') }}', // Pre-fill from PHP if available
                showScope: false,

                // Initialize based on previous search or default
                scope: '{{ request('type', 'students') }}',

                // Helper to get the label for the current scope
                get scopeLabel() {
                    const active = this.scopes.find(s => s.value === this.scope);
                    return active ? active.label : 'People';
                },

                scopes: [
                    { value: 'students', label: 'Students' },
                    { value: 'groups', label: 'Study Groups' },
                    { value: 'items', label: 'Lost & Found' },
                ],

                selectScope(option) {
                    this.scope = option.value;
                    this.showScope = false;
                }
            }
        }
    </script>
</x-app-layout>