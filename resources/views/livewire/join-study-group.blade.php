<div class="mt-auto p-6 pt-0 flex items-center justify-between gap-4">

    <div class="flex items-center -space-x-2 overflow-hidden">
        
        <img src="{{ $studyGroup->leader->profile_photo_url }}"  alt="Photo" loading="lazy"
             class="inline-block h-8 w-8 rounded-full ring-2 ring-white z-10" 
             title="Leader">

        @foreach ($studyGroup->members->where('id', '!=', $studyGroup->leader_id)->take(3) as $user)
            <img src="{{ $user->profile_photo_url }}" alt="Photo" loading="lazy"
                 class="inline-block h-8 w-8 rounded-full ring-2 ring-white" title="Member">
        @endforeach

        @php $remaining = $studyGroup->members->count() - 3; @endphp
        @if($remaining > 0)
            <div class="flex items-center justify-center h-8 w-8 rounded-full ring-2 ring-white bg-gray-100 text-[10px] font-bold text-gray-500">
                +{{ $remaining }}
            </div>
        @endif
    </div>

    @if(Auth::id() !== $studyGroup->leader_id)
        <button
            wire:click="{{ $isJoined ? 'leaveGroup' : 'joinGroup' }}"
            wire:loading.attr="disabled"
            class="px-4 py-2 rounded-xl font-semibold text-sm transition
                {{ $isJoined 
                    ? 'bg-red-50 text-red-600 hover:bg-red-100' 
                    : 'bg-indigo-600 text-white hover:bg-indigo-700' 
                }}"
        >
            <span wire:loading.remove>{{ $isJoined ? 'Leave' : 'Join' }}</span>
            <span wire:loading>Processing...</span>
        </button>
    @endif

</div>