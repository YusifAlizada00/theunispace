<!-- resources/views/emails/new-comment.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: 'Helvetica Neue', Arial, sans-serif; background: #f9fafb; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-top: 40px;">
        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #111827; font-size: 24px; margin-bottom: 16px;">
                    New Post was just Shared
                </h2>
                <p style="color: #374151; font-size: 16px; line-height: 1.6;">
                    Hey there! <strong>{{ $followerName }}</strong> just shared a new post:
                </p>
                <a href="{{ $url }}" 
                   style="display: inline-block; background-color: #6366f1; color: white; text-decoration: none; 
                          font-weight: 600; padding: 12px 24px; border-radius: 8px; margin-top: 20px;">
                    View Post →
                </a>
                <p style="color: #9ca3af; font-size: 13px; margin-top: 40px;">
                    — TheUniSpace Team 
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
