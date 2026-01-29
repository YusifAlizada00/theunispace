<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Support Request</title>
</head>
<body>
    <h2>New Help & Support Request</h2>

    <p><strong>User:</strong> {{ $help->user->name }} ({{ $help->user->email }})</p>
    <p><strong>Type:</strong> {{ ucfirst($help->type) }}</p>
    @if($help->subject)
        <p><strong>Subject:</strong> {{ $help->subject }}</p>
    @endif
    @if($help->page)
        <p><strong>Page:</strong> {{ $help->page }}</p>
    @endif
    @if($help->solution_steps)
        <p><strong>Solution Steps:</strong> {{ $help->solution_steps }}</p>
    @endif
    @if($help->feature)
        <p><strong>Feature:</strong> {{ $help->feature }}</p>
    @endif
    @if($help->suggestions)
        <p><strong>Suggestions:</strong> {{ $help->suggestions }}</p>
    @endif

    <p><strong>Message:</strong></p>
    <p>{{ $help->message }}</p>
</body>
</html>
