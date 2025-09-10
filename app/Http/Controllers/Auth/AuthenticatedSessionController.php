<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use App\Models\User;
use App\Mail\OtpMail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
            'role' => ['required','in:siswa,personel,admin,super_admin'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Verifikasi ke Google
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if (!($result['success'] ?? false)) {
            return back()->withErrors(['g-recaptcha-response' => 'Captcha tidak valid, coba lagi.']);
        }

        $credentials = $request->only('email', 'password');
        $credentials['role'] = $request->role;

        if (Auth::validate($credentials)) {
            // Ambil user
            $user = User::where('email', $request->email)
                        ->where('role', $request->role)
                        ->first();

            if ($user) {
                // Generate OTP 6 digit
                $otp = rand(100000, 999999);
                $user->otp_code = $otp;
                $user->otp_expires_at = now()->addMinutes(5);
                $user->save();

                // Kirim OTP via email
                Mail::to($user->email)->send(new OtpMail($otp));

                // Simpan user id & remember me di session sementara
                $request->session()->put('otp_user_id', $user->id);
                $request->session()->put('remember_me', $request->filled('remember'));

                // 🔥 Tambahin ini supaya cooldown mulai dari 60 detik
                $request->session()->put('last_otp_sent', now()->timestamp);

                return redirect()->route('auth.otp.form')
                    ->with('status', 'Kode OTP telah dikirim ke email Anda.');
            }
        }

        return back()->withErrors([
            'email' => 'Email, kata sandi, atau role salah.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
