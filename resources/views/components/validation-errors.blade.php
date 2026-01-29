@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'w-full mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded']) }}>
        <div class="font-medium">{{ __('Please check your credentials!') }}</div>
        <div class="font-medium">{{ __('If you do not have an account,') }}</div>
        <div class="font-medium">{{ __(' please sign up first!') }}</div>
    </div>
@endif

<!-- Merge doesnt let attributes override class -->
