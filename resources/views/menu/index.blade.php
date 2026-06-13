@extends('layouts.app')
@section('title', 'Menu')

@section('nav')
  <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.index') ? 'active' : '' }}">☕ Menu</a>
  <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">📋 Pesanan Saya</a>
@endsection

@push('styles')
<style>
.hero{background:linear-gradient(135deg,#3D1F0E 0%,#6B3A1F 100%);border-radius:18px;
  padding:36px 40px;margin-bottom:32px;color:#F5EFE0;position:relative;overflow:hidden;}
.hero::after{content:'☕';position:absolute;right:30px;top:50%;transform:translateY(-50%);
  font-size:80px;opacity:.15;}
.hero h2{font-family:'Playfair Display',serif;font-size:26px;margin-bottom:6px;}
.hero p{color:#D4A96A;font-size:14px;}
.section-title{font-family:'Playfair Display',serif;font-size:20px;margin:28px 0 16px;
  display:flex;align-items:center;gap:10px;}
.section-title::after{content:'';flex:1;height:1px;background:rgba(0,0,0,.1);}
.menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:14px;margin-bottom:8px;}
.menu-card{background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,.06);
  transition:all .25s;cursor:pointer;}
.menu-card:hover{transform:translateY(-4px);box-shadow:0 8px 24px rgba(0,0,0,.12);}
.menu-card-img{height:110px;display:flex;align-items:center;justify-content:center;font-size:44px;}
.menu-card-body{padding:12px 14px;}
.menu-card-name{font-weight:600;font-size:14px;margin-bottom:3px;}
.menu-card-desc{font-size:11px;color:var(--muted);margin-bottom:10px;line-height:1.4;}
.menu-card-footer{display:flex;align-items:center;justify-content:space-between;}
.menu-card-price{font-weight:700;color:var(--caramel);font-size:14px;}
.btn-add{background:var(--espresso);color:white;border:none;width:28px;height:28px;
  border-radius:50%;font-size:18px;cursor:pointer;display:flex;align-items:center;
  justify-content:center;transition:all .2s;line-height:1;}
.btn-add:hover{background:var(--caramel);transform:scale(1.1);}

/* Cart sidebar */
.cart-fab{position:fixed;bottom:24px;right:24px;background:var(--espresso);color:white;
  border:none;width:58px;height:58px;border-radius:50%;font-size:24px;cursor:pointer;
  box-shadow:0 4px 20px rgba(0,0,0,.3);transition:all .2s;display:flex;
  align-items:center;justify-content:center;}
.cart-fab:hover{background:var(--caramel);transform:scale(1.05);}
.cart-badge-fab{position:absolute;top:-2px;right:-2px;background:var(--caramel);
  color:white;width:20px;height:20px;border-radius:50%;font-size:11px;
  display:flex;align-items:center;justify-content:center;font-weight:700;}

.overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:200;}
.overlay.open{display:block;}
.cart-panel{position:fixed;top:0;right:0;width:360px;max-width:95vw;height:100vh;
  background:#FAF7F2;z-index:201;display:flex;flex-direction:column;
  transform:translateX(100%);transition:transform .25s ease;}
.cart-panel.open{transform:translateX(0);}
.cart-head{padding:20px;border-bottom:1px solid rgba(0,0,0,.08);
  display:flex;align-items:center;justify-content:space-between;}
.cart-head h3{font-family:'Playfair Display',serif;font-size:20px;}
.btn-close{background:none;border:none;font-size:22px;cursor:pointer;color:var(--muted);}
.cart-body{flex:1;overflow-y:auto;padding:4px 0;}
.cart-item{display:flex;align-items:center;gap:10px;padding:12px 20px;
  border-bottom:1px solid rgba(0,0,0,.05);}
.cart-item-emoji{font-size:26px;}
.cart-item-info{flex:1;}
.cart-item-name{font-weight:600;font-size:13px;}
.cart-item-price{font-size:12px;color:var(--caramel);}
.qty-row{display:flex;align-items:center;gap:8px;margin-top:2px;}
.qty-btn{background:var(--espresso);color:white;border:none;width:22px;height:22px;
  border-radius:50%;cursor:pointer;font-size:13px;display:flex;align-items:center;justify-content:center;}
.qty-val{font-weight:600;font-size:13px;min-width:18px;text-align:center;}
.cart-foot{padding:16px 20px;border-top:2px solid rgba(0,0,0,.08);}
.cart-note{margin-bottom:12px;}
.cart-note label{font-size:11px;font-weight:500;color:var(--muted);text-transform:uppercase;
  letter-spacing:.05em;display:block;margin-bottom:5px;}
.cart-note textarea{width:100%;padding:9px 11px;border:1.5px solid rgba(0,0,0,.1);
  border-radius:8px;font-family:'DM Sans',sans-serif;font-size:13px;resize:none;height:60px;outline:none;}
.cart-note textarea:focus{border-color:var(--caramel);}
.cart-total{display:flex;justify-content:space-between;font-weight:700;font-size:15px;margin-bottom:12px;}
.btn-checkout{width:100%;padding:12px;background:var(--caramel);color:white;border:none;
  border-radius:10px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:500;cursor:pointer;}
.btn-checkout:hover{background:var(--roast);}
.cart-empty{text-align:center;padding:48px;color:var(--muted);font-size:14px;}
</style>
@endpush

@section('content')
<div class="hero">
  <h2>Selamat datang, {{ Auth::user()->name }}! ☕</h2>
  <p>Pilih kopi favoritmu dan nikmati setiap tegukan</p>
</div>

