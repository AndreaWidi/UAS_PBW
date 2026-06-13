**☕ BrewHouse Aplikasi Web Pemesanan Kopi**

Aplikasi web pemesanan kopi berbasis Laravel dengan fitur manajemen menu, pemesanan online, dashboard admin, dan autentikasi pengguna.

**📋 Deskripsi Aplikasi**

BrewHouse adalah aplikasi web sistem pemesanan kopi yang dibangun menggunakan framework Laravel. Aplikasi ini memungkinkan pelanggan untuk melihat menu kopi, memesan secara online, dan melacak status pesanan mereka. Admin dapat mengelola menu, memantau pesanan masuk, dan mengatur pengguna melalui dashboard khusus.

**Fitur Utama**

	•	🔐 Autentikasi — Login & Register dengan validasi input dan role-based access (Admin & Customer)
	•	☕ Katalog Menu — Menampilkan menu kopi panas, dingin, dan non-kopi dengan deskripsi dan harga
	•	🛒 Pemesanan — Customer dapat memesan kopi langsung dari menu dengan catatan tambahan
	•	📋 Riwayat Pesanan — Customer dapat melihat status pesanan (Menunggu, Diproses, Selesai, Dibatal)
	•	📊 Dashboard Admin — Statistik total pesanan, pendapatan, menu, dan pengguna
	•	⚙️ CRUD Menu — Admin dapat menambah, mengedit, dan menghapus item menu
	•	🔄 Kelola Pesanan — Admin dapat mengubah status pesanan secara real-time
	•	👥 Kelola Pengguna — Admin dapat melihat dan menghapus pengguna

**Teknologi yang Digunakan**

	•	Backend — Laravel 12 (PHP 8.2)
	•	Database — MySQL
	•	Frontend — Blade Template Engine, HTML, CSS, JavaScript
	•	Tools — Composer, XAMPP, phpMyAdmin

**🗄 Relasi Database**

users ──┐
        ├──< orders ──< order_items >── menus


	•	users hasMany orders
	•	orders hasMany order_items
	•	order_items belongsTo menu

**🚀 Cara Menjalankan di Lokal**
Prasyarat

	•	PHP >= 8.1
	•	Composer
	•	MySQL / MariaDB (atau XAMPP/Laragon)
	•	Node.js (opsional)

Langkah Instalasi

1. Buat Project Laravel Baru

composer create-project laravel/laravel brewhouse
cd brewhouse

2. Daftarkan Middleware di bootstrap/app.php

$middleware->alias([
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
]);


3. Konfigurasi .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brewhouse
DB_USERNAME=root
DB_PASSWORD=


4. Buat Database
Buat database bernama brewhouse di phpMyAdmin atau MySQL.

5. Import Database (Pilih salah satu)

Menggunakan file SQL:

mysql -u root brewhouse < brewhouse.sql


Atau menggunakan Migration & Seeder:

php artisan migrate
php artisan db:seed


6. Jalankan Server

php artisan serve


Buka browser ke http://localhost:8000

**🔑 Akun Demo**

|Role    |Email                                  |Password|
|--------|---------------------------------------|--------|
|Admin   |[admin@brew.com](mailto:admin@brew.com)|admin123|
|Customer|[user@brew.com](mailto:user@brew.com)  |user123 |

**📁 Struktur File**

app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php       ← Login, Register, Logout
│   │   ├── MenuController.php       ← Tampilan menu customer
│   │   ├── OrderController.php      ← Buat & lihat pesanan
│   │   ├── AdminController.php      ← Dashboard & kelola user
│   │   ├── AdminMenuController.php  ← CRUD menu (admin)
│   │   └── AdminOrderController.php ← Update status pesanan
│   └── Middleware/
│       └── IsAdmin.php              ← Proteksi route admin
└── Models/
    ├── User.php
    ├── Menu.php
    ├── Order.php
    └── OrderItem.php

database/
├── migrations/
│   ├── ..._create_users_table.php
│   ├── ..._create_menus_table.php
│   ├── ..._create_orders_table.php
│   └── ..._create_order_items_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/views/
├── layouts/app.blade.php
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── menu/index.blade.php
├── orders/index.blade.php
└── admin/
    ├── dashboard.blade.php
    ├── menu/
    │   ├── index.blade.php
    │   └── edit.blade.php
    ├── orders/index.blade.php
    └── users/index.blade.php

routes/
└── web.php


**👨‍💻 Dibuat Dengan**

Laravel Framework • MySQL • Blade Template • PHP 8.2
