<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- The share button -->
    <button wire:click="showOverlay" class="flex items-center gap-2 group/share transition-all" aria-label="Share post">
        <div class="p-2 rounded-full text-slate-400 group-hover/share:bg-indigo-50 group-hover/share:text-indigo-600 transition-colors">
            {{-- Modern Share Icon --}}
            <svg class="w-6 h-6 transition-transform group-hover/share:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/>
            </svg>
        </div>
    </button>

    <!-- Overlay -->
    @if ($isClicked)
        @teleport('body')
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                wire:click.self="hideOverlay">
                <div class="bg-gray-900 rounded-2xl p-6 w-full max-w-3xl text-gray-200 shadow-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold border-b border-gray-700 pb-2">Share this post</h1>

                        <button wire:click="hideOverlay" class="ml-auto md:-ml-8 gap-2 text-slate-500 hover:text-blue-500 transition-colors group/share" aria-label="Close share dialog">
                            <div class="p-2 rounded-full group-hover/share:bg-blue-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 64 64"
                                    style="fill:#FA5252;" aria-hidden="true">
                                    <path d="M51.092 15.737L48.263 12.908 32 29.172 15.737 12.908 12.908 15.737 29.172 32 12.908 48.263 15.737 51.092 32 34.828 48.263 51.092 51.092 48.263 34.828 32z"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $links['facebook'] ?? '#' }}" target="_blank"
                            class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="{{ $links['twitter'] ?? '#' }}" target="_blank"
                            class="flex items-center gap-2 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="{{ $links['linkedin'] ?? '#' }}" target="_blank"
                            class="flex items-center gap-2 bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                        <a href="{{ $links['whatsapp'] ?? '#' }}" target="_blank"
                            class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        @endteleport
    @endif
</div>