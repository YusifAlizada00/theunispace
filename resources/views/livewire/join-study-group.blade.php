<div>
    <div class="mt-auto p-6 pt-0 flex items-center justify-between gap-4">
        {{-- Members Stack (Visual Polish) --}}
        <div class="flex items-center -space-x-2 overflow-hidden">
            @foreach ($studyGroup->members->take(3) as $user)
                <img src="{{ $user->profile_photo_url }}" class="inline-block h-8 w-8 rounded-full ring-2 ring-white">
            @endforeach
            @if($studyGroup->members->count() > 3)
                <div class="flex items-center justify-center h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 text-[10px] font-bold text-gray-500">
                    +{{ $studyGroup->members->count() - 3 }}
                </div>
            @endif
        </div>
        <button
            wire:click="{{ $isJoined ? 'leaveGroup' : 'joinGroup' }}"
            class="px-4 py-2 rounded-xl font-semibold
                {{ $isJoined ? 'bg-red-500 text-white' : 'bg-indigo-600 text-white' }}"
        >
            {{ $isJoined ? 'Leave Group' : 'Join Group' }}
        </button>
    </div>
</div>