<!-- resources/views/emails/member-left.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Left Study Group</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 40px 16px;">
        <tr>
            <td align="center">
                
                <!-- Card -->
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background:#ffffff; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,0.08); overflow:hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #6b7280, #9ca3af); padding: 28px 32px; color: white;">
                            <h1 style="margin:0; font-size:20px; font-weight:600; letter-spacing:0.3px;">
                                Member Update
                            </h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 36px 32px;">
                            <p style="margin:0 0 16px 0; font-size:16px; color:#111827;">
                                Hi <strong>{{ $studyGroup->leader->name }}</strong>,
                            </p>

                            <p style="margin:0 0 20px 0; font-size:15px; line-height:1.7; color:#374151;">
                                Just a quick update — <strong style="color:#111827;">{{ $member->name }}</strong> has <strong>left</strong>your study group 
                                <strong style="color:#111827;">"{{ $studyGroup->group_name }}"</strong>.
                            </p>

                            <p style="margin:0 0 28px 0; font-size:15px; line-height:1.7; color:#4b5563;">
                                We hope their time in the group was helpful. You can continue collaborating with your remaining members and keep the progress going 💪
                            </p>

                            <!-- Button -->
                            <table cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td>
                                        <a href="{{ route('study-groups.show', $studyGroup->slug) }}"
                                           style="display:inline-block; padding:14px 26px; font-size:14px; font-weight:600; color:#ffffff; background:#6366f1; border-radius:10px; text-decoration:none;">
                                            View Study Group →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 32px;">
                            <hr style="border:none; border-top:1px solid #e5e7eb; margin:0;">
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 32px 32px 32px; text-align:center;">
                            <p style="margin:0; font-size:13px; color:#9ca3af;">
                                You’re receiving this because you lead a study group on <strong>TheUniSpace</strong>.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- End Card -->

            </td>
        </tr>
    </table>

</body>
</html>
