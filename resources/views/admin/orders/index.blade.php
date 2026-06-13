@extends('layouts.app')
@section('title', 'Pesanan')

@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.menu.index') }}">☕ Menu</a>
  <a href="{{ route('admin.orders.index') }}" class="active">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Pengguna</a>
@endsection

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Manajemen Pesanan</h2>

<div class="card">
  <div class="card-header"><h3>Semua Pesanan ({{ $orders->count() }})</h3></div>
  <table>
    <thead>
      <tr><th>ID</th><th>Pelanggan</th><th>Item</th><th>Catatan</th><th>Total</th><th>Status</th></tr>
    </thead>
    <tbody>
      @foreach($orders as $o)
      <tr>
        <td>
          <strong>#{{ str_pad($o->id,4,'0',STR_PAD_LEFT) }}</strong><br>
          <span style="font-size:11px;color:var(--muted);">{{ $o->created_at->format('d M, H:i') }}</span>
        </td>
        <td>{{ $o->user->name }}</td>
        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-size:12px;">
          {{ $o->items->map(fn($i)=>$i->menu->name.' x'.$i->qty)->implode(', ') }}
        </td>
        <td style="font-size:12px;color:var(--muted);max-width:120px;">{{ $o->note ?: '-' }}</td>
        <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td>
          <form method="POST" action="{{ route('admin.orders.status', $o) }}">
            @csrf @method('PATCH')
            <select name="status" onchange="this.form.submit()"
              style="padding:5px 8px;border-radius:6px;border:1.5px solid rgba(0,0,0,.1);font-family:'DM Sans',sans-serif;font-size:12px;cursor:pointer;">
              <option value="pending" {{ $o->status=='pending'?'selected':'' }}>⏳ Menunggu</option>
              <option value="process" {{ $o->status=='process'?'selected':'' }}>🔄 Diproses</option>
              <option value="done"    {{ $o->status=='done'   ?'selected':'' }}>✅ Selesai</option>
              <option value="cancel"  {{ $o->status=='cancel' ?'selected':'' }}>❌ Dibatal</option>
            </select>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
