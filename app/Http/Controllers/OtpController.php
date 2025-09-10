<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OtpController extends Controller
{
    public function showForm(Request $request)
    {
        $lastOtpSent = $request->session()->get('last_otp_sent');
        $cooldown = 0;

        if ($lastOtpSent) {
            $diff = now()->timestamp - $lastOtpSent;
            $cooldown = max(0, 60 - $diff);
        }

        return view('auth.otp', ['cooldown' => (int) $cooldown]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ]);

        $userId = $request->session()->get('otp_user_id');
        $remember = $request->session()->pull('remember_me', false);

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'Session tidak valid.']);
        }

        // ✅ cek otp terbaru + masih aktif
        if ($user->otp_code &&
            $user->otp_code === $request->otp &&
            $user->otp_expires_at && $user->otp_expires_at->isFuture()) {

            // Reset OTP setelah berhasil
            $user->update([
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            $request->session()->forget('otp_user_id');

            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard.index'));
        }

        return back()->withErrors(['otp' => 'OTP salah atau sudah kadaluarsa.']);
    }

    public function resend(Request $request)
    {
        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Session tidak valid. Silakan login ulang.'
            ]);
        }

        // cek cooldown
        if ($request->session()->has('last_otp_sent')) {
            $lastSent = $request->session()->get('last_otp_sent');
            $diff = now()->timestamp - $lastSent;

            if ($diff < 60) {
                return response()->json([
                    'success' => false,
                    'message' => 'Harap tunggu sebelum mengirim ulang OTP.'
                ]);
            }
        }

        // simpan waktu terakhir kirim otp (timestamp)
        $request->session()->put('last_otp_sent', now()->timestamp);

        // generate kode baru dan invalidate kode lama
        $otp = rand(100000, 999999);
        $user->update([
            'otp_code' => $otp,  // overwrite kode lama
            'otp_expires_at' => now()->addMinutes(5), // bisa pakai sama dengan login
        ]);

        // kirim email
        \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));

        return response()->json([
            'success' => true,
            'message' => 'Kode OTP baru telah dikirim ke email Anda.'
        ]);
    }
}
