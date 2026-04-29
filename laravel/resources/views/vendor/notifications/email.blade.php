<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f8fafc; font-family: 'DM Sans', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="560" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1a1a2e; padding: 32px 40px; text-align: center;width: 100%;">
                            <h1 style="color: #ffffff; font-size: 24px; font-weight: 700; margin: 0;">
                                TaskApp
                            </h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #0f172a; font-size: 20px; font-weight: 700; margin: 0 0 8px;">
                                Hello{{ ! empty($greeting) ? ' ' . $greeting : '!' }}
                            </h2>

                            <p style="color: #475569; font-size: 16px; line-height: 1.7; margin: 0 0 24px;">
                                @if (! empty($introLines))
                                    @foreach ($introLines as $line)
                                        {{ $line }}<br>
                                    @endforeach
                                @else
                                    Please click the button below to verify your email address and activate your TaskApp account.
                                @endif
                            </p>

                            <!-- Action Button -->
                            @isset($actionText)
                                <table cellpadding="0" cellspacing="0" style="margin: 0 auto 32px;">
                                    <tr>
                                        <td align="center" style="background-color: #0d6efd; border-radius: 8px; padding: 14px 36px;">
                                            <a href="{{ $actionUrl }}" 
                                               target="_blank" 
                                               style="color: #ffffff; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-block;">
                                                {{ $actionText }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            @endisset

                            <!-- Outro -->
                            <p style="color: #475569; font-size: 16px; line-height: 1.7; margin: 0 0 8px;">
                                @if (! empty($outroLines))
                                    @foreach ($outroLines as $line)
                                        {{ $line }}<br>
                                    @endforeach
                                @else
                                    If you did not create an account, no further action is required.
                                @endif
                            </p>

                            <p style="color: #475569; font-size: 14px; margin: 24px 0 0;">
                                Regards,<br>
                                <strong style="color: #0f172a;">The TaskApp Team</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="border-top: 1px solid #e2e8f0; padding: 24px 40px;">
                            <p style="color: #94a3b8; font-size: 12px; line-height: 1.6; margin: 0;">
                                If you're having trouble clicking the "{{ $actionText ?? 'Verify Email Address' }}" button, copy and paste the URL below into your web browser:<br>
                                <a href="{{ $actionUrl ?? '' }}" style="color: #0d6efd; word-break: break-all; font-size: 11px;">
                                    {{ $actionUrl ?? '' }}
                                </a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f1f5f9; padding: 16px 40px; text-align: center;">
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                &copy; {{ date('Y') }} TaskApp. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>