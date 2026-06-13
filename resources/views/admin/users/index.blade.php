@extends('layouts.app')
@section('title', 'Pengguna')

@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.menu.index') }}">☕ Menu</a>
  <a href="{{ route('admin.orders.index') }}">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}" class="active">👥 Pengguna</a>
@endsection

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Manajemen Pengguna</h2>

<div class="card">
  <div class="card-header"><h3>Daftar Pengguna ({{ $users->count() }})</h3></div>
  <table>
    <thead>
      <tr><th>Nama</th><th>Email</th><th>No. HP</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @foreach($users as $u)
      <tr>
        <td><strong>{{ $u->name }}</strong></td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->phone }}</td>
        <td>
          <span class="badge {{ $u->role === 'admin' ? 'badge-admin' : 'badge-customer' }}">
            {{ $u->role === 'admin' ? '🔑 Admin' : '👤 Customer' }}
          </span>
        </td>
        <td style="font-size:12px;color:var(--muted);">{{ $u->created_at->format('d M Y') }}</td>
        <td>
          @if($u->id !== Auth::id())
            <form method="POST" action="{{ route('admin.users.delete', $u) }}"
                  onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-delete">Hapus</button>
            </form>
          @else
            <span style="font-size:12px;color:var(--muted);">— (kamu)</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
