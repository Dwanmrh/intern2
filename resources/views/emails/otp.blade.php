<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kode OTP</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f4f4f4; padding:20px;">
    <div style="max-width:500px; margin:auto; background:white; padding:20px; border-radius:10px; text-align:center; box-shadow:0 2px 8px rgba(0,0,0,0.1);">

        <h2 style="color:#1E293B; margin-bottom:20px;">Kode OTP Login Anda</h2>

        <div style="font-size:32px; font-weight:bold; color:#2563eb; margin:20px 0;">
            {{ $otp }}
        </div>

        <p style="color:#555;">Kode ini berlaku selama <b>5 menit</b>. Jangan bagikan kode ini ke siapa pun.</p>

        <br>
        <p style="font-size:14px; color:#888;">&copy; {{ date('Y') }} SETUKPA Lemdiklat Polri</p>
    </div>
</body>
</html>
