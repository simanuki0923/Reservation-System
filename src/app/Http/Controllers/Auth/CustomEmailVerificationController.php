<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;

class CustomEmailVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $user = $request->user();

        // メールアドレスがすでに確認されている場合はリダイレクト
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('shop_all');
        }

        // 確認トークンが無効な場合はリダイレクト
        if (! $request->hasValidSignature()) {
            throw new ValidationException('This action is invalid.');
        }

        // メールアドレスを確認
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('shop_all');
    }
}
