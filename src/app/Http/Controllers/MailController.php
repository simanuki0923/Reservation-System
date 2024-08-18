<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTestMail;

class MailController extends Controller
{
    public function index()
    {
        return view('mail.index');
    }

    public function send(SendMailRequest $request)
   {
    $data = $request->validated();

    Mail::to('admin@hoge.co.jp')->send(new SendTestMail($data));

    session()->flash('success', '送信しました！');
    return back();
   }
}
