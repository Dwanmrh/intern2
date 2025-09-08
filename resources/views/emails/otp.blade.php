<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kode OTP</title>
</head>
<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#e6ecf5;">
    <table role="presentation" style="width:100%; border-collapse:collapse; background-color:#e6ecf5; padding:25px 0;">
        <tr>
            <td align="center">
                <table role="presentation" style="max-width:520px; width:100%; background:#ffffff; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.12); overflow:hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background:linear-gradient(90deg, #1e40af, #2563eb); padding:18px; text-align:center;">
                            <h2 style="margin:0; font-size:22px; color:#ffffff; font-weight:600;">Kode OTP Login Anda</h2>
                        </td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style="padding:35px 30px; text-align:center; color:#333;">
                            <p style="font-size:15px; margin:0 0 22px;">Gunakan kode berikut untuk melanjutkan proses login Anda:</p>
                            
                            <div style="display:inline-block; background:#eff6ff; padding:15px 25px; border-radius:8px; font-size:34px; font-weight:bold; color:#1d4ed8; letter-spacing:6px; margin:20px 0;">
                                {{ $otp }}
                            </div>
                            
                            <p style="font-size:14px; color:#555; margin:25px 0 0; line-height:1.6;">
                                Kode ini berlaku selama 
                                <span style="color:#000; font-weight:900;">5 menit</span>.  
                                Demi keamanan akun Anda, jangan membagikan kode ini kepada siapa pun.
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding:0 25px;">
                            <hr style="border:none; border-top:1px solid #dbeafe; margin:0;">
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding:15px 25px; text-align:center; font-size:12px; color:#64748b; background:#f8fafc;">
                            &copy; {{ date('Y') }} SETUKPA Lemdiklat Polri
                        </td>
                    </tr>
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
