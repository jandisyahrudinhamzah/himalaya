{{-- resources/views/public/layouts.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'HIMAYALA — Perhimpunan Pegiat Alam dan Penempuh Rimba')</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
<style>
/* ═══════════════════════════════════════════
   GLOBAL SYSTEM — HIMAYALA PUBLIC LAYOUT
═══════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:16px}
body{
  font-family:'DM Sans',sans-serif;
  background:#09090B;
  color:#EDE8DE;
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
}
img{display:block;max-width:100%}
a{text-decoration:none;color:inherit}

::-webkit-scrollbar{width:3px}
::-webkit-scrollbar-track{background:#09090B}
::-webkit-scrollbar-thumb{background:#8B3B0A;border-radius:2px}

/* ── TOKENS ── */
:root{
  --o:    #D95B16;
  --o-hi: #F07030;
  --o-dim:#8B3B0A;
  --o-gl: rgba(217,91,22,.10);
  --o-gl2:rgba(217,91,22,.06);
  --o-ln: rgba(217,91,22,.22);
  --o-ls: rgba(217,91,22,.10);
  --ink:  #09090B;
  --ink2: #0C0C0E;
  --ink3: #101012;
  --ink4: #141416;
  --tx1:  #EDE8DE;
  --tx2:  #68625C;
  --tx3:  #2A2622;
}

/* ── TYPOGRAPHY ── */
.serif{font-family:'Cormorant Garamond',Georgia,serif}
.lbl{font-size:8px;font-weight:500;letter-spacing:.48em;text-transform:uppercase;color:var(--o)}
.gem{display:inline-block;width:4px;height:4px;background:var(--o);transform:rotate(45deg);flex-shrink:0}

/* ── ANIMATIONS ── */
@keyframes navIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:translateY(0)}}
@keyframes rise{to{opacity:1;transform:translateY(0)}}
@keyframes fadeIn{to{opacity:1}}

/* ── PAGE TRANSITIONS ── */
.rv{opacity:0;transform:translateY(20px);transition:opacity .85s cubic-bezier(.22,1,.36,1),transform .85s cubic-bezier(.22,1,.36,1)}
.rv.on{opacity:1;transform:translateY(0)}

/* ═══════════════════════════════════════════
   NAVIGATION
═══════════════════════════════════════════ */
#nav{
  position:fixed;top:0;left:0;right:0;z-index:500;
  height:64px;
  display:flex;align-items:center;justify-content:space-between;
  padding:0 52px;
  background:rgba(9,9,11,.52);
  backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
  border-bottom:1px solid rgba(255,255,255,.055);
  transition:background .5s,border-color .5s,height .4s;
  animation:navIn .7s cubic-bezier(.22,1,.36,1) both;
}
#nav.scrolled{
  background:rgba(9,9,11,.96);
  border-color:var(--o-ls);
  height:54px;
}

.nb{display:flex;align-items:center;gap:12px}
.nb-mark{
  width:36px;height:36px;
  border:1px solid var(--o-ln);
  display:flex;align-items:center;justify-content:center;
  position:relative;flex-shrink:0;
  transition:border-color .3s,box-shadow .3s;
}
.nb-mark::before{content:'';position:absolute;inset:5px;border:1px solid var(--o-ls);transition:inherit}
.nb-mark img{width:20px;height:20px;object-fit:contain;filter:saturate(.35) brightness(1.1);position:relative;z-index:1}
.nb:hover .nb-mark{border-color:var(--o);box-shadow:0 0 18px var(--o-gl)}
.nb-words{display:flex;flex-direction:column;gap:2px}
.nb-name{font-family:'Cormorant Garamond',serif;font-size:15px;font-weight:600;letter-spacing:.24em;color:#fff;line-height:1}
.nb-sub{font-size:6px;font-weight:400;letter-spacing:.22em;text-transform:uppercase;color:var(--tx2)}

.nc{position:absolute;left:50%;transform:translateX(-50%);display:flex;align-items:center}
.nl{
  font-size:10px;font-weight:400;letter-spacing:.18em;text-transform:uppercase;
  color:rgba(237,232,222,.48);padding:8px 22px;
  position:relative;transition:color .3s;
}
.nl::after{content:'';position:absolute;bottom:3px;left:50%;right:50%;height:1px;background:var(--o);transition:left .35s,right .35s}
.nl:hover,.nl.active{color:var(--o-hi)}
.nl:hover::after,.nl.active::after{left:22px;right:22px}

.nr{display:flex;align-items:center;gap:18px}
.n-login{
  font-size:10px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;
  color:rgba(237,232,222,.48);position:relative;transition:color .3s;
}
.n-login::after{content:'';position:absolute;bottom:-1px;left:0;right:100%;height:1px;background:var(--o);transition:right .35s}
.n-login:hover{color:var(--o)}
.n-login:hover::after{right:0}

.n-ham{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:8px;border:none;background:none}
.n-ham span{display:block;width:20px;height:1px;background:var(--tx1);transition:all .35s}

/* ═══════════════════════════════════════════
   MOBILE MENU
═══════════════════════════════════════════ */
#mob{
  display:none;position:fixed;inset:0;z-index:490;
  background:rgba(9,9,11,.97);backdrop-filter:blur(28px);
  flex-direction:column;align-items:center;justify-content:center;
}
#mob.open{display:flex}
.ml{
  font-family:'Cormorant Garamond',serif;
  font-size:42px;font-weight:300;letter-spacing:.04em;
  color:var(--tx1);padding:16px 0;
  border-bottom:1px solid var(--o-ls);
  width:220px;text-align:center;transition:color .3s;
}
.ml:hover{color:var(--o)}
.mx{position:absolute;top:26px;right:30px;font-size:16px;color:var(--tx2);cursor:pointer;background:none;border:none;transition:color .3s}
.mx:hover{color:var(--o)}

