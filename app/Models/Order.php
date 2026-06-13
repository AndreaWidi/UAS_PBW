<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'note', 'total_price', 'status'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper label status
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => '⏳ Menunggu',
            'process' => '🔄 Diproses',
            'done'    => '✅ Selesai',
            'cancel'  => '❌ Dibatal',
            default   => $this->status,
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match($this->status) {
            'pending' => 'badge-warning',
            'process' => 'badge-info',
            'done'    => 'badge-success',
            'cancel'  => 'badge-danger',
            default   => '',
        };
    }
}
