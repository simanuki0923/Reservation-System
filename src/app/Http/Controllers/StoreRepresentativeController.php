<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Store;
use App\Models\Admin;
use App\Models\Reservation;
use App\Models\Image; 
use App\Mail\SendEmail;

class StoreRepresentativeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:store_representative');
    }
    
    public function index()
    {
        $stores = Store::all();
        $managers = Admin::where('role', 'store_manager')->get();

        return view('store.dashboard', compact('stores', 'managers'));
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(Request $request)
   {
    $request->validate([
        'name' => 'required|string|max:255',
        'area' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'description' => 'required|string',
        'image_url' => 'nullable|url',
    ]);

    $store = new Store();
    $store->name = $request->input('name');
    $store->area = $request->input('area');
    $store->genre = $request->input('genre');
    $store->description = $request->input('description');
    $store->image_url = $request->input('image_url');
    $store->save();

    return redirect()->route('store.dashboard')->with('success', '店舗情報が作成されました。');
   }

    public function reservations()
    {
    $reservations = Reservation::with('restaurant')->get();

    return view('store.reservations', compact('reservations'));
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('store.edit', compact('store'));
    }

    public function update(Request $request, $id)
   {
    $request->validate([
        'name' => 'required|string|max:255',
        'area' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'description' => 'required|string',
        'image_url' => 'nullable|url',
    ]);

    $store = Store::findOrFail($id);
    $store->name = $request->input('name');
    $store->area = $request->input('area');
    $store->genre = $request->input('genre');
    $store->description = $request->input('description');
    $store->image_url = $request->input('image_url');
    $store->save();

    return redirect()->route('store.dashboard')->with('success', '店舗情報が更新されました。');
   }

   public function destroy($id)
{
    // ストアの取得
    $store = Store::find($id);

    // ストアが存在する場合のみ削除
    if ($store) {
        $store->delete();
        return redirect()->route('store.dashboard')->with('success', 'ストアが削除されました。');
    }

    return redirect()->route('store.dashboard')->with('error', 'ストアが見つかりませんでした。');
}

    public function uploadForm()
    {
        $images = Image::all(); // 画像一覧を取得
        return view('store.index', compact('images')); // ビューに画像一覧を渡す
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('public/images');
            $image = new Image();
            $image->path = basename($path);
            $image->save();
        }

        return redirect()->route('store.upload')->with('success', '画像がアップロードされました。');
    }

    public function showEmailForm()
   {
    return view('emails.send-email');
   }

    public function sendEmail(Request $request)
   {
    $request->validate([
        'to' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $emailData = [
        'to' => $request->input('to'),
        'subject' => $request->input('subject'),
        'message' => $request->input('message'),
    ];

    // Store email data in the database
    \App\Models\Mail::create($emailData);

    Mail::to($request->input('to'))->send(new SendEmail(
        $request->input('subject'),
        $request->input('message')
    ));

    return redirect()->route('emails.send.email.form')->with('success', 'メールが送信されました。');
   }

   public function sentEmails()
   {
    $mails = \App\Models\Mail::all();
    
    return view('emails.sent', compact('mails'));
   }
}
