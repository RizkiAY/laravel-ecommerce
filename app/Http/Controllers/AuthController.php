<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/pesanan');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/produk');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/produk');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'admin_code' => ['nullable', 'string'],
        ]);

        $email = strtolower(trim($validated['email']));
        $isAdminEmail = str_ends_with($email, '@kotoko.id');

        if ($isAdminEmail) {
            $secretCode = config('app.admin_registration_code');

            if (
                empty($secretCode) ||
                !isset($validated['admin_code']) ||
                !hash_equals($secretCode, $validated['admin_code'])
            ) {
                return back()
                    ->withErrors([
                        'admin_code' => 'Kode rahasia admin tidak valid.',
                    ])
                    ->withInput($request->only('name', 'email'));
            }
        }

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $email,
            'password' => $validated['password'],
            'is_admin' => $isAdminEmail,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect($isAdminEmail ? '/admin/dashboard' : '/produk')
            ->with('success', 'Pendaftaran berhasil.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