/* ═══════════════════════════════════════════
   PAGE HERO (inner pages)
═══════════════════════════════════════════ */
.page-hero{
  padding:120px 0 72px;
  text-align:center;
  position:relative;
  background:var(--ink2);
  border-bottom:1px solid var(--o-ls);
}
.page-hero::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 50% 100% at 50% 100%,rgba(217,91,22,.07) 0%,transparent 70%);
  pointer-events:none;
}
.ph-badge{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 16px;
  border:1px solid var(--o-ls);
  background:var(--o-gl2);
  margin-bottom:20px;
}
.ph-title{
  font-family:'Cormorant Garamond',serif;
  font-size:clamp(36px,5vw,60px);
  font-weight:300;color:#fff;
  line-height:1.02;margin-bottom:12px;
}
.ph-desc{font-size:13px;color:var(--tx2);max-width:420px;margin:0 auto;line-height:1.9}

/* ═══════════════════════════════════════════
   SHARED SECTION
═══════════════════════════════════════════ */
.sec{padding:96px 0;position:relative}
.sec-rule{position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--o-ls),transparent)}
.wrap{max-width:1220px;margin:0 auto;padding:0 60px}

/* Divider */
.divs{width:36px;height:1px;background:linear-gradient(90deg,transparent,var(--o),transparent);margin:12px auto 0}

/* ═══════════════════════════════════════════
   SHARED CARD SYSTEM
═══════════════════════════════════════════ */
.card-grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--o-ls)}
.card-grid-4{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--o-ls)}
.card-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}

/* ── CONTENT CARD (articles, activities) ── */
.ccard{
  background:var(--ink2);
  display:flex;flex-direction:column;
  overflow:hidden;
  transition:background .4s;
  position:relative;
}
.ccard:hover{background:var(--ink3)}

.ccard-img{height:224px;overflow:hidden;position:relative;flex-shrink:0}
.ccard-img img{width:100%;height:100%;object-fit:cover;filter:grayscale(20%) brightness(.76);transition:transform .7s cubic-bezier(.22,1,.36,1),filter .5s}
.ccard:hover .ccard-img img{transform:scale(1.05);filter:grayscale(0%) brightness(.88)}
.ccard-ov{position:absolute;inset:0;background:linear-gradient(180deg,transparent 36%,rgba(9,9,11,.94) 100%)}

