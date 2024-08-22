<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }

    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();

            if ($admin->role == 'administrator') {
              return redirect()->intended('/admin');
          } elseif ($admin->role == 'store_representative') {
              return redirect()->intended('/store/dashboard');
          } else {
              Auth::guard('admin')->logout();
              return back()->withErrors([
                'name' => 'You do not have the necessary permissions.',
              ]);
          }
       }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
