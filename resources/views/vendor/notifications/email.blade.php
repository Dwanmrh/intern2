<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0">
        
        <!-- Header -->
        <tr>
            <td align="center" style="padding: 25px 0; background-color: #2c3e50; color: #ffffff; font-size: 22px; font-weight: bold; letter-spacing: 1px;">
                Setukpa Lemdiklat Polri
            </td>
        </tr>

        <!-- Body -->
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" 
                       style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); margin: 25px 0; padding: 35px; text-align: left;">
                    
                    <!-- Title -->
                    <tr>
                        <td style="font-size: 20px; font-weight: bold; color: #2c3e50; border-bottom: 2px solid #eaeaea; padding-bottom: 12px;">
                            Permintaan Reset Kata Sandi
                        </td>
                    </tr>

                    <!-- Greeting & Message -->
                    <tr>
                        <td style="padding-top: 20px; font-size: 15px; color: #444444; line-height: 1.8;">
                            Halo <b>{{ $user->name ?? 'Pengguna' }}</b>,
                            <br><br>
                            Kami menerima permintaan untuk <b>mengatur ulang kata sandi</b> akun Anda di 
                            <b>Setukpa Lemdiklat Polri</b>. 
                            <br><br>
                            Demi keamanan akun Anda, mohon segera lakukan reset dengan menekan tombol di bawah:
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding: 30px 0;">
                            <a href="{{ $actionUrl }}" 
                               style="background-color: #1a73e8; color: #ffffff; text-decoration: none; 
                               padding: 14px 30px; border-radius: 6px; font-size: 16px; font-weight: bold; display: inline-block;">
                                🔐 Reset Kata Sandi
                            </a>
                        </td>
                    </tr>

                    <!-- Info -->
                    <tr>
                        <td style="font-size: 14px; color: #666666; line-height: 1.6;">
                            ⏳ Tautan ini hanya berlaku selama <b>60 menit</b>.  
                            Jika Anda tidak pernah meminta reset kata sandi, abaikan email ini dan akun Anda akan tetap aman.
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding-top: 25px; border-top: 1px solid #eeeeee; font-size: 13px; color: #999999; line-height: 1.6;">
                            Jika tombol di atas tidak berfungsi, silakan salin dan tempel tautan berikut ke peramban Anda:
                            <br>
                            <a href="{{ $actionUrl }}" style="color: #1a73e8;">{{ $actionUrl }}</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td align="center" style="padding: 18px; background-color: #2c3e50; font-size: 13px; color: #FFF000;">
                © {{ date('Y') }} Setukpa Lemdiklat Polri. Semua Hak Dilindungi.
            </td>
        </tr>
    </table>
</body>
</html>
