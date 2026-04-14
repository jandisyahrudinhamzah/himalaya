<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Keuangan</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Sora:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<style>
:root {
  --bg: #080f1c;
  --surface: #0e1a2e;
  --surface2: #152338;
  --surface3: #1c2f47;
  --border: #1e3354;
  --border2: #264469;
  --green: #22c55e;
  --green-dim: rgba(34,197,94,.12);
  --orange: #f97316;
  --orange-dim: rgba(249,115,22,.12);
  --blue: #38bdf8;
  --blue-dim: rgba(56,189,248,.12);
  --purple: #a78bfa;
  --text: #dde9f7;
  --text2: #6e8faf;
  --text3: #3d5a78;
  --radius: 14px;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}

/* LOGIN SCREEN */
#login-screen {
  min-height:100vh;display:flex;align-items:center;justify-content:center;
  background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(56,189,248,.08) 0%,transparent 70%),
             radial-gradient(ellipse 60% 50% at 80% 100%,rgba(34,197,94,.06) 0%,transparent 60%),var(--bg);
  position:relative;overflow:hidden;
}
#login-screen::before{
  content:'';position:absolute;inset:0;
  background-image:repeating-linear-gradient(0deg,transparent,transparent 39px,rgba(30,51,84,.4) 39px,rgba(30,51,84,.4) 40px),
                   repeating-linear-gradient(90deg,transparent,transparent 39px,rgba(30,51,84,.4) 39px,rgba(30,51,84,.4) 40px);
  pointer-events:none;
}
.login-box{
  background:var(--surface);border:1px solid var(--border);border-radius:20px;
  width:420px;max-width:95vw;padding:40px;position:relative;z-index:1;
  box-shadow:0 30px 80px rgba(0,0,0,.5),0 0 0 1px rgba(56,189,248,.05);
  animation:fadeUp .4s ease;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.login-logo{text-align:center;margin-bottom:28px;}
.login-logo .icon{
  width:56px;height:56px;margin:0 auto 12px;
  background:linear-gradient(135deg,#22c55e,#0f9b45);border-radius:16px;
  display:flex;align-items:center;justify-content:center;font-size:26px;
  box-shadow:0 8px 24px rgba(34,197,94,.3);
}
.login-logo h1{font-family:'Sora',sans-serif;font-size:20px;font-weight:700;}
.login-logo p{font-size:13px;color:var(--text2);margin-top:3px;}
.role-tabs{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:24px;}
.role-tab{
  padding:12px;border-radius:10px;border:2px solid var(--border);
  background:var(--surface2);cursor:pointer;text-align:center;
  transition:all .2s;font-size:13px;font-weight:600;
}
.role-tab .tab-icon{font-size:20px;display:block;margin-bottom:4px;}
.role-tab.active.bendahara{border-color:var(--green);background:var(--green-dim);color:var(--green);}
.role-tab.active.anggota{border-color:var(--blue);background:var(--blue-dim);color:var(--blue);}
.login-hint{
  background:var(--surface2);border:1px solid var(--border);border-radius:10px;
  padding:12px 14px;margin-bottom:20px;font-size:12px;color:var(--text2);line-height:1.8;
}
.login-hint strong{color:var(--text);}
.fg{margin-bottom:16px;}
.form-label{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text2);margin-bottom:7px;}
.form-input{
  width:100%;background:var(--surface2);border:1.5px solid var(--border);
  color:var(--text);padding:11px 14px;border-radius:10px;
  font-size:14px;font-family:inherit;outline:none;transition:border .2s;
}
.form-input:focus{border-color:var(--blue);}
.login-err{color:#f87171;font-size:12px;margin-bottom:12px;display:none;text-align:center;}
.btn-login{
  width:100%;padding:13px;border-radius:11px;border:none;cursor:pointer;
  font-size:15px;font-weight:700;font-family:inherit;transition:all .2s;
  background:linear-gradient(135deg,#22c55e,#15803d);color:#fff;letter-spacing:.2px;
  box-shadow:0 4px 16px rgba(34,197,94,.25);
}
.btn-login:hover{transform:translateY(-1px);box-shadow:0 6px 24px rgba(34,197,94,.35);}
.btn-login.anggota-btn{background:linear-gradient(135deg,#38bdf8,#0ea5e9);box-shadow:0 4px 16px rgba(56,189,248,.25);}
.btn-login.anggota-btn:hover{box-shadow:0 6px 24px rgba(56,189,248,.35);}

/* APP */
#app-screen{display:none;min-height:100vh;}
.topbar{
  background:var(--surface);border-bottom:1px solid var(--border);
  padding:0 28px;height:62px;display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:100;backdrop-filter:blur(10px);
}
.topbar-left{display:flex;align-items:center;gap:12px;}
.brand-icon{
  width:36px;height:36px;background:linear-gradient(135deg,#22c55e,#15803d);
  border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:18px;
  box-shadow:0 4px 12px rgba(34,197,94,.25);
}
.brand-name{font-family:'Sora',sans-serif;font-size:16px;font-weight:700;}
.topbar-right{display:flex;align-items:center;gap:12px;}
.role-badge{padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.role-badge.bendahara{background:var(--green-dim);color:var(--green);border:1px solid rgba(34,197,94,.3);}
.role-badge.anggota{background:var(--blue-dim);color:var(--blue);border:1px solid rgba(56,189,248,.3);}
.user-chip{display:flex;align-items:center;gap:9px;background:var(--surface2);padding:6px 14px 6px 7px;border-radius:30px;border:1px solid var(--border);}
.user-avatar{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;}
.avatar-bendahara{background:linear-gradient(135deg,#22c55e,#15803d);}
.avatar-anggota{background:linear-gradient(135deg,#38bdf8,#0ea5e9);color:#0c1a2e;}
.user-name{font-size:13px;font-weight:600;}
.user-role-txt{font-size:11px;color:var(--text2);}
.btn-logout{
  background:var(--surface2);border:1px solid var(--border);color:var(--text2);
  padding:7px 14px;border-radius:9px;font-size:12px;font-weight:600;
  cursor:pointer;font-family:inherit;transition:all .2s;
}
.btn-logout:hover{border-color:#ef4444;color:#f87171;}
.readonly-banner{
  background:linear-gradient(135deg,rgba(56,189,248,.08),rgba(56,189,248,.04));
  border:1px solid rgba(56,189,248,.2);border-radius:10px;
  padding:10px 18px;margin:18px 28px 0;
  display:flex;align-items:center;gap:10px;font-size:13px;color:var(--blue);
}
.readonly-banner strong{color:var(--text);}
.main{padding:22px 28px;max-width:1400px;margin:0 auto;}

/* STAT CARDS */
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:22px;}
.stat-card{
  background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);
  padding:20px 22px;transition:transform .2s,box-shadow .2s;position:relative;overflow:hidden;
}
.stat-card::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
.stat-card.green::after{background:linear-gradient(90deg,#22c55e,transparent);}
.stat-card.orange::after{background:linear-gradient(90deg,#f97316,transparent);}
.stat-card.neutral::after{background:linear-gradient(90deg,var(--blue),transparent);}
.stat-card.trx::after{background:linear-gradient(90deg,var(--purple),transparent);}
.stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,0,0,.3);}
.stat-label{font-size:11px;color:var(--text2);font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px;display:flex;align-items:center;gap:7px;}
.stat-dot{width:7px;height:7px;border-radius:50%;}
.stat-value{font-family:'Sora',sans-serif;font-size:21px;font-weight:700;letter-spacing:-.5px;}
.c-green{color:var(--green);}
.c-orange{color:var(--orange);}
.c-white{color:var(--text);}
.c-purple{color:var(--purple);font-size:26px;}
.stat-bar-wrap{margin-top:10px;height:3px;background:var(--border);border-radius:2px;}
.stat-bar-fill{height:100%;border-radius:2px;background:var(--purple);transition:width .8s ease;}

/* LAYOUT */
.row{display:grid;gap:18px;margin-bottom:18px;}
.row-2-1{grid-template-columns:1fr 320px;}
.col-stack{display:flex;flex-direction:column;gap:18px;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:22px;}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;}
.card-title{font-family:'Sora',sans-serif;font-size:14px;font-weight:700;}
.chart-wrap{position:relative;height:210px;}
.chart-wrap-sm{position:relative;height:160px;}
.donut-legend{display:flex;flex-direction:column;gap:9px;margin-top:14px;}
.legend-row{display:flex;align-items:center;justify-content:space-between;font-size:13px;}
.legend-l{display:flex;align-items:center;gap:8px;}
.leg-dot{width:10px;height:10px;border-radius:3px;flex-shrink:0;}

/* TABLE */
.table-scroll{overflow-x:auto;}
table{width:100%;border-collapse:collapse;font-size:13px;}
thead th{text-align:left;padding:10px 14px;color:var(--text2);font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;border-bottom:1px solid var(--border);}
tbody tr{border-bottom:1px solid rgba(30,51,84,.6);transition:background .15s;}
tbody tr:hover{background:var(--surface2);}
tbody td{padding:12px 14px;}
.td-date{color:var(--text2);font-size:12px;white-space:nowrap;}
.td-desc{font-weight:600;}
.kat-badge{padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;}
.k-ops{background:rgba(56,189,248,.12);color:#7dd3fc;}
.k-gaji{background:rgba(249,115,22,.12);color:#fdba74;}
.k-sosial{background:rgba(168,85,247,.12);color:#c084fc;}
.k-keang{background:rgba(234,179,8,.12);color:#fde047;}
.k-picd{background:rgba(34,197,94,.12);color:#86efac;}
.k-lain{background:rgba(100,116,139,.12);color:#94a3b8;}
.td-in{color:var(--green);font-weight:700;}
.td-out{color:var(--orange);font-weight:700;}
.td-saldo{font-weight:700;}
.td-acts{display:flex;gap:7px;}
.btn-ico{width:30px;height:30px;border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;transition:all .2s;}
.ico-edit{background:rgba(56,189,248,.12);color:#7dd3fc;}
.ico-edit:hover{background:rgba(56,189,248,.25);}
.ico-del{background:rgba(239,68,68,.12);color:#f87171;}
.ico-del:hover{background:rgba(239,68,68,.25);}
.empty-st{text-align:center;padding:36px;color:var(--text3);font-size:13px;}

/* ANGGARAN */
.ang-item{margin-bottom:15px;}
.ang-lbl{display:flex;justify-content:space-between;font-size:13px;margin-bottom:7px;}
.ang-pct{color:var(--text2);font-size:12px;}
.ang-bar{height:7px;background:var(--border);border-radius:4px;overflow:hidden;}
.ang-fill{height:100%;border-radius:4px;transition:width .8s ease;}
.f-green{background:linear-gradient(90deg,#16a34a,#22c55e);}
.f-orange{background:linear-gradient(90deg,#ea580c,#f97316);}
.f-blue{background:linear-gradient(90deg,#0ea5e9,#38bdf8);}

/* BUTTONS */
.btn-add{background:linear-gradient(135deg,#22c55e,#15803d);color:#fff;border:none;padding:9px 17px;border-radius:9px;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;display:flex;align-items:center;gap:6px;transition:all .2s;box-shadow:0 2px 10px rgba(34,197,94,.2);}
.btn-add:hover{transform:translateY(-1px);box-shadow:0 4px 16px rgba(34,197,94,.3);}
.btn-save{flex:1;padding:11px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:700;font-family:inherit;transition:all .2s;}
.btn-save.green{background:linear-gradient(135deg,#22c55e,#15803d);color:#fff;}
.btn-save.blue{background:linear-gradient(135deg,#38bdf8,#0ea5e9);color:#0c1a2e;}
.btn-save:hover{transform:translateY(-1px);}
.btn-cancel{padding:11px 18px;border-radius:10px;border:1px solid var(--border);background:transparent;color:var(--text2);font-size:14px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .2s;}
.btn-cancel:hover{border-color:var(--border2);color:var(--text);}
.btn-danger{padding:11px 18px;border-radius:10px;border:none;background:linear-gradient(135deg,#dc2626,#ef4444);color:#fff;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .2s;flex:1;}
.btn-danger:hover{box-shadow:0 4px 16px rgba(239,68,68,.3);}

/* MODAL */
.overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.65);backdrop-filter:blur(6px);z-index:200;align-items:center;justify-content:center;}
.overlay.open{display:flex;}
.modal{background:var(--surface);border:1px solid var(--border2);border-radius:18px;padding:30px;width:400px;max-width:95vw;animation:popIn .25s cubic-bezier(.34,1.56,.64,1);box-shadow:0 24px 60px rgba(0,0,0,.6);}
@keyframes popIn{from{opacity:0;transform:scale(.92)}to{opacity:1;transform:scale(1)}}
.modal-hdr{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;}
.modal-title{font-family:'Sora',sans-serif;font-size:16px;font-weight:700;}
.modal-x{width:30px;height:30px;border-radius:8px;border:none;background:var(--surface2);color:var(--text2);cursor:pointer;font-size:15px;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.modal-x:hover{background:var(--surface3);color:var(--text);}
.mfg{margin-bottom:16px;}
.mfl{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--text2);margin-bottom:7px;}
.mfi,.mfs{width:100%;background:var(--surface2);border:1.5px solid var(--border);color:var(--text);padding:10px 14px;border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:border .2s;}
.mfi:focus,.mfs:focus{border-color:var(--blue);}
.mfs option{background:var(--surface2);}
.radio-grp{display:flex;gap:20px;}
.radio-lbl{display:flex;align-items:center;gap:8px;cursor:pointer;font-size:14px;font-weight:500;}
.radio-lbl input{width:16px;height:16px;}
input[type=radio].r-green{accent-color:var(--green);}
input[type=radio].r-orange{accent-color:var(--orange);}
.modal-acts{display:flex;gap:10px;margin-top:22px;}
.del-icon-big{font-size:44px;text-align:center;margin-bottom:14px;}
.del-q{font-size:17px;font-weight:700;text-align:center;margin-bottom:18px;line-height:1.4;}
.del-detail{background:var(--surface2);border:1px solid var(--border);border-radius:11px;padding:14px 16px;font-size:13px;line-height:2;}
.del-detail .lbl{color:var(--text2);}

::-webkit-scrollbar{width:5px;height:5px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--border2);border-radius:3px;}

@media(max-width:900px){.stat-grid{grid-template-columns:1fr 1fr;}.row-2-1{grid-template-columns:1fr;}}
@media(max-width:500px){.stat-grid{grid-template-columns:1fr;}.main{padding:16px;}.topbar{padding:0 14px;}}
</style>
</head>
<body>

<!-- ══════════ LOGIN ══════════ -->
<div id="login-screen">
  <div class="login-box">
    <div class="login-logo">
      <div class="icon">💰</div>
      <h1>Sistem Keuangan</h1>
      <p>Masuk untuk mengakses dashboard</p>
    </div>

    <div class="role-tabs">
      <div class="role-tab active bendahara" id="tab-b" onclick="selectRole('bendahara')">
        <span class="tab-icon">🏦</span>Bendahara
      </div>
      <div class="role-tab" id="tab-a" onclick="selectRole('anggota')">
        <span class="tab-icon">👤</span>Anggota
      </div>
    </div>

    <div class="login-hint" id="login-hint">
      <strong>Akun Bendahara:</strong><br>
      Username: <strong>bendahara</strong> &nbsp;|&nbsp; Password: <strong>admin123</strong>
    </div>

    <div class="fg">
      <label class="form-label">Username</label>
      <input type="text" class="form-input" id="in-user" placeholder="Masukkan username" onkeydown="if(event.key==='Enter')doLogin()">
    </div>
    <div class="fg" style="margin-bottom:20px;">
      <label class="form-label">Password</label>
      <input type="password" class="form-input" id="in-pass" placeholder="Masukkan password" onkeydown="if(event.key==='Enter')doLogin()">
    </div>
    <div class="login-err" id="login-err">Username atau password salah</div>
    <button class="btn-login" id="btn-masuk" onclick="doLogin()">🔐 Masuk sebagai Bendahara</button>
  </div>
</div>

<!-- ══════════ APP ══════════ -->
<div id="app-screen">
  <div class="topbar">
    <div class="topbar-left">
      <div class="brand-icon">💰</div>
      <span class="brand-name">Dashboard Keuangan</span>
    </div>
    <div class="topbar-right">
      <div class="role-badge" id="top-badge"></div>
      <div class="user-chip">
        <div class="user-avatar" id="top-av"></div>
        <div>
          <div class="user-name" id="top-name"></div>
          <div class="user-role-txt" id="top-role"></div>
        </div>
      </div>
      <button class="btn-logout" onclick="doLogout()">⏻ Keluar</button>
    </div>
  </div>

  <div class="readonly-banner" id="ro-banner" style="display:none;">
    👁️ &nbsp;<span>Anda masuk sebagai <strong>Anggota</strong> — hanya dapat melihat data keuangan tanpa melakukan perubahan.</span>
  </div>

  <div class="main">
    <div class="stat-grid">
      <div class="stat-card green">
        <div class="stat-label"><div class="stat-dot" style="background:var(--green)"></div>Total Pemasukan</div>
        <div class="stat-value c-green" id="s-masuk">Rp 0</div>
      </div>
      <div class="stat-card orange">
        <div class="stat-label"><div class="stat-dot" style="background:var(--orange)"></div>Total Pengeluaran</div>
        <div class="stat-value c-orange" id="s-keluar">Rp 0</div>
      </div>
      <div class="stat-card neutral">
        <div class="stat-label"><div class="stat-dot" style="background:var(--blue)"></div>Saldo Saat Ini</div>
        <div class="stat-value c-white" id="s-saldo">Rp 0</div>
      </div>
      <div class="stat-card trx">
        <div class="stat-label"><div class="stat-dot" style="background:var(--purple)"></div>Transaksi Bulan Ini</div>
        <div class="stat-value c-purple" id="s-trx">0 Transaksi</div>
        <div class="stat-bar-wrap"><div class="stat-bar-fill" id="s-bar"></div></div>
      </div>
    </div>

    <div class="row row-2-1">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Laporan Keuangan Bulanan</div>
          <div style="display:flex;gap:14px;font-size:12px;">
            <span style="display:flex;align-items:center;gap:5px;color:var(--green)"><span style="width:9px;height:9px;border-radius:2px;background:var(--green);display:inline-block"></span>Pemasukan</span>
            <span style="display:flex;align-items:center;gap:5px;color:var(--orange)"><span style="width:9px;height:9px;border-radius:2px;background:var(--orange);display:inline-block"></span>Pengeluaran</span>
          </div>
        </div>
        <div class="chart-wrap"><canvas id="cLap"></canvas></div>
      </div>
      <div class="card">
        <div class="card-header"><div class="card-title">Persentase Pemasukan & Pengeluaran</div></div>
        <div class="chart-wrap-sm"><canvas id="cDon"></canvas></div>
        <div class="donut-legend">
          <div class="legend-row"><div class="legend-l"><div class="leg-dot" style="background:var(--green)"></div>Pemasukan</div><span id="pct-in">0%</span></div>
          <div class="legend-row"><div class="legend-l"><div class="leg-dot" style="background:var(--orange)"></div>Pengeluaran</div><span id="pct-out">0%</span></div>
        </div>
      </div>
    </div>

    <div class="row row-2-1">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Riwayat Transaksi</div>
          <div id="tbl-act"></div>
        </div>
        <div class="table-scroll">
          <table>
            <thead>
              <tr>
                <th>Tanggal</th><th>Deskripsi</th><th>Kategori</th>
                <th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th>
                <th id="th-aksi"></th>
              </tr>
            </thead>
            <tbody id="tbody"></tbody>
          </table>
          <div class="empty-st" id="empty-st" style="display:none;">Belum ada transaksi.</div>
        </div>
      </div>

      <div class="col-stack">
        <div class="card">
          <div class="card-header"><div class="card-title">Rincian Anggaran</div></div>
          <div id="ang-list"></div>
        </div>
        <div class="card">
          <div class="card-header"><div class="card-title">Distribusi Kategori</div></div>
          <div class="chart-wrap-sm"><canvas id="cPie"></canvas></div>
          <div class="donut-legend" id="pie-leg" style="margin-top:10px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL TAMBAH -->
<div class="overlay" id="ov-t">
  <div class="modal">
    <div class="modal-hdr"><div class="modal-title">➕ Tambah Transaksi</div><button class="modal-x" onclick="closeOv('ov-t')">✕</button></div>
    <div class="mfg"><label class="mfl">Tanggal</label><input type="date" class="mfi" id="t-tgl"></div>
    <div class="mfg"><label class="mfl">Deskripsi</label><input type="text" class="mfi" id="t-desk" placeholder="Deskripsi transaksi"></div>
    <div class="mfg">
      <label class="mfl">Kategori</label>
      <select class="mfs" id="t-kat"><option>Operasional</option><option>Gaji &amp; Upah</option><option>Dana Sosial</option><option>Keanggotaan</option><option>Pendidikan</option><option>Lainnya</option></select>
    </div>
    <div class="mfg">
      <label class="mfl">Jenis</label>
      <div class="radio-grp">
        <label class="radio-lbl"><input type="radio" name="t-j" value="masuk" class="r-green" checked> Pemasukan</label>
        <label class="radio-lbl"><input type="radio" name="t-j" value="keluar" class="r-orange"> Pengeluaran</label>
      </div>
    </div>
    <div class="mfg"><label class="mfl">Jumlah (Rp)</label><input type="number" class="mfi" id="t-jml" placeholder="0"></div>
    <div class="modal-acts">
      <button class="btn-save green" onclick="saveTambah()">💾 Simpan</button>
      <button class="btn-cancel" onclick="closeOv('ov-t')">Batal</button>
    </div>
  </div>
</div>

<!-- MODAL EDIT -->
<div class="overlay" id="ov-e">
  <div class="modal">
    <div class="modal-hdr"><div class="modal-title">✏️ Edit Transaksi</div><button class="modal-x" onclick="closeOv('ov-e')">✕</button></div>
    <div class="mfg"><label class="mfl">Tanggal</label><input type="date" class="mfi" id="e-tgl"></div>
    <div class="mfg"><label class="mfl">Deskripsi</label><input type="text" class="mfi" id="e-desk"></div>
    <div class="mfg">
      <label class="mfl">Kategori</label>
      <select class="mfs" id="e-kat"><option>Operasional</option><option>Gaji &amp; Upah</option><option>Dana Sosial</option><option>Keanggotaan</option><option>Pendidikan</option><option>Lainnya</option></select>
    </div>
    <div class="mfg">
      <label class="mfl">Jenis</label>
      <div class="radio-grp">
        <label class="radio-lbl"><input type="radio" name="e-j" value="masuk" class="r-green"> Pemasukan</label>
        <label class="radio-lbl"><input type="radio" name="e-j" value="keluar" class="r-orange"> Pengeluaran</label>
      </div>
    </div>
    <div class="mfg"><label class="mfl">Jumlah (Rp)</label><input type="number" class="mfi" id="e-jml"></div>
    <div class="modal-acts">
      <button class="btn-save blue" onclick="saveEdit()">💾 Simpan Perubahan</button>
      <button class="btn-cancel" onclick="closeOv('ov-e')">Batal</button>
    </div>
  </div>
</div>

<!-- MODAL HAPUS -->
<div class="overlay" id="ov-h">
  <div class="modal" style="width:360px;">
    <div class="modal-hdr"><div class="modal-title">Konfirmasi Hapus</div><button class="modal-x" onclick="closeOv('ov-h')">✕</button></div>
    <div class="del-icon-big">⚠️</div>
    <div class="del-q">Apakah Anda yakin ingin<br>menghapus transaksi ini?</div>
    <div class="del-detail" id="del-det"></div>
    <div class="modal-acts" style="margin-top:20px;">
      <button class="btn-danger" onclick="confirmHapus()">🗑️ Hapus</button>
      <button class="btn-cancel" onclick="closeOv('ov-h')">Batal</button>
    </div>
  </div>
</div>

<script>
// ACCOUNTS
const ACCOUNTS=[
  {username:'bendahara',password:'admin123',role:'bendahara',nama:'',init:'B'},
  {username:'anggota1', password:'anggota1', role:'anggota',  nama:'', init:'A'},
  {username:'anggota2', password:'anggota2', role:'anggota',  nama:'',   init:'A'},
  {username:'anggota3', password:'anggota3', role:'anggota',  nama:'', init:'A'},
];
let currentUser=null, isBendahara=false, selectedRole='bendahara';

function selectRole(r){
  selectedRole=r;
  document.getElementById('tab-b').className='role-tab'+(r==='bendahara'?' active bendahara':'');
  document.getElementById('tab-a').className='role-tab'+(r==='anggota'?' active anggota':'');
  const hint=document.getElementById('login-hint');
  const btn=document.getElementById('btn-masuk');
  if(r==='bendahara'){
    hint.innerHTML='<strong>Akun Bendahara:</strong><br>Username: <strong>bendahara</strong> &nbsp;|&nbsp; Password: <strong>admin123</strong>';
    btn.textContent='🔐 Masuk sebagai Bendahara';
    btn.className='btn-login';
  } else {
    hint.innerHTML='<strong>Akun Anggota (contoh):</strong><br>Username: <strong>anggota1</strong> | Password: <strong>anggota1</strong><br>Username: <strong>anggota2</strong> | Password: <strong>anggota2</strong><br>Username: <strong>anggota3</strong> | Password: <strong>anggota3</strong>';
    btn.textContent='👁️ Masuk sebagai Anggota';
    btn.className='btn-login anggota-btn';
  }
}

function doLogin(){
  const u=document.getElementById('in-user').value.trim();
  const p=document.getElementById('in-pass').value;
  const err=document.getElementById('login-err');
  const acc=ACCOUNTS.find(a=>a.username===u&&a.password===p&&a.role===selectedRole);
  if(!acc){err.style.display='block';return;}
  err.style.display='none';
  currentUser=acc; isBendahara=acc.role==='bendahara';
  setupApp(); showApp();
}

function doLogout(){
  currentUser=null; isBendahara=false;
  document.getElementById('in-user').value='';
  document.getElementById('in-pass').value='';
  document.getElementById('app-screen').style.display='none';
  document.getElementById('login-screen').style.display='flex';
  selectRole('bendahara');
}

function setupApp(){
  document.getElementById('top-name').textContent=currentUser.nama;
  document.getElementById('top-role').textContent=currentUser.role==='bendahara'?'Bendahara':'Anggota';
  const badge=document.getElementById('top-badge');
  badge.textContent=currentUser.role==='bendahara'?'🏦 Bendahara':'👤 Anggota';
  badge.className='role-badge '+currentUser.role;
  const av=document.getElementById('top-av');
  av.textContent=currentUser.init;
  av.className='user-avatar avatar-'+currentUser.role;
  document.getElementById('ro-banner').style.display=isBendahara?'none':'flex';
  document.getElementById('tbl-act').innerHTML=isBendahara
    ?'<button class="btn-add" onclick="openTambah()">＋ Tambah</button>':'';
  document.getElementById('th-aksi').textContent=isBendahara?'Aksi':'';
}

function showApp(){
  document.getElementById('login-screen').style.display='none';
  document.getElementById('app-screen').style.display='block';
  refresh();
}

// DATABASE
const DB_KEY='bendahara_v2';
let db=[];
function loadDB(){
  const raw=localStorage.getItem(DB_KEY);
  if(raw){db=JSON.parse(raw);return;}
  db=[
    {id:uid(),tanggal:'2022-01-24',deskripsi:'Pembayaran SPP',    kategori:'Pendidikan',  jenis:'masuk',  jumlah:2500000},
    {id:uid(),tanggal:'2022-01-20',deskripsi:'Pembelian ATK',     kategori:'Operasional', jenis:'keluar', jumlah:1200000},
    {id:uid(),tanggal:'2022-01-15',deskripsi:'Donasi Acara',      kategori:'Dana Sosial', jenis:'masuk',  jumlah:5000000},
    {id:uid(),tanggal:'2022-01-10',deskripsi:'Pembayaran Iuran',  kategori:'Keanggotaan', jenis:'masuk',  jumlah:1500000},
    {id:uid(),tanggal:'2022-01-05',deskripsi:'Honor Pembicara',   kategori:'Gaji & Upah', jenis:'keluar', jumlah:3000000},
    {id:uid(),tanggal:'2022-02-12',deskripsi:'Iuran Anggota Feb', kategori:'Keanggotaan', jenis:'masuk',  jumlah:2000000},
    {id:uid(),tanggal:'2022-02-18',deskripsi:'Biaya Operasional', kategori:'Operasional', jenis:'keluar', jumlah:800000},
    {id:uid(),tanggal:'2022-03-05',deskripsi:'Sponsorship Acara', kategori:'Dana Sosial', jenis:'masuk',  jumlah:10000000},
  ];
  saveDB();
}
function saveDB(){localStorage.setItem(DB_KEY,JSON.stringify(db));}
function uid(){return Date.now().toString(36)+Math.random().toString(36).slice(2);}

// FORMAT
function fmtRp(n){return 'Rp '+n.toLocaleString('id-ID');}
function fmtDate(s){return new Date(s+'T00:00:00').toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});}
function katCls(k){return{Operasional:'k-ops','Gaji & Upah':'k-gaji','Dana Sosial':'k-sosial',Keanggotaan:'k-keang',Pendidikan:'k-picd',Lainnya:'k-lain'}[k]||'k-lain';}

// RENDER TABLE
function renderTable(){
  const sorted=[...db].sort((a,b)=>new Date(b.tanggal)-new Date(a.tanggal));
  const empty=document.getElementById('empty-st');
  const tbody=document.getElementById('tbody');
  if(!sorted.length){tbody.innerHTML='';empty.style.display='block';return;}
  empty.style.display='none';
  const chrono=[...db].sort((a,b)=>new Date(a.tanggal)-new Date(b.tanggal));
  const sm={};let cum=0;
  chrono.forEach(t=>{cum+=t.jenis==='masuk'?t.jumlah:-t.jumlah;sm[t.id]=cum;});
  tbody.innerHTML=sorted.map(t=>`
    <tr>
      <td class="td-date">${fmtDate(t.tanggal)}</td>
      <td class="td-desc">${t.deskripsi}</td>
      <td><span class="kat-badge ${katCls(t.kategori)}">${t.kategori}</span></td>
      <td class="td-in">${t.jenis==='masuk'?fmtRp(t.jumlah):'-'}</td>
      <td class="td-out">${t.jenis==='keluar'?fmtRp(t.jumlah):'-'}</td>
      <td class="td-saldo">${fmtRp(sm[t.id]??0)}</td>
      <td>${isBendahara?`<div class="td-acts"><button class="btn-ico ico-edit" onclick="openEdit('${t.id}')">✏️</button><button class="btn-ico ico-del" onclick="openHapus('${t.id}')">🗑️</button></div>`:''}</td>
    </tr>`).join('');
}

// STATS
function renderStats(){
  const tM=db.filter(t=>t.jenis==='masuk').reduce((s,t)=>s+t.jumlah,0);
  const tK=db.filter(t=>t.jenis==='keluar').reduce((s,t)=>s+t.jumlah,0);
  const now=new Date();
  const trx=db.filter(t=>{const d=new Date(t.tanggal);return d.getMonth()===now.getMonth()&&d.getFullYear()===now.getFullYear();}).length;
  document.getElementById('s-masuk').textContent=fmtRp(tM);
  document.getElementById('s-keluar').textContent=fmtRp(tK);
  document.getElementById('s-saldo').textContent=fmtRp(tM-tK);
  document.getElementById('s-trx').textContent=trx+' Transaksi';
  document.getElementById('s-bar').style.width=Math.min(100,(trx/Math.max(db.length,1))*100)+'%';
  const tot=tM+tK||1;
  document.getElementById('pct-in').textContent=Math.round(tM/tot*100)+'%';
  document.getElementById('pct-out').textContent=Math.round(tK/tot*100)+'%';
}

// CHARTS
let cLap,cDon,cPie;
function initCharts(){
  Chart.defaults.color='#6e8faf';
  Chart.defaults.font.family='Plus Jakarta Sans';
  cLap=new Chart(document.getElementById('cLap').getContext('2d'),{
    data:{labels:[],datasets:[
      {type:'bar',  data:[],backgroundColor:'rgba(34,197,94,.65)',borderRadius:5},
      {type:'bar',  data:[],backgroundColor:'rgba(249,115,22,.65)',borderRadius:5},
      {type:'line', data:[],borderColor:'#22c55e',pointBackgroundColor:'#22c55e',tension:.4,fill:false,pointRadius:3},
      {type:'line', data:[],borderColor:'#f97316',pointBackgroundColor:'#f97316',tension:.4,fill:false,pointRadius:3},
    ]},
    options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},
      scales:{x:{grid:{color:'rgba(30,51,84,.5)'}},y:{grid:{color:'rgba(30,51,84,.5)'},ticks:{callback:v=>'Rp '+v.toLocaleString('id-ID')}}}}
  });
  cDon=new Chart(document.getElementById('cDon').getContext('2d'),{
    type:'doughnut',
    data:{labels:['Pemasukan','Pengeluaran'],datasets:[{data:[60,40],backgroundColor:['#22c55e','#f97316'],borderWidth:0,hoverOffset:6}]},
    options:{responsive:true,maintainAspectRatio:false,cutout:'68%',plugins:{legend:{display:false}}}
  });
  cPie=new Chart(document.getElementById('cPie').getContext('2d'),{
    type:'pie',
    data:{labels:[],datasets:[{data:[],backgroundColor:['#38bdf8','#22c55e','#f97316','#ef4444','#facc15','#a78bfa'],borderWidth:0}]},
    options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}}}
  });
}

function updateCharts(){
  const months=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  const mB=Array(12).fill(0),kB=Array(12).fill(0);
  db.forEach(t=>{const m=new Date(t.tanggal).getMonth();t.jenis==='masuk'?mB[m]+=t.jumlah:kB[m]+=t.jumlah;});
  const used=[];for(let i=0;i<12;i++)if(mB[i]>0||kB[i]>0)used.push(i);
  const lbl=used.length?used.map(i=>months[i]):months.slice(0,6);
  const mD=used.length?used.map(i=>mB[i]):Array(6).fill(0);
  const kD=used.length?used.map(i=>kB[i]):Array(6).fill(0);
  cLap.data.labels=lbl;cLap.data.datasets[0].data=mD;cLap.data.datasets[1].data=kD;
  cLap.data.datasets[2].data=mD;cLap.data.datasets[3].data=kD;cLap.update();
  const tM=db.filter(t=>t.jenis==='masuk').reduce((s,t)=>s+t.jumlah,0);
  const tK=db.filter(t=>t.jenis==='keluar').reduce((s,t)=>s+t.jumlah,0);
  cDon.data.datasets[0].data=[tM||1,tK||0];cDon.update();
  const kats={};db.forEach(t=>{kats[t.kategori]=(kats[t.kategori]||0)+t.jumlah;});
  const kL=Object.keys(kats),kV=kL.map(k=>kats[k]);
  cPie.data.labels=kL;cPie.data.datasets[0].data=kV;cPie.update();
  const cols=['#38bdf8','#22c55e','#f97316','#ef4444','#facc15','#a78bfa'];
  const tot=kV.reduce((a,b)=>a+b,0)||1;
  document.getElementById('pie-leg').innerHTML=kL.map((k,i)=>`
    <div class="legend-row"><div class="legend-l"><div class="leg-dot" style="background:${cols[i%cols.length]}"></div>${k}</div>
    <span>${Math.round(kV[i]/tot*100)}%</span></div>`).join('');
  const maxA=Math.max(tM,1);
  const ops=db.filter(t=>t.kategori==='Operasional').reduce((s,t)=>s+t.jumlah,0);
  const sosial=db.filter(t=>t.kategori==='Dana Sosial').reduce((s,t)=>s+t.jumlah,0);
  const gaji=db.filter(t=>t.kategori==='Gaji & Upah').reduce((s,t)=>s+t.jumlah,0);
  document.getElementById('ang-list').innerHTML=[['Operasional',ops,'f-green'],['Dana Sosial',sosial,'f-orange'],['Gaji & Upah',gaji,'f-blue']].map(([n,v,c])=>`
    <div class="ang-item"><div class="ang-lbl"><span>${n}</span><span class="ang-pct">${Math.round(v/maxA*100)}%</span></div>
    <div class="ang-bar"><div class="ang-fill ${c}" style="width:${Math.min(100,v/maxA*100)}%"></div></div></div>`).join('');
}

// MODAL
function openOv(id){document.getElementById(id).classList.add('open');}
function closeOv(id){document.getElementById(id).classList.remove('open');}
document.querySelectorAll('.overlay').forEach(o=>o.addEventListener('click',e=>{if(e.target===o)o.classList.remove('open');}));
let editId=null,hapusId=null;

function openTambah(){
  if(!isBendahara)return;
  document.getElementById('t-tgl').value=new Date().toISOString().split('T')[0];
  document.getElementById('t-desk').value='';
  document.getElementById('t-jml').value='';
  document.querySelector('input[name="t-j"][value="masuk"]').checked=true;
  openOv('ov-t');
}
function saveTambah(){
  const t={id:uid(),tanggal:document.getElementById('t-tgl').value,deskripsi:document.getElementById('t-desk').value,
    kategori:document.getElementById('t-kat').value,jenis:document.querySelector('input[name="t-j"]:checked').value,
    jumlah:parseInt(document.getElementById('t-jml').value)||0};
  if(!t.tanggal||!t.deskripsi||t.jumlah<=0){alert('Harap isi semua field!');return;}
  db.unshift(t);saveDB();refresh();closeOv('ov-t');
}
function openEdit(id){
  if(!isBendahara)return;
  editId=id;const t=db.find(x=>x.id===id);
  document.getElementById('e-tgl').value=t.tanggal;
  document.getElementById('e-desk').value=t.deskripsi;
  document.getElementById('e-kat').value=t.kategori;
  document.querySelector(`input[name="e-j"][value="${t.jenis}"]`).checked=true;
  document.getElementById('e-jml').value=t.jumlah;
  openOv('ov-e');
}
function saveEdit(){
  const i=db.findIndex(x=>x.id===editId);if(i===-1)return;
  db[i]={...db[i],tanggal:document.getElementById('e-tgl').value,deskripsi:document.getElementById('e-desk').value,
    kategori:document.getElementById('e-kat').value,jenis:document.querySelector('input[name="e-j"]:checked').value,
    jumlah:parseInt(document.getElementById('e-jml').value)||0};
  saveDB();refresh();closeOv('ov-e');
}
function openHapus(id){
  if(!isBendahara)return;
  hapusId=id;const t=db.find(x=>x.id===id);
  document.getElementById('del-det').innerHTML=`
    <div><span class="lbl">Tanggal: </span>${fmtDate(t.tanggal)}</div>
    <div><span class="lbl">Deskripsi: </span><strong>${t.deskripsi}</strong></div>
    <div><span class="lbl">Kategori: </span>${t.kategori}</div>
    <div><span class="lbl">Jumlah: </span><strong>${fmtRp(t.jumlah)}</strong></div>`;
  openOv('ov-h');
}
function confirmHapus(){db=db.filter(x=>x.id!==hapusId);saveDB();refresh();closeOv('ov-h');}

function refresh(){renderTable();renderStats();updateCharts();}

loadDB();
document.addEventListener('DOMContentLoaded',initCharts);
if(document.readyState!=='loading')initCharts();
</script>
</body>
</html>