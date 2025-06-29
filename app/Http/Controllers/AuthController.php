<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended(route('admin.dashboard'));
                case 'siswa':
                    return redirect()->intended(route('student.dashboard'));
                default:
                    return back()->withErrors([
                        'email' => 'Email atau password tidak valid (default).', // Pesan error lebih jelas
                    ])->onlyInput('email');
            }
        }

        // dd('Auth attempt failed!');

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.', // Pesan error yang akan ditampilkan
        ])->onlyInput('email');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:haikal_users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard'); // Ganti sesuai kebutuhan
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
