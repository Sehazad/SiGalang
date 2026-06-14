<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'no_hp' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['no_hp' => $credentials['no_hp'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin' || Auth::user()->role === 'karyawan') {
                return redirect()->intended('admin/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'no_hp' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('no_hp');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'no_hp'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['no_hp' => $credentials['no_hp'], 'password' => $credentials['password']])) {
            $role = Auth::user()->role;

            if (!in_array($role, ['admin', 'karyawan'])) {
                Auth::logout();
                return back()->withErrors([
                    'no_hp' => 'Akun ini bukan akun admin.',
                ])->onlyInput('no_hp');
            }

            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'no_hp' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('no_hp');
    }

    public function showAdminRegisterForm()
    {
        return view('auth.admin-register');
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        Auth::login($user);

        return redirect('/admin/dashboard');
    }
}
