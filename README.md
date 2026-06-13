# ☕ BrewHouse — Panduan Setup

## Prasyarat
- PHP >= 8.1
- Composer
- MySQL / MariaDB (atau Laragon)
- Node.js (opsional, untuk asset)

---

## 🚀 Cara Menjalankan di Lokal

### 1. Buat Project Laravel Baru
```bash
composer create-project laravel/laravel brewhouse
cd brewhouse
```

### 2. Copy Semua File Ini ke Folder Project
Salin file-file dari folder ini ke project Laravel kamu sesuai strukturnya.

### 3. Daftarkan Middleware di bootstrap/app.php
Tambahkan baris berikut di dalam `withMiddleware()`:
```php
$middleware->alias([
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
]);
```

### 4. Konfigurasi .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brewhouse
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database
Buat database bernama `brewhouse` di phpMyAdmin atau MySQL.

### 6. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 7. Jalankan Server
```bash
php artisan serve
```

Buka browser ke: **http://localhost:8000**

---

## 🔑 Akun Demo
| Role     | Email            | Password  |
|----------|------------------|-----------|
| Admin    | admin@brew.com   | admin123  |
| Customer | user@brew.com    | user123   |

---

## 📁 Struktur File yang Perlu Disalin

```
app/
  Http/
    Controllers/
      AuthController.php
      MenuController.php
      OrderController.php
      AdminController.php
      AdminMenuController.php
      AdminOrderController.php
    Middleware/
      IsAdmin.php
  Models/
    User.php
    Menu.php
    Order.php
    OrderItem.php

database/
  migrations/
    ..._create_users_table.php
    ..._create_menus_table.php
    ..._create_orders_table.php
    ..._create_order_items_table.php
  seeders/
    DatabaseSeeder.php

resources/views/
  layouts/app.blade.php
  auth/login.blade.php
  auth/register.blade.php
  menu/index.blade.php
  orders/index.blade.php
  admin/dashboard.blade.php
  admin/menu/index.blade.php
  admin/menu/edit.blade.php
  admin/orders/index.blade.php
  admin/users/index.blade.php

routes/
  web.php
```

---

## 🗄️ Relasi Database

```
users ──┐
        ├──< orders ──< order_items >── menus
```

- `users` hasMany `orders`
- `orders` hasMany `order_items`
- `order_items` belongsTo `menu`
