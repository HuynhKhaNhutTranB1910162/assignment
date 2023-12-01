<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        if (Auth::check()) {
            $favorites = Favorite::where('user_id', Auth::user()->id)->get();
            return view('client.favorite.index', compact('categories', 'favorites'));
        }
        return view('client.favorite.index', compact('categories'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $favorite = Favorite::getFavoriteByUserId($id);

        $favorite->delete();

        toastr()->success('Xóa thành công sản phẩm');

        return redirect('favorite');
    }
}
