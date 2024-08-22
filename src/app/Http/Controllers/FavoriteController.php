<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Toggle a restaurant between favorite and not favorite.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Request $request, $id)
   {
    $user = $request->user();
    $restaurant = Restaurant::findOrFail($id);

    if ($user->favorites()->where('restaurant_id', $restaurant->id)->exists()) {
        $user->favorites()->detach($restaurant->id);
    } else {
        $user->favorites()->attach($restaurant->id);
    }

    return redirect()->back()->with('success', 'お気に入りが更新されました');
   }
}
