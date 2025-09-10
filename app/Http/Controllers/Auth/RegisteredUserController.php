<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:' . User::class,
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/i',
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'email.regex' => 'Registrasi hanya diperbolehkan menggunakan akun Gmail.',
        ]);

        // buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        event(new Registered($user));

        // === GENERATE OTP ===
        $otp = rand(100000, 999999); // 6 digit
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // === KIRIM OTP via email ===
        \Mail::to($user->email)->send(new \App\Mail\OtpMail($otp));

        // simpan user id di session sementara
        $request->session()->put('otp_user_id', $user->id);

        // redirect ke halaman OTP form
        return redirect()->route('auth.otp.form')->with('status', 'OTP telah dikirim ke email Anda.');
    }

}
