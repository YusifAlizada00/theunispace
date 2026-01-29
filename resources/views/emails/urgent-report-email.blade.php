<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: 'Helvetica Neue', Arial, sans-serif; background: #f9fafb; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0"
        style="max-width: 600px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-top: 40px;">
        <tr>
            <td style="padding: 40px 30px;">
                <h2 style="color: #111827; font-size: 24px; margin-bottom: 16px;">
                    Immediate Action Required: Content has been Reported 2 or more times
                </h2>
                <p style="color: #374151; font-size: 16px; line-height: 1.6;">
                    Hey there! <strong>{{ $reporter->name }}</strong> just reported on <strong>post-title:</strong>
                    {{ $post->title }}:
                </p>
                <blockquote
                    style="border-left: 4px solid #6366f1; padding-left: 16px; color: #4b5563; font-style: italic; margin: 20px 0;">
                    @if(!empty($reasons) && is_array($reasons))
                        {{ implode(', ', $reasons) }}
                    @else
                        No reasons provided.
                    @endif
                </blockquote>

                @if($additionalInfo)
                    <p><strong>Additional Info:</strong> {{ $additionalInfo }}</p>
                @endif
                <a href="{{ $url}}" style="display: inline-block; background-color: red; color: white; text-decoration: none; 
                          font-weight: 600; padding: 12px 24px; border-radius: 8px; margin-top: 20px;">
                    View Reported Post →
                </a>
                <p style="color: #9ca3af; font-size: 13px; margin-top: 40px;">
                    — TheGoalify Team
                </p>
            </td>
        </tr>
    </table>
</body>

</html>