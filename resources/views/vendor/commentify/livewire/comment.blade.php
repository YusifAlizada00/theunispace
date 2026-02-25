<div class="pb-8 dark:bg-white">
    @if($isEditing)
        @include('commentify::livewire.partials.comment-form',[
            'method'=>'editComment',
            'state'=>'editState',
            'inputId'=> 'reply-comment',
            'inputLabel'=> __('commentify::commentify.comments.your_reply'),
            'button'=> __('commentify::commentify.comments.edit_comment')
        ])
    @else
        <article class="p-6 mb-1 text-base bg-white rounded-lg dark:bg-white">
            <footer class="flex justify-between items-center mb-1">
                <div class="flex items-center space-x-2 text-sm text-gray-900 dark:text-gray-800">
                    <p class="inline-flex items-center gap-2">
                        @if($comment->user)
                            @if($comment->user->profile_photo_path)
                                <img class="w-6 h-6 rounded-full"
                                    src="{{ asset('storage/'.$comment->user->profile_photo_path) }}">
                            @else
                                <div class="w-6 h-6 rounded-full bg-[#EBF4FF] flex items-center justify-center text-[10px] font-bold text-[#7F9CF5]">
                                    {{ collect(explode(' ', $comment->user->name))
                                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                        ->take(2)
                                        ->implode('') }}
                                </div>
                            @endif
                        @endif

                        <span>
                            {{ Str::ucfirst($comment->user->name ?? 'User') }}
                        </span>
                    </p>

                    <span class="flex items-center text-gray-500">&middot;</span>

                    <p class="text-gray-600 dark:text-gray-400 whitespace-nowrap">
                        <time pubdate datetime="{{ $comment->created_at->diffForHumans(['short' => true]) }}" title="{{ $comment->presenter()->relativeCreatedAt() }}">
                            {{ $comment->created_at->diffForHumans(['short' => true]) }}
                        </time>
                    </p>
                </div>

                <div class="relative ml-2">
                    <button wire:click="$toggle('showOptions')" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-white dark:hover:bg-gray-100 dark:focus:ring-white" type="button" aria-label="Comment options menu">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                    </button>
                    @if($showOptions)
                        <div class="absolute z-10 top-full right-0 mt-1 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-white dark:divide-white dark:text-gray-700">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-800">
                                @can('update',$comment)
                                    <li>
                                        <button wire:click="$toggle('isEditing')" type="button" class="block w-full text-left py-2 px-4 text-gray-800 dark:text-gray-800 hover:bg-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900">
                                            {{ __('commentify::commentify.comments.edit') }}
                                        </button>
                                    </li>
                                @endcan
                                @can('destroy',$comment)
                                    <li>
                                        <button x-on:click="confirmCommentDeletion" x-data="{ confirmCommentDeletion(){ if(window.confirm('{{ __('commentify::commentify.comments.delete_confirm') }}')){ @this.call('deleteComment') } } }" class="block w-full text-left py-2 px-4 text-red-500 dark:text-red-500 hover:bg-gray-100 dark:hover:bg-red-200 dark:hover:text-red-500">
                                            {{ __('commentify::commentify.comments.delete') }}
                                        </button>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    @endif
                </div>
            </footer>
            <p class="text-gray-500 dark:text-gray-400">
                {!! $comment->presenter()->replaceUserMentions($comment->presenter()->markdownBody()) !!}
            </p>
            <div class="flex items-center mt-4 space-x-4">
                <livewire:like :$comment :key="$comment->id"/>
                @include('commentify::livewire.partials.comment-reply')
            </div>
        </article>
    @endif
    @if($isReplying)
        @include('commentify::livewire.partials.comment-form',[
           'method'=>'postReply',
           'state'=>'replyState',
           'inputId'=> 'reply-comment',
           'inputLabel'=> __('commentify::commentify.comments.your_reply'),
           'button'=> __('commentify::commentify.comments.post_reply')
       ])
    @endif
    @if($hasReplies)
        <article class="p-1 mb-1 ml-1 lg:ml-12 border-t border-gray-200 dark:border-gray-200">
            @foreach($comment->children as $child)
                <livewire:comment :comment="$child" :key="$child->id"/>
            @endforeach
        </article>
    @endif
</div>


