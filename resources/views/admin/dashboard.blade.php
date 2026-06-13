@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('nav')
  <a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a>
  <a href="{{ route('admin.menu.index') }}">☕ Menu</a>
  <a href="{{ route('admin.orders.index') }}">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Pengguna</a>
@endsection

@push('styles')
<style>
.stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-bottom:28px;}
.stat{background:white;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.06);}
.stat-label{font-size:11px;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-bottom:8px;}
.stat-val{font-size:28px;font-weight:700;}
.stat-sub{font-size:12px;color:var(--success);margin-top:4px;}
</style>
@endpush

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Dashboard</h2>

<div class="stats">
  <div class="stat">
    <div class="stat-label">Total Pesanan</div>
    <div class="stat-val">{{ $totalOrders }}</div>
    <div class="stat-sub">Semua waktu</div>
  </div>
  <div class="stat">
    <div class="stat-label">Pendapatan</div>
    <div class="stat-val" style="font-size:20px;">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
    <div class="stat-sub">Excludes cancelled</div>
  </div>
  <div class="stat">
    <div class="stat-label">Item Menu</div>
    <div class="stat-val">{{ $totalMenus }}</div>
    <div class="stat-sub">Tersedia</div>
  </div>
  <div class="stat">
    <div class="stat-label">Pengguna</div>
    <div class="stat-val">{{ $totalUsers }}</div>
    <div class="stat-sub">Terdaftar</div>
  </div>
</div>

<div class="card">
  <div class="card-header"><h3>Pesanan Terbaru</h3></div>
  <table>
    <thead>
      <tr><th>ID</th><th>Pelanggan</th><th>Item</th><th>Total</th><th>Status</th></tr>
    </thead>
    <tbody>
      @foreach($recentOrders as $o)
      <tr>
        <td><strong>#{{ str_pad($o->id,4,'0',STR_PAD_LEFT) }}</strong></td>
        <td>{{ $o->user->name }}</td>
        <td style="max-width:240px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:12px;">
          {{ $o->items->map(fn($i)=>$i->menu->name.' x'.$i->qty)->implode(', ') }}
        </td>
        <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td><span class="badge badge-{{ $o->status }}">{{ $o->status_label }}</span></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
