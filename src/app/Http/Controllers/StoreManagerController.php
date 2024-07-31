<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Reservation;

class StoreManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:store_manager');
    }
    
    public function index()
    {
        return view('manager.dashboard');
    }

    public function create()
    {
        return view('manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $store = new Store;
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone = $request->phone;
        $store->save();

        return redirect('manager.dashboard')->route('manager.dashboard')->with('success', '店舗情報が作成されました。');
    }

    public function edit(Store $store)
    {
    return view('store_manager.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    $store->update([
        'name' => $request->name,
        'address' => $request->address,
        'phone' => $request->phone,
    ]);

    return redirect()->route('manager.edit', $store)->with('success', '店舗情報が更新されました。');
    }

    public function reservations()
    {
        $reservations = Reservation::all();
        return view('manager.reservations', compact('reservations'));
    }
}
