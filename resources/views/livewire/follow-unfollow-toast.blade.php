<div wire:poll.2s="loadLatest" class="fixed bottom-5 right-5 z-50 space-y-2">
    @foreach($notifications as $key => $notification)
        @php
            $type = class_basename($notification->type) === 'UserFollowedNotification' ? 'follow' : 'unfollow';
        @endphp

        <div
            class="px-4 py-2 rounded shadow-lg text-white {{ $type === 'follow' ? 'bg-green-500' : 'bg-red-500' }}"
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2000)"
            style="display: none;"
        >
            {{ $notification->data['follower_name'] }}
            {{ $type === 'follow' ? 'started following you!' : 'unfollowed you.' }}
        </div>
    @endforeach
</div>
