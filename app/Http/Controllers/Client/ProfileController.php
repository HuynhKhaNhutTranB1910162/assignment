<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $addresses = Address::where('user_id', Auth::user()->id)->get();
        return view('client.profile.index', compact('categories', 'addresses'));
    }

    public function destroy(string $id): RedirectResponse
    {

        $address = Address::getAddressByUserId($id);

        $address->delete();

        toastr()->success('Xóa thành công địa chỉ');

        return redirect('user-profile');
    }

}
