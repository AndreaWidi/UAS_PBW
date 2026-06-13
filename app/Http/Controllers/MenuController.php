<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Halaman menu untuk customer
    public function index()
    {
        $hotMenus   = Menu::where('category', 'hot')->where('is_available', true)->get();
        $coldMenus  = Menu::where('category', 'cold')->where('is_available', true)->get();
        $otherMenus = Menu::where('category', 'other')->where('is_available', true)->get();

        return view('menu.index', compact('hotMenus', 'coldMenus', 'otherMenus'));
    }
}
