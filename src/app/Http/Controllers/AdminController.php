<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:admins,name',
            'password' => 'required|string|min:5',
            'role' => 'required|string|max:255',
        ], [
            'name.required' => '名前は必須です。',
            'name.unique' => 'この名前は既に存在します。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは最低5文字である必要があります。',
            'role.required' => '役割は必須です。',
        ]);

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

    public function storeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ], [
            'name.required' => '店舗名は必須です。',
            'address.required' => '住所は必須です。',
            'phone_number.required' => '電話番号は必須です。',
        ]);

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

    public function updateStore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ], [
            'name.required' => '店舗名は必須です。',
            'address.required' => '住所は必須です。',
            'phone_number.required' => '電話番号は必須です。',
        ]);

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

    public function updateManager(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:admins,name,' . $id,
            'password' => 'nullable|string|min:5',
            'role' => 'required|string|max:255',
        ], [
            'name.required' => '名前は必須です。',
            'name.unique' => 'この名前は既に存在します。',
            'password.min' => 'パスワードは最低5文字である必要があります。',
            'role.required' => '役割は必須です。',
        ]);

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
