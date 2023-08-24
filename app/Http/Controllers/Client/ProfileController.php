<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('client.profile.index', compact('categories'));
    }
}
