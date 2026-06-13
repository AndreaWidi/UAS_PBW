@extends('layouts.app')
@section('title', 'Kelola Menu')

@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.menu.index') }}" class="active">☕ Menu</a>
  <a href="{{ route('admin.orders.index') }}">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Pengguna</a>
@endsection

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Kelola Menu</h2>

<!-- Form Tambah -->
<div class="card" style="margin-bottom:20px;">
  <div class="card-header"><h3>Tambah Item Menu</h3></div>
  <div class="card-body">
    <form method="POST" action="{{ route('admin.menu.store') }}">
      @csrf
      <div class="form-row">
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                 placeholder="Nama kopi" value="{{ old('name') }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Harga (Rp)</label>
          <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                 placeholder="25000" value="{{ old('price') }}">
          @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Kategori</label>
          <select name="category" class="form-control">
            <option value="hot" {{ old('category')=='hot'?'selected':'' }}>☕ Kopi Panas</option>
            <option value="cold" {{ old('category')=='cold'?'selected':'' }}>🧊 Kopi Dingin</option>
            <option value="other" {{ old('category')=='other'?'selected':'' }}>🥤 Non-Kopi</option>
          </select>
        </div>
        <div class="form-group">
          <label>Emoji</label>
          <input type="text" name="emoji" class="form-control" placeholder="☕" maxlength="4" value="{{ old('emoji','☕') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="description" class="form-control" placeholder="Deskripsi singkat produk" value="{{ old('description') }}">
      </div>
      <button type="submit" class="btn btn-primary">Tambah Menu</button>
    </form>
  </div>
</div>

<!-- Tabel -->
<div class="card">
  <div class="card-header"><h3>Daftar Menu ({{ $menus->count() }} item)</h3></div>
  <table>
    <thead>
      <tr><th>Emoji</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      @foreach($menus as $m)
      <tr>
        <td style="font-size:24px">{{ $m->emoji }}</td>
        <td>
          <strong>{{ $m->name }}</strong><br>
          <span style="font-size:11px;color:var(--muted);">{{ $m->description }}</span>
        </td>
        <td>{{ $m->category_label }}</td>
        <td>Rp {{ number_format($m->price,0,',','.') }}</td>
        <td>
          <span class="badge" style="{{ $m->is_available ? 'background:#D4EDDA;color:#155724' : 'background:#F8D7DA;color:#721C24' }}">
            {{ $m->is_available ? 'Tersedia' : 'Habis' }}
          </span>
        </td>
        <td style="display:flex;gap:6px;align-items:center;">
          <a href="{{ route('admin.menu.edit', $m) }}" class="btn btn-sm btn-outline-edit">Edit</a>
          <form method="POST" action="{{ route('admin.menu.destroy', $m) }}" onsubmit="return confirm('Hapus menu ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-delete">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
