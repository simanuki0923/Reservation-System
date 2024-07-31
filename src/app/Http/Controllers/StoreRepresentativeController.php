<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Admin;
use App\Models\Reservation; 
use Illuminate\Support\Facades\Hash;

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
            'address' => 'required|string|max:255',
        ]);

        $store = new Store();
        $store->name = $request->input('name');
        $store->address = $request->input('address');
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
            'address' => 'required|string|max:255',
        ]);

        $store = Store::findOrFail($id);
        $store->name = $request->input('name');
        $store->address = $request->input('address');
        $store->save();

        return redirect()->route('store.dashboard')->with('success', '店舗情報が更新されました。');
    }
}
