<div>
    <div class="flex justify-center" wire:poll.4s="loadNotifications">
        <div class="w-full md:pl-[220px] flex justify-center">
            <div class="w-full max-w-4xl mt-12 mx-4 md:mx-8 overflow-y-auto pb-16 md:pb-12">
                <h1 class="font-bold text-3xl mb-4 dark:text-gray-900 text-left">Notifications</h1>
                @forelse ($notifications as $notification)
                    @php 
                        $type = class_basename($notification->type); 
                    @endphp
                    <div class="p-3 mb-2 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm bg-white dark:bg-white flex justify-between items-center" 
                    wire:key="notification-{{ $notification->id }}">
                        <div>
                            @if ($type === 'UserFollowedNotification')
                                <strong class="text-green-600 dark:text-green-600">{{ $notification->data['follower_name'] }}</strong>
                                <span class="dark:text-gray-600">started following you!</span>
                            @elseif ($type === 'UserUnfollowedNotification')
                                <strong class="text-red-600 dark:text-red-600">{{ $notification->data['follower_name'] }}</strong>
                                <span class="dark:text-gray-600">unfollowed you.</span>
                            @elseif ($type === 'UserCommentedNotification')
                                <strong class="text-green-600 dark:text-green-600">{{ $notification->data['commenter_name'] }}</strong>
                                <span class="dark:text-gray-600">
                                    has <strong class="dark:text-gray-900">commented on your</strong>
                                </span>
                                <a 
                                    href="{{ route('single-post', $notification->data['post_slug']) }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold transition-colors duration-200 underline-offset-2 hover:underline"
                                >
                                    post
                                </a>
                            @elseif ($type === 'FollowingPostedNotification')
                                <strong class="text-green-600 dark:text-green-600">{{ $notification->data['follower_name'] }}</strong>
                                <span class="dark:text-gray-600">
                                    has <strong class="dark:text-gray-900">shared a new </strong>
                                  <a href="{{ route('single-post', $notification->data['post_slug']) }}"
                                    class="text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300 font-semibold transition-colors duration-200 underline-offset-2 hover:underline"
                                    >
                                    post
                                  </a>
                                </span>
                            @endif
                        </div>

                        {{-- Nested component must have wire:key based on notification id --}}
                        <livewire:mark-as-read :notification-id="$notification->id" :key="$notification->id"/>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400 py-10">No Notifications Found</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
