<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — BrewHouse</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root{--cream:#F5EFE0;--espresso:#1C0F08;--caramel:#C27B3C;--latte:#D4A96A;--foam:#FAF7F2;--muted:#8A7060;--danger:#9B3A3A;}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--espresso);min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  background:radial-gradient(ellipse at 30% 50%,rgba(194,123,60,.25) 0%,transparent 60%) var(--espresso);}
.card{background:var(--foam);width:400px;max-width:92vw;border-radius:20px;padding:40px;
  box-shadow:0 40px 80px rgba(0,0,0,.4);}
.logo{text-align:center;margin-bottom:32px;}
.logo-icon{font-size:36px;display:block;margin-bottom:8px;}
.logo h1{font-family:'Playfair Display',serif;font-size:28px;color:var(--espresso);}
.logo h1 span{color:var(--caramel);}
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:12px;font-weight:500;color:var(--muted);
  margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;}
.form-control{width:100%;padding:11px 14px;border:1.5px solid rgba(0,0,0,.1);border-radius:10px;
  background:white;font-family:'DM Sans',sans-serif;font-size:14px;outline:none;transition:border-color .2s;}
.form-control:focus{border-color:var(--caramel);}
.form-control.is-invalid{border-color:var(--danger);}
.invalid-feedback{color:var(--danger);font-size:12px;margin-top:4px;}
.btn-submit{width:100%;padding:13px;background:var(--espresso);color:white;border:none;
  border-radius:10px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:500;
  cursor:pointer;transition:all .2s;margin-top:4px;}
.btn-submit:hover{background:#2d1810;transform:translateY(-1px);}
.link{text-align:center;font-size:13px;color:var(--muted);margin-top:16px;}
.link a{color:var(--caramel);}
.alert-error{background:#F8D7DA;color:#721C24;padding:10px 14px;border-radius:8px;
  font-size:13px;margin-bottom:16px;}
.hint{text-align:center;font-size:11px;color:var(--muted);margin-top:14px;line-height:1.8;}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <span class="logo-icon">☕</span>
    <h1>Brew<span>House</span></h1>
  </div>

  @if($errors->any())
    <div class="alert-error">{{ $errors->first() }}</div>
  @endif
  @if(session('success'))
    <div style="background:#D4EDDA;color:#155724;padding:10px 14px;border-radius:8px;font-size:13px;margin-bottom:16px;">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
             placeholder="email@kamu.com" value="{{ old('email') }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
             placeholder="••••••••" required>
      @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn-submit">Masuk Sekarang</button>
  </form>

  <div class="link">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></div>
  <div class="hint">
    <strong>Demo:</strong><br>
    Admin → admin@brew.com / admin123<br>
    Customer → user@brew.com / user123
  </div>
</div>
</body>
</html>
