<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin BrewHouse',
            'email'    => 'admin@brew.com',
            'phone'    => '081234567890',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Customer contoh
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'user@brew.com',
            'phone'    => '081234567891',
            'password' => Hash::make('user123'),
            'role'     => 'customer',
        ]);

        // Menu kopi panas
        $hotMenus = [
            ['name' => 'Espresso',   'description' => 'Kopi pekat bold dengan aroma kuat',         'price' => 20000, 'emoji' => '☕'],
            ['name' => 'Cappuccino', 'description' => 'Espresso dengan steamed milk dan foam tebal','price' => 28000, 'emoji' => '🫖'],
            ['name' => 'Americano',  'description' => 'Espresso diencerkan air panas, mild smooth', 'price' => 22000, 'emoji' => '🍵'],
            ['name' => 'Latte',      'description' => 'Espresso dengan banyak susu panas creamy',   'price' => 30000, 'emoji' => '☕'],
        ];
        foreach ($hotMenus as $m) {
            Menu::create(array_merge($m, ['category' => 'hot']));
        }

        // Menu kopi dingin
        $coldMenus = [
            ['name' => 'Cold Brew',    'description' => 'Kopi diseduh dingin 12 jam, smooth',  'price' => 32000, 'emoji' => '🧊'],
            ['name' => 'Iced Latte',   'description' => 'Latte disajikan dingin dengan es batu','price' => 30000, 'emoji' => '🥤'],
            ['name' => 'Frappuccino',  'description' => 'Blended iced coffee creamy dan manis', 'price' => 38000, 'emoji' => '🧋'],
        ];
        foreach ($coldMenus as $m) {
            Menu::create(array_merge($m, ['category' => 'cold']));
        }

        // Non-kopi
        $otherMenus = [
            ['name' => 'Matcha Latte', 'description' => 'Matcha premium Jepang dengan susu segar', 'price' => 32000, 'emoji' => '🍵'],
            ['name' => 'Coklat Panas', 'description' => 'Minuman coklat hangat yang kaya lembut',  'price' => 25000, 'emoji' => '🍫'],
        ];
        foreach ($otherMenus as $m) {
            Menu::create(array_merge($m, ['category' => 'other']));
        }
    }
}
