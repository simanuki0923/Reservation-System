<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Admin;
use App\Models\Reservation;
use App\Models\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
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
    $reservations = Reservation::with(['restaurant', 'user'])->get();

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

    public function qrScan()
    {
        return view('store.qr-scan');
    }

    public function checkReservation(Request $request)
    {
        $data = $request->input('qr_code_data'); // QRコードのデータを受け取る

        // デコードして予約IDを取得
        $decodedData = json_decode($data, true);
        $reservationId = $decodedData['reservation_id'];

        // 予約情報を取得
        $reservation = Reservation::with('user', 'restaurant')->find($reservationId);

        if ($reservation) {
            return response()->json([
                'status' => 'success',
                'reservation' => $reservation
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => '予約情報が見つかりませんでした。'
            ]);
        }
    }

   public function show($id)
    {
    $reservation = Reservation::with('user', 'restaurant')->findOrFail($id);

    return view('store.reservation-detail', compact('reservation'));
    }
}
