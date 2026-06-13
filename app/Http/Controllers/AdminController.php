<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders  = Order::count();
        $totalRevenue = Order::where('status', '!=', 'cancel')->sum('total_price');
        $totalMenus   = Menu::count();
        $totalUsers   = User::count();
        $recentOrders = Order::with(['user', 'items.menu'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalMenus', 'totalUsers', 'recentOrders'
        ));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus.');
    }
}
