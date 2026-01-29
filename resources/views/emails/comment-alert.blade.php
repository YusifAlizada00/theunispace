<!-- resources/views/emails/new-comment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Comment Notification</title>
</head>
<body style="font-family: 'Helvetica Neue', Arial, sans-serif; background: #f9fafb; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-top: 40px;">
        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #111827; font-size: 24px; margin-bottom: 16px;">
                    New Comment on Your Post
                </h2>
                <p style="color: #374151; font-size: 16px; line-height: 1.6;">
                    Hey there! <strong>{{ $commenter->name }}</strong> just commented on your post:
                </p>
                <blockquote style="border-left: 4px solid #6366f1; padding-left: 16px; color: #4b5563; font-style: italic; margin: 20px 0;">
                    "{{ Str::limit($comment, 5) }}"
                </blockquote>
                <a href="{{ $url}}" 
                   style="display: inline-block; background-color: #6366f1; color: white; text-decoration: none; 
                          font-weight: 600; padding: 12px 24px; border-radius: 8px; margin-top: 20px;">
                    View Comment →
                </a>
                <p style="color: #9ca3af; font-size: 13px; margin-top: 40px;">
                    — TheGoalify Team 
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
