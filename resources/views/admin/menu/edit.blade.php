@extends('layouts.app')
@section('title', 'Edit Menu')

@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.menu.index') }}" class="active">☕ Menu</a>
  <a href="{{ route('admin.orders.index') }}">📋 Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Pengguna</a>
@endsection

@section('content')
<h2 style="font-family:'Playfair Display',serif;font-size:24px;margin-bottom:24px;">Edit Menu</h2>

<div class="card" style="max-width:600px;">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.menu.update', $menu) }}">
      @csrf @method('PUT')
      <div class="form-row">
        <div class="form-group">
          <label>Nama Produk</label>
          <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                 value="{{ old('name', $menu->name) }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Harga (Rp)</label>
          <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                 value="{{ old('price', $menu->price) }}">
          @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Kategori</label>
          <select name="category" class="form-control">
            <option value="hot"   {{ old('category',$menu->category)=='hot'  ?'selected':'' }}>☕ Kopi Panas</option>
            <option value="cold"  {{ old('category',$menu->category)=='cold' ?'selected':'' }}>🧊 Kopi Dingin</option>
            <option value="other" {{ old('category',$menu->category)=='other'?'selected':'' }}>🥤 Non-Kopi</option>
          </select>
        </div>
        <div class="form-group">
          <label>Emoji</label>
          <input type="text" name="emoji" class="form-control" maxlength="4" value="{{ old('emoji', $menu->emoji) }}">
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <input type="text" name="description" class="form-control" value="{{ old('description', $menu->description) }}">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:10px;">
        <input type="checkbox" name="is_available" id="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }} style="width:16px;height:16px;">
        <label for="is_available" style="text-transform:none;letter-spacing:0;font-size:14px;color:var(--espresso);cursor:pointer;">Menu tersedia</label>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.menu.index') }}" class="btn" style="background:transparent;border:1.5px solid rgba(0,0,0,.15);color:var(--muted);">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
