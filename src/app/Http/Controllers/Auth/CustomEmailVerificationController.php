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

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('shop_all');
        }

        if (! $request->hasValidSignature()) {
            throw new ValidationException('This action is invalid.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('shop_all');
    }
}
