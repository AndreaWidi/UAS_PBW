<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|min:2|max:100',
            'description' => 'nullable|max:255',
            'price'       => 'required|integer|min:1000',
            'category'    => 'required|in:hot,cold,other',
            'emoji'       => 'nullable|max:4',
        ], [
            'name.required'  => 'Nama menu wajib diisi.',
            'name.min'       => 'Nama minimal 2 karakter.',
            'price.required' => 'Harga wajib diisi.',
            'price.min'      => 'Harga minimal Rp 1.000.',
            'category.in'    => 'Kategori tidak valid.',
        ]);

        Menu::create([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'category'     => $request->category,
            'emoji'        => $request->emoji ?? '☕',
            'is_available' => true,
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name'        => 'required|min:2|max:100',
            'description' => 'nullable|max:255',
            'price'       => 'required|integer|min:1000',
            'category'    => 'required|in:hot,cold,other',
            'emoji'       => 'nullable|max:4',
        ]);

        $menu->update([
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'category'     => $request->category,
            'emoji'        => $request->emoji ?? $menu->emoji,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
