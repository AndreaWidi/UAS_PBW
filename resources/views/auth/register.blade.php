<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar — BrewHouse</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root{--cream:#F5EFE0;--espresso:#1C0F08;--caramel:#C27B3C;--latte:#D4A96A;--foam:#FAF7F2;--muted:#8A7060;--danger:#9B3A3A;}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--espresso);min-height:100vh;
  display:flex;align-items:center;justify-content:center;padding:20px;
  background:radial-gradient(ellipse at 70% 30%,rgba(194,123,60,.2) 0%,transparent 60%) var(--espresso);}
.card{background:var(--foam);width:420px;max-width:92vw;border-radius:20px;padding:40px;
  box-shadow:0 40px 80px rgba(0,0,0,.4);}
.logo{text-align:center;margin-bottom:28px;}
.logo-icon{font-size:32px;display:block;margin-bottom:6px;}
.logo h1{font-family:'Playfair Display',serif;font-size:26px;color:var(--espresso);}
.logo h1 span{color:var(--caramel);}
.form-group{margin-bottom:14px;}
.form-group label{display:block;font-size:12px;font-weight:500;color:var(--muted);
  margin-bottom:5px;text-transform:uppercase;letter-spacing:.05em;}
.form-control{width:100%;padding:10px 14px;border:1.5px solid rgba(0,0,0,.1);border-radius:9px;
  background:white;font-family:'DM Sans',sans-serif;font-size:14px;outline:none;transition:border-color .2s;}
.form-control:focus{border-color:var(--caramel);}
.form-control.is-invalid{border-color:var(--danger);}
.invalid-feedback{color:var(--danger);font-size:12px;margin-top:4px;}
.btn-submit{width:100%;padding:12px;background:var(--espresso);color:white;border:none;
  border-radius:10px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:500;
  cursor:pointer;transition:all .2s;margin-top:4px;}
.btn-submit:hover{background:#2d1810;transform:translateY(-1px);}
.link{text-align:center;font-size:13px;color:var(--muted);margin-top:14px;}
.link a{color:var(--caramel);}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
@media(max-width:480px){.form-row{grid-template-columns:1fr;}}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <span class="logo-icon">☕</span>
    <h1>Brew<span>House</span></h1>
    <p style="font-size:13px;color:var(--muted);margin-top:4px;">Buat akun baru</p>
  </div>

  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
             placeholder="Nama kamu" value="{{ old('name') }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
               placeholder="email@kamu.com" value="{{ old('email') }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="form-group">
        <label>No. HP</label>
        <input type="tel" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
               placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
               placeholder="Min. 6 karakter" required>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="form-group">
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control"
               placeholder="Ulangi password" required>
      </div>
    </div>
    <button type="submit" class="btn-submit">Buat Akun</button>
  </form>

  <div class="link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
</div>
</body>
</html>