@foreach([['hot','☕ Kopi Panas',$hotMenus,'#FFF3E0'],['cold','🧊 Kopi Dingin',$coldMenus,'#E3F2FD'],['other','🥤 Non-Kopi',$otherMenus,'#E8F5E9']] as [$cat,$label,$items,$bg])
<h3 class="section-title">{{ $label }}</h3>
<div class="menu-grid">
  @foreach($items as $m)
  <div class="menu-card" onclick="addToCart({{ $m->id }}, '{{ addslashes($m->name) }}', {{ $m->price }}, '{{ $m->emoji }}')">
    <div class="menu-card-img" style="background:{{ $bg }}">{{ $m->emoji }}</div>
    <div class="menu-card-body">
      <div class="menu-card-name">{{ $m->name }}</div>
      <div class="menu-card-desc">{{ $m->description }}</div>
      <div class="menu-card-footer">
        <span class="menu-card-price">Rp {{ number_format($m->price,0,',','.') }}</span>
        <button class="btn-add" onclick="event.stopPropagation();addToCart({{ $m->id }}, '{{ addslashes($m->name) }}', {{ $m->price }}, '{{ $m->emoji }}')">+</button>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endforeach

<!-- Cart FAB -->
<button class="cart-fab" onclick="openCart()" id="cart-fab" style="display:none">
  🛒
  <span class="cart-badge-fab" id="cart-badge">0</span>
</button>

<!-- Cart Panel -->
<div class="overlay" id="overlay" onclick="closeCart()"></div>
<div class="cart-panel" id="cart-panel">
  <div class="cart-head">
    <h3>🛒 Keranjang</h3>
    <button class="btn-close" onclick="closeCart()">✕</button>
  </div>
  <div class="cart-body" id="cart-body">
    <div class="cart-empty">Keranjang masih kosong</div>
  </div>
  <div class="cart-foot" id="cart-foot" style="display:none">
    <div class="cart-note">
      <label>Catatan</label>
      <textarea id="cart-note" placeholder="Contoh: less sugar, no ice..."></textarea>
    </div>
    <div class="cart-total">
      <span>Total</span>
      <span id="cart-total">Rp 0</span>
    </div>
    <button class="btn-checkout" onclick="checkout()">Pesan Sekarang</button>
  </div>
</div>

<!-- Hidden form for submission -->
<form id="order-form" method="POST" action="{{ route('orders.store') }}" style="display:none">
  @csrf
  <div id="form-items"></div>
  <input type="hidden" name="note" id="form-note">
</form>
@endsection

@push('scripts')
<script>
let cart = {};

function addToCart(id, name, price, emoji) {
  if (cart[id]) cart[id].qty++;
  else cart[id] = { id, name, price, emoji, qty: 1 };
  updateCart();
  showToast('Ditambahkan ke keranjang 🛒');
}

function updateCart() {
  const keys = Object.keys(cart);
  const totalQty = keys.reduce((s, k) => s + cart[k].qty, 0);
  const totalPrice = keys.reduce((s, k) => s + cart[k].price * cart[k].qty, 0);

  // Badge
  const badge = document.getElementById('cart-badge');
  const fab = document.getElementById('cart-fab');
  badge.textContent = totalQty;
  fab.style.display = totalQty > 0 ? 'flex' : 'none';

  // Body
  const body = document.getElementById('cart-body');
  const foot = document.getElementById('cart-foot');
  if (keys.length === 0) {
    body.innerHTML = '<div class="cart-empty">Keranjang masih kosong</div>';
    foot.style.display = 'none';
    return;
  }
  foot.style.display = '';
  body.innerHTML = keys.map(k => {
    const item = cart[k];
    return `
    <div class="cart-item">
      <span class="cart-item-emoji">${item.emoji}</span>
      <div class="cart-item-info">
        <div class="cart-item-name">${item.name}</div>
        <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
        <div class="qty-row">
          <button class="qty-btn" onclick="changeQty(${k},-1)">−</button>
          <span class="qty-val">${item.qty}</span>
          <button class="qty-btn" onclick="changeQty(${k},1)">+</button>
        </div>
      </div>
    </div>`;
  }).join('');
  document.getElementById('cart-total').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
}

function changeQty(id, delta) {
  if (!cart[id]) return;
  cart[id].qty += delta;
  if (cart[id].qty <= 0) delete cart[id];
  updateCart();
}

function openCart()  { document.getElementById('overlay').classList.add('open'); document.getElementById('cart-panel').classList.add('open'); }
function closeCart() { document.getElementById('overlay').classList.remove('open'); document.getElementById('cart-panel').classList.remove('open'); }

function checkout() {
  const keys = Object.keys(cart);
  if (!keys.length) return;
  const formItems = document.getElementById('form-items');
  formItems.innerHTML = '';
  keys.forEach((k, i) => {
    formItems.innerHTML += `<input type="hidden" name="items[${i}][id]" value="${cart[k].id}">`;
    formItems.innerHTML += `<input type="hidden" name="items[${i}][qty]" value="${cart[k].qty}">`;
  });
  document.getElementById('form-note').value = document.getElementById('cart-note').value;
  document.getElementById('order-form').submit();
}

function showToast(msg) {
  const t = document.createElement('div');
  t.style.cssText = 'position:fixed;top:20px;right:20px;z-index:999;background:#1C0F08;color:#F5EFE0;padding:11px 18px;border-radius:8px;font-size:13px;box-shadow:0 4px 16px rgba(0,0,0,.3);';
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(() => t.remove(), 2000);
}
</script>
@endpush
