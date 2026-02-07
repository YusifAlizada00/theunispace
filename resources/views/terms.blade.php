<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 mx-4">
            <div>
                <img src="{{ asset('webImages/theunispace-logo-tiny.png') }}" alt="TheUniSpace Logo" class="w-24 h-24" loading="lazy">
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 my-8 bg-white shadow-md overflow-hidden sm:rounded-lg prose max-w-none">
                
                <div class="mb-2">
                    <a href="{{ route('register') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-800 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back
                    </a>
                </div>

                <div class="mb-8 border-b pb-4">
                    <h1 class="text-3xl font-bold text-gray-900">Terms of Use</h1>
                    <p class="text-sm text-gray-500 mt-1">Last updated: February 2026</p>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">1. Acceptance of Terms</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    By accessing or using TheUniSpace, you agree to comply with these Terms of Use and all applicable laws and regulations. Use of certain features may be subject to additional rules posted on the platform.
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">2. User Conduct</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    You agree not to engage in any activity that could harm TheUniSpace, its users, or disrupt the services. Specifically, you must not:
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm mb-4 pl-2 space-y-1">
                    <li>Share content that is violent, abusive, sexual, discriminatory, or otherwise offensive.</li>
                    <li>Request money or compensation for items found in Lost & Found posts.</li>
                    <li>Attempt to hack, spam, or gain unauthorized access to accounts or the platform.</li>
                    <li>Harass, bully, or intimidate other users.</li>
                    <li>Use automated systems or bots to access the platform.</li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">3. Platform Features</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    TheUniSpace provides tools for sharing content, creating Study Groups, and posting Lost & Found items. Users agree to:
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm mb-4 pl-2 space-y-1">
                    <li>Use Study Groups and other tools for educational and constructive purposes.</li>
                    <li>Not exploit Lost & Found posts for personal gain or financial profit.</li>
                    <li>Follow all posted rules and guidelines for each feature.</li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">4. Intellectual Property</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    All logos, graphics, and service marks are the property of TheUniSpace or its licensors. You may not use any branding, logos, or content from the platform without prior written permission.
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">5. Termination</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    TheUniSpace may suspend or terminate your access immediately for any violation of these Terms of Use or any applicable laws, without prior notice.
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">6. Limitation of Liability</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    TheUniSpace is not responsible for any content posted by users, loss of data, or any damages resulting from use of the platform. Use the platform at your own risk.
                </p>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-xs text-center text-gray-400">
                        For questions about these Terms, please contact us at <a href="mailto:support@example.com" class="text-indigo-600 hover:text-indigo-500 underline">support@example.com</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
