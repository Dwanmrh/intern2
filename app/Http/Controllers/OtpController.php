<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OtpController extends Controller
{
    public function showForm()
    {
        return view('auth.otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required','digits:6'],
        ]);

        $userId = $request->session()->get('otp_user_id');
        $remember = $request->session()->pull('remember_me', false); // ambil dan hapus remember_me

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'Session tidak valid.']);
        }

        if ($user->otp_code === $request->otp && $user->otp_expires_at > now()) {
            // OTP benar → reset OTP
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            $request->session()->forget('otp_user_id');

            // Login user dengan opsi remember
            Auth::login($user, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard.index'));
        }

        return back()->withErrors(['otp' => 'OTP salah atau sudah kadaluarsa.']);
    }
}
