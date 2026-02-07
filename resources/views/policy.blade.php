<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 mx-4">
            <div>
                <img src="{{ asset(path: 'webImages/theunispace-logo-tiny.png') }}" alt="TheUniSpace Logo" loading="eager" class="w-24 h-24">
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
                    <h1 class="text-3xl font-bold text-gray-900">Privacy Policy</h1>
                    <p class="text-sm text-gray-500 mt-1">Last updated: February 2026</p>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">1. Information We Collect</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    We collect information you provide directly when you create an account or interact with our platform. This includes:
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm mb-4 pl-2 space-y-1">
                    <li>Full Name</li>
                    <li>Email address</li>
                    <li>Major (if provided)</li>
                    <li>Password (hashed and stored securely)</li>
                    <li>Posts and content you share on the platform</li>
                    <li>Interactions with Study Groups, Lost & Found listings, and other platform tools</li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">2. How We Use Your Information</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    We use the information we collect to provide, maintain, and improve our services, including:
                </p>
                <ul class="list-disc list-inside text-gray-600 text-sm mb-4 pl-2 space-y-1">
                    <li>Create and manage your account</li>
                    <li>Send you technical notices, updates, and security alerts</li>
                    <li>Respond to your comments and customer service requests</li>
                    <li>Monitor and analyze trends and usage to improve our platform</li>
                    <li>Ensure compliance with platform rules and maintain a safe community</li>
                </ul>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">3. Cookies</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    We use cookies and similar tracking technologies to track activity on our service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, some portions of our service may not function properly if you disable cookies.
                </p>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-2">4. Data Security</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    The security of your data is important to us, but no method of transmission over the Internet or electronic storage is 100% secure. While we strive to protect your personal data using commercially acceptable means, we cannot guarantee absolute security.
                </p>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-xs text-center text-gray-400">
                        If you have any questions about this Privacy Policy, please contact us at 
                        <a href="mailto:support@example.com" class="text-indigo-600 hover:text-indigo-500 underline">support@example.com</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
