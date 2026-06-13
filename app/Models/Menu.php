<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category', 'emoji', 'is_available'];

    // Relasi: menu ada di banyak order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper label kategori
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'hot'   => '☕ Kopi Panas',
            'cold'  => '🧊 Kopi Dingin',
            'other' => '🥤 Non-Kopi',
            default => $this->category,
        };
    }
}
