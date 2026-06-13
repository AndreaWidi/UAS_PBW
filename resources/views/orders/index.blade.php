@extends('layouts.app')
@section('title', 'Pesanan Saya')

@section('nav')
  <a href="{{ route('menu.index') }}">☕ Menu</a>
  <a href="{{ route('orders.index') }}" class="active">📋 Pesanan Saya</a>
@endsection

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Pesanan Saya</h2>

@if($orders->isEmpty())
  <div style="text-align:center;padding:60px;color:var(--muted);">
    <div style="font-size:48px;margin-bottom:12px;">📋</div>
    <p>Belum ada pesanan. <a href="{{ route('menu.index') }}" style="color:var(--caramel);">Pesan sekarang →</a></p>
  </div>
@else
  <div style="display:flex;flex-direction:column;gap:12px;">
    @foreach($orders as $order)
    <div class="card" style="display:flex;align-items:center;gap:16px;padding:16px 20px;border-radius:12px;">
      <div style="flex:1;">
        <div style="font-size:12px;color:var(--muted);margin-bottom:3px;">#ORD-{{ str_pad($order->id,4,'0',STR_PAD_LEFT) }} · {{ $order->created_at->format('d M Y, H:i') }}</div>
        <div style="font-weight:600;font-size:14px;margin-bottom:3px;">
          {{ $order->items->map(fn($i) => $i->menu->name.' x'.$i->qty)->implode(', ') }}
        </div>
        @if($order->note)
          <div style="font-size:12px;color:var(--muted);">📝 {{ $order->note }}</div>
        @endif
      </div>
      <div style="font-weight:700;color:var(--caramel);font-size:15px;margin-right:8px;">
        Rp {{ number_format($order->total_price,0,',','.') }}
      </div>
      <span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span>
    </div>
    @endforeach
  </div>
@endif
@endsection
