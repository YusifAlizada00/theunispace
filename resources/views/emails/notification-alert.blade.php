<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f4f8; padding: 20px; color: #333;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 30px;">

        <h2 style="color: #1d4ed8; margin-bottom: 20px;">Hello {{ $user->name }},</h2>

        <p style="font-size: 16px; margin-bottom: 25px;">
            You have <strong>{{ $count }} unread notification{{ $count > 1 ? 's' : '' }}</strong> in your account.
        </p>

        <p style="text-align: center; margin-bottom: 25px;">
            <a href="{{ url('/notifications') }}"
               style="background-color: #38bdf8; color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
               View Notifications
            </a>
        </p>

        <p style="font-size: 14px; color: #555;">
            Thank you,<br>
            <strong>TheGoalify Team</strong>
        </p>

    </div>

</body>
</html>
