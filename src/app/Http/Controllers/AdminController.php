<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:administrator');
    }
    
    public function index()
    {
        $managers = Admin::where('role', 'store_manager')->get();
        return view('admin.index', compact('managers'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function createManager()
    {
        return view('admin.create-manager');
    }

    public function storeManager(AdminRequest $request)
    {
        Admin::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'ストアマネージャーが正常に作成されました。');
    }

    public function createStore()
    {
        return view('admin.create-store');
    }

    public function storeStore(StoreRequest $request)
    {
        Store::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.index')->with('success', '店舗情報が正常に作成されました。');
    }

    public function editStore($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.edit-store', compact('store'));
    }

    public function updateStore(StoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone_number = $request->phone_number;
        $store->save();

        return redirect()->route('admin.index')->with('success', '店舗情報が正常に更新されました。');
    }

    public function editManager($id)
    {
        $manager = Admin::findOrFail($id);
        return view('admin.edit-manager', compact('manager'));
    }

    public function updateManager(AdminRequest $request, $id)
    {
        $manager = Admin::findOrFail($id);
        $manager->name = $request->name;
        $manager->role = $request->role;
        if ($request->filled('password')) {
            $manager->password = Hash::make($request->password);
        }
        $manager->save();

        return redirect()->route('admin.index')->with('success', 'ストアマネージャーが正常に更新されました。');
    }

    public function deleteManager($id)
    {
        $manager = Admin::findOrFail($id);
        $manager->delete();

        return redirect()->route('admin.index')->with('success', 'ストアマネージャーが削除されました。');
    }

    public function listManagers()
    {
        $managers = Admin::where('role', 'store_manager')->get();
        return view('admin.managers', compact('managers'));
    }

}
