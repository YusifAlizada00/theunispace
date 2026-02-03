<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Update on your Lost Report</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f0f4f8; padding: 20px; color: #333;">

    <div
        style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 30px;">

        <h2 style="color: #1d4ed8; margin-bottom: 20px;">Hello {{ $contact->reportLost->user->name }},</h2>
        <h3 style="color: black; margin-bottom: 20px;">This is from {{ $contact->user->name }}</h3>

        <span><strong>Email address of the founder: </strong>{{ $contact->user->email }}</span><br>
        <span><strong>They may have found your item:</strong> {{ $contact->item_name }}</span>
        <p style="font-size: 16px; margin-bottom: 25px;">
            <strong>Description: </strong>{{ $contact->detailed_description }}
        </p>
        @if ($contact->images_found && count($contact->images_found) > 0)
            {{-- Loop through the array --}}
            @foreach($contact->images_found as $image)

                {{-- FIX: Use $message->embed() with the absolute server path --}}
                <img src="{{ $message->embed(storage_path('app/public/' . $image)) }}" alt="Found Image"
                    style="max-width: 100%; height: auto; margin-bottom: 10px; border-radius: 4px;">

            @endforeach
        @else
            <p style="font-size: 16px; margin-bottom: 25px;">No images available.</p>
        @endif

        <span class="mt-4">
            We have provided the founder's email address so you can get in touch with them directly to arrange the next steps.
            If you have any questions or need further assistance, feel free to reach out to our support team.
        </span>

        <p style="text-align: center; margin-bottom: 25px;">
            <a href="{{ route('dashboard.all.posts') }}"
                style="background-color: #38bdf8; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                Go to the App
            </a>
        </p>

        <p style="font-size: 14px; color: #555;">
            Thank you,<br>
            <strong>TheUniSpace Team</strong>
        </p>

    </div>

</body>

</html>