.ccard-badge{
  position:absolute;top:12px;left:12px;z-index:2;
  font-size:7px;font-weight:500;letter-spacing:.32em;text-transform:uppercase;
  color:var(--o);background:rgba(9,9,11,.86);
  border:1px solid var(--o-ls);padding:5px 10px;
  backdrop-filter:blur(8px);
}
.ccard-date{position:absolute;bottom:14px;left:14px;z-index:2}
.ccard-day{font-family:'Cormorant Garamond',serif;font-size:36px;font-weight:300;color:#fff;line-height:1}
.ccard-mon{font-size:7.5px;letter-spacing:.30em;text-transform:uppercase;color:var(--o-hi)}

.ccard-body{padding:24px 28px 28px;display:flex;flex-direction:column;flex:1}
.ccard-title{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:300;color:var(--tx1);line-height:1.3;margin-bottom:8px;transition:color .3s}
.ccard:hover .ccard-title{color:#fff}
.ccard-desc{font-size:11.5px;color:var(--tx2);line-height:1.85;margin-bottom:20px;flex:1}
.ccard-link{
  font-size:8px;font-weight:500;letter-spacing:.24em;text-transform:uppercase;
  color:var(--o);border:1px solid var(--o-ls);
  padding:11px 0;display:flex;align-items:center;justify-content:center;gap:9px;
  transition:border-color .3s,background .3s;
}
.ccard-link:hover{border-color:var(--o);background:var(--o-gl2)}

/* Status badges */
.s-upcoming{color:#38bdf8;border-color:rgba(56,189,248,.25);background:rgba(56,189,248,.08)}
.s-ongoing{color:var(--o-hi);border-color:var(--o-ls);background:var(--o-gl2)}
.s-selesai{color:#4ade80;border-color:rgba(74,222,128,.25);background:rgba(74,222,128,.08)}

/* ═══════════════════════════════════════════
   SHARED BUTTONS
═══════════════════════════════════════════ */
@keyframes lightSweep{0%{left:-110%}100%{left:160%}}

.btn-primary{
  position:relative;overflow:hidden;
  font-family:'Cormorant Garamond',serif;
  font-size:16px;font-weight:400;font-style:italic;letter-spacing:.04em;
  color:#0c0806;
  background:linear-gradient(135deg,var(--o-hi) 0%,var(--o) 55%,var(--o-dim) 100%);
  padding:12px 36px;border-radius:2px;border:none;cursor:pointer;
  display:inline-flex;align-items:center;gap:11px;
  transition:transform .25s,box-shadow .35s;
  box-shadow:0 4px 20px rgba(217,91,22,.22);
}
.btn-primary::before{content:'';position:absolute;top:0;left:-110%;width:52%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.16),transparent)}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(217,91,22,.34)}
.btn-primary:hover::before{animation:lightSweep .6s ease forwards}

.btn-ghost{
  font-size:9px;font-weight:400;letter-spacing:.24em;text-transform:uppercase;
  color:rgba(237,232,222,.58);
  border:1px solid rgba(237,232,222,.14);
  padding:12px 28px;border-radius:2px;
  display:inline-flex;align-items:center;gap:9px;
  transition:border-color .3s,color .3s,background .3s,transform .25s;
}
.btn-ghost:hover{border-color:var(--o-ln);color:var(--o-hi);background:var(--o-gl2);transform:translateY(-1px)}

.btn-outline{
  font-size:9px;font-weight:500;letter-spacing:.24em;text-transform:uppercase;
  color:var(--o);border:1px solid var(--o-ls);
  padding:11px 28px;border-radius:2px;
  display:inline-flex;align-items:center;gap:9px;
  transition:border-color .3s,background .3s;
}
.btn-outline:hover{border-color:var(--o);background:var(--o-gl2)}

/* ═══════════════════════════════════════════
   PAGINATION
═══════════════════════════════════════════ */
.pager{display:flex;justify-content:center;align-items:center;gap:4px;margin-top:64px}
.pager a,.pager span{
  display:flex;align-items:center;justify-content:center;
  width:38px;height:38px;
  font-size:11px;font-weight:500;letter-spacing:.08em;
  border:1px solid var(--o-ls);
  color:var(--tx2);
  transition:border-color .3s,color .3s,background .3s;
}
.pager a:hover{border-color:var(--o-ln);color:var(--o);background:var(--o-gl2)}
.pager .pg-active{background:var(--o);border-color:var(--o);color:var(--ink)}
.pager .pg-dis{opacity:.3;cursor:not-allowed;pointer-events:none}
.pager-dots{border:none;color:var(--tx2);pointer-events:none}

/* ═══════════════════════════════════════════
   BACK BUTTON
═══════════════════════════════════════════ */
.back-btn{
  display:inline-flex;align-items:center;gap:8px;
  font-size:9px;font-weight:500;letter-spacing:.2em;text-transform:uppercase;
  color:var(--tx2);
  border:1px solid var(--o-ls);
  padding:10px 20px;border-radius:2px;
  margin-bottom:40px;
  transition:color .3s,border-color .3s,background .3s;
}
.back-btn:hover{color:var(--o);border-color:var(--o-ln);background:var(--o-gl2)}

/* ═══════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════ */
.empty-st{
  grid-column:1/-1;
  padding:80px 40px;text-align:center;
  background:var(--ink);
}
.empty-st-icon{
  font-family:'Cormorant Garamond',serif;
  font-size:52px;font-weight:300;
  color:var(--o-ls);margin-bottom:12px;display:block;
}

/* ═══════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════ */
.ft{background:var(--ink2);border-top:1px solid var(--o-ls)}
.ft-top{padding:72px 0 56px;display:grid;grid-template-columns:2.2fr 1fr 1fr;gap:60px}
.ft-name{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:300;letter-spacing:.22em;color:#fff;display:block;margin-bottom:4px}
.ft-sub{font-size:6.5px;letter-spacing:.26em;text-transform:uppercase;color:var(--tx2);display:block;margin-bottom:16px}
.ft-p{font-size:12px;color:var(--tx2);line-height:1.9;max-width:250px;margin-bottom:22px}
.socials{display:flex;gap:7px}
.si{width:32px;height:32px;border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;color:var(--tx2);font-size:10px;transition:border-color .3s,color .3s,background .3s}
.si:hover{border-color:var(--o);color:var(--o);background:var(--o-gl2)}
.fc h4{font-size:7.5px;font-weight:500;letter-spacing:.38em;text-transform:uppercase;color:var(--o);margin-bottom:22px;display:flex;align-items:center;gap:9px}
.fc h4::after{content:'';flex:1;height:1px;background:var(--o-ls)}
.fc ul{list-style:none;display:flex;flex-direction:column;gap:10px}
.fc li a{font-size:11.5px;color:var(--tx2);display:flex;align-items:center;gap:8px;transition:color .3s}
.fc li a:hover{color:var(--o)}
.fci{display:flex;gap:12px;align-items:flex-start;margin-bottom:12px}
.fico{width:14px;flex-shrink:0;color:var(--o-dim);font-size:10px;padding-top:2px}
.fctx{font-size:11px;color:var(--tx2);line-height:1.75}
.ft-bt{border-top:1px solid var(--o-ls);padding:18px 0;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
.ft-copy{font-size:9.5px;color:var(--tx3);letter-spacing:.1em}
.ft-motto{display:flex;align-items:center;gap:10px;font-size:8.5px;letter-spacing:.26em;text-transform:uppercase;color:var(--tx3)}
.ft-leg{display:flex;gap:16px}
.ft-leg a{font-size:9.5px;color:var(--tx3);transition:color .3s}
.ft-leg a:hover{color:var(--o)}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media(max-width:1080px){
  .wrap{padding:0 36px}
  #nav{padding:0 28px}
  .nc{display:none}
  .n-ham{display:flex}
  .n-login{display:none}
  .card-grid-3,.card-grid-4{grid-template-columns:1fr 1fr}
  .ft-top{grid-template-columns:1fr 1fr;gap:40px}
  .ft-brand{grid-column:1/-1}
}
@media(max-width:640px){
  .wrap{padding:0 20px}
  #nav{padding:0 20px;height:56px}
  #nav.scrolled{height:48px}
  .sec{padding:64px 0}
  .card-grid-3,.card-grid-4,.card-grid-2{grid-template-columns:1fr}
  .ft-top{grid-template-columns:1fr;gap:32px}
  .ft-bt{flex-direction:column;text-align:center;gap:10px}
  .pager a,.pager span{width:32px;height:32px;font-size:10px}
}
</style>
@stack('styles')
</head>
<body>

<div id="mob">
  <button class="mx" onclick="mob()"><i class="fas fa-times"></i></button>
  <a class="ml" href="{{ route('public.home') }}"       onclick="mob()">Beranda</a>
  <a class="ml" href="{{ route('public.articles') }}"   onclick="mob()">Artikel</a>
  <a class="ml" href="{{ route('public.gallery') }}"    onclick="mob()">Galeri</a>
  <a class="ml" href="{{ route('public.activities') }}" onclick="mob()">Kegiatan</a>
  <a class="ml" href="{{ route('public.members') }}"    onclick="mob()">Anggota</a>
</div>

<nav id="nav">
  <a href="{{ route('public.home') }}" class="nb">
    <div class="nb-mark">
      <img src="{{ asset('image/himalaya1.jpeg') }}" alt="Logo HIMAYALA">
    </div>
    <div class="nb-words">
      <span class="nb-name">HIMAYALA</span>
      <span class="nb-sub">Perhimpunan Pegiat Alam · Yayasan Fatahillah</span>
    </div>
  </a>

  <div class="nc">
    <a href="{{ route('public.home') }}"       class="nl @if(request()->routeIs('public.home')) active @endif">Beranda</a>
    <a href="{{ route('public.articles') }}"   class="nl @if(request()->routeIs('public.articles*')) active @endif">Artikel</a>
    <a href="{{ route('public.gallery') }}"    class="nl @if(request()->routeIs('public.gallery*')) active @endif">Galeri</a>
    <a href="{{ route('public.activities') }}" class="nl @if(request()->routeIs('public.activities*')) active @endif">Kegiatan</a>
    <a href="{{ route('public.members') }}"    class="nl @if(request()->routeIs('public.members')) active @endif">Anggota</a>
  </div>

  <div class="nr">
    <a href="{{ route('login') }}" class="n-login">Login</a>
    <button class="n-ham" onclick="mob()" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<main style="padding-top:64px">
  @yield('content')
</main>

<footer class="ft">
  <div class="wrap">
    <div class="ft-top">
      <div class="ft-brand">
        <span class="ft-name">HIMAYALA</span>
        <span class="ft-sub">Perhimpunan Pegiat Alam dan Penempuh Rimba · Yayasan Fatahillah</span>
        <p class="ft-p">Organisasi penempuh rimba yang berdedikasi membentuk jiwa kepemimpinan, ketangguhan, dan kepedulian mendalam terhadap alam dan sesama.</p>
        <div class="socials">
          <a href="https://facebook.com/" target="_blank" class="si"><i class="fab fa-facebook-f"></i></a>
          <a href="https://instagram.com/himalayafatahillah_" target="_blank" class="si"><i class="fab fa-instagram"></i></a>
          <a href="https://twitter.com/" target="_blank" class="si"><i class="fab fa-twitter"></i></a>
          <a href="https://youtube.com/" target="_blank" class="si"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="fc">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="{{ route('public.home') }}"><span class="gem" style="width:3px;height:3px;"></span>Beranda</a></li>
          <li><a href="{{ route('public.articles') }}"><span class="gem" style="width:3px;height:3px;"></span>Artikel</a></li>
          <li><a href="{{ route('public.gallery') }}"><span class="gem" style="width:3px;height:3px;"></span>Galeri</a></li>
          <li><a href="{{ route('public.activities') }}"><span class="gem" style="width:3px;height:3px;"></span>Kegiatan</a></li>
          <li><a href="{{ route('public.members') }}"><span class="gem" style="width:3px;height:3px;"></span>Anggota</a></li>
        </ul>
      </div>
      <div class="fc">
        <h4>Kontak</h4>
        <div class="fci"><div class="fico"><i class="fas fa-map-marker-alt"></i></div><div class="fctx">Kp. Tengah Ds Cipeucang Rt 006/003<br>Cileungsi, Kab. Bogor, Jawa Barat</div></div>
        <div class="fci"><div class="fico"><i class="fas fa-phone"></i></div><div class="fctx">+62 882-8973-8661</div></div>
        <div class="fci"><div class="fico"><i class="fas fa-envelope"></i></div><div class="fctx">himalaya@himalaya.com</div></div>
      </div>
    </div>
    <div class="ft-bt">
      <span class="ft-copy">© {{ date('Y') }} HIMAYALA — All Rights Reserved</span>
      <div class="ft-motto"><span class="gem" style="width:3px;height:3px;"></span>Jujur · Disiplin · Tanggung Jawab<span class="gem" style="width:3px;height:3px;"></span></div>
      <div class="ft-leg"><a href="#">Privacy Policy</a><a href="#">Terms of Service</a></div>
    </div>
  </div>
</footer>

<script>
function mob(){
  const m=document.getElementById('mob');
  m.classList.toggle('open');
  document.body.style.overflow=m.classList.contains('open')?'hidden':'';
}
const nav=document.getElementById('nav');
window.addEventListener('scroll',()=>{nav.classList.toggle('scrolled',window.scrollY>60);},{passive:true});
const io=new IntersectionObserver(e=>{e.forEach(x=>{if(x.isIntersecting){x.target.classList.add('on');io.unobserve(x.target);}});},{threshold:.07,rootMargin:'0px 0px -24px 0px'});
document.querySelectorAll('.rv').forEach(el=>io.observe(el));
</script>
@stack('scripts')
</body>
</html>