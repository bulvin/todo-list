<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin() : View
    {
        return view('auth.sign-in');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('todos.index');
        }

        return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated->password = Hash::make($validated->password);

        $user = User::create($validated);
        auth()->login($user);

        return redirect()->route('todos.index');
    }

    public function showRegister() : View
    {
        return view('auth.sign-up');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
