<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'BrewHouse') — BrewHouse</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
:root {
  --cream:#F5EFE0; --espresso:#1C0F08; --mocha:#3D1F0E;
  --caramel:#C27B3C; --latte:#D4A96A; --foam:#FAF7F2;
  --roast:#6B3A1F; --muted:#8A7060; --success:#4A7C59; --danger:#9B3A3A;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--espresso);min-height:100vh;}
a{color:inherit;text-decoration:none;}

/* Header */
.header{background:var(--espresso);color:var(--cream);padding:0 24px;height:60px;
  display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:100;box-shadow:0 2px 20px rgba(0,0,0,.3);}
.header-brand{font-family:'Playfair Display',serif;font-size:20px;}
.header-brand span{color:var(--latte);font-style:italic;}
.header-right{display:flex;align-items:center;gap:16px;font-size:13px;}
.header-user{color:var(--latte);}
.btn-logout{background:rgba(255,255,255,.1);border:none;color:var(--cream);
  padding:6px 14px;border-radius:7px;cursor:pointer;font-size:13px;font-family:'DM Sans',sans-serif;
  transition:background .2s;}
.btn-logout:hover{background:rgba(255,255,255,.2);}

/* Nav */
.nav{background:var(--mocha);display:flex;border-bottom:1px solid rgba(255,255,255,.1);}
.nav a{padding:12px 20px;color:rgba(255,255,255,.5);font-size:13px;font-weight:500;
  border-bottom:2px solid transparent;transition:all .2s;white-space:nowrap;}
.nav a:hover{color:rgba(255,255,255,.8);}
.nav a.active{color:var(--latte);border-bottom-color:var(--latte);}

/* Container */
.container{max-width:1100px;margin:0 auto;padding:28px 24px;}

/* Alert */
.alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;}
.alert-success{background:#D4EDDA;color:#155724;border:1px solid #C3E6CB;}
.alert-error{background:#F8D7DA;color:#721C24;border:1px solid #F5C6CB;}

/* Cards */
.card{background:white;border-radius:14px;box-shadow:0 2px 12px rgba(0,0,0,.06);overflow:hidden;}
.card-header{padding:16px 20px;border-bottom:1px solid rgba(0,0,0,.07);display:flex;align-items:center;justify-content:space-between;}
.card-header h3{font-size:16px;font-weight:600;}
.card-body{padding:20px;}

/* Buttons */
.btn{padding:9px 20px;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:14px;
  font-weight:500;cursor:pointer;border:none;transition:all .2s;display:inline-block;}
.btn-primary{background:var(--espresso);color:white;}
.btn-primary:hover{background:var(--mocha);}
.btn-caramel{background:var(--caramel);color:white;}
.btn-caramel:hover{background:var(--roast);}
.btn-sm{padding:5px 12px;font-size:12px;border-radius:6px;}
.btn-outline-edit{border:1.5px solid var(--caramel);color:var(--caramel);background:transparent;}
.btn-outline-edit:hover{background:var(--caramel);color:white;}
.btn-outline-delete{border:1.5px solid var(--danger);color:var(--danger);background:transparent;}
.btn-outline-delete:hover{background:var(--danger);color:white;}
.btn-outline-green{border:1.5px solid var(--success);color:var(--success);background:transparent;}

/* Form */
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:12px;font-weight:500;color:var(--muted);
  margin-bottom:6px;text-transform:uppercase;letter-spacing:.05em;}
.form-control{width:100%;padding:10px 14px;border:1.5px solid rgba(0,0,0,.1);border-radius:9px;
  font-family:'DM Sans',sans-serif;font-size:14px;color:var(--espresso);outline:none;
  background:white;transition:border-color .2s;}
.form-control:focus{border-color:var(--caramel);}
.form-control.is-invalid{border-color:var(--danger);}
.invalid-feedback{color:var(--danger);font-size:12px;margin-top:4px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

/* Table */
table{width:100%;border-collapse:collapse;}
th{background:var(--cream);padding:10px 16px;text-align:left;
  font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);}
td{padding:12px 16px;font-size:13px;border-bottom:1px solid rgba(0,0,0,.05);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(0,0,0,.02);}

/* Status badges */
.badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;}
.badge-pending{background:#FFF3CD;color:#856404;}
.badge-process{background:#CCE5FF;color:#004085;}
.badge-done{background:#D4EDDA;color:#155724;}
.badge-cancel{background:#F8D7DA;color:#721C24;}
.badge-admin{background:#FFE5CC;color:#CC5500;}
.badge-customer{background:#D4EDDA;color:#155724;}

@media(max-width:640px){
  .form-row{grid-template-columns:1fr;}
  .container{padding:16px;}
}
</style>
@stack('styles')
</head>
<body>

<header class="header">
  <div class="header-brand">☕ Brew<span>House</span></div>
  <div class="header-right">
    <span class="header-user">{{ Auth::user()->name }}</span>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">Keluar 🚪</button>
    </form>
  </div>
</header>

<nav class="nav">
  @yield('nav')
</nav>

<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
  @endif

  @yield('content')
</div>

@stack('scripts')
</body>
</html>
