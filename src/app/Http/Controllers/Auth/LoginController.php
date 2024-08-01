<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class LoginController extends Controller
{
     public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ユーザーがメール認証済みであるか確認
            $user = Auth::user();
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('verification.notice')->with('error', 'Please verify your email address.');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
  public function shop_all()
    {
        $restaurants = Restaurant::all();
        return view('shop_all', compact('restaurants'));
    }

    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

       return redirect()->route('login');
    }
}
