
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HIMAYALA - Perhimpunan Pegiat Alam Dan Penempuh Rimba Yayasan Fatahillah</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"/>
<style>
/* ════════════════════════════════════════
   DESIGN TOKENS
════════════════════════════════════════ */
:root{
  --or:#f97316;--or2:#ea580c;--gold:#fbbf24;--gold2:#d97706;
  --ink:#05050a;--ink2:#08080f;--ink3:#0e0e18;--ink4:#141422;
  --glass:rgba(255,255,255,0.03);
  --glass2:rgba(255,255,255,0.055);
  --glass3:rgba(255,255,255,0.09);
  --o-ls:rgba(249,115,22,0.14);
  --o-gl:rgba(249,115,22,0.08);
  --o-gl2:rgba(249,115,22,0.13);
  --o-dim:rgba(249,115,22,0.45);
  --w-ls:rgba(255,255,255,0.07);
  --w-ls2:rgba(255,255,255,0.12);
  --tx1:#f0f0f8;--tx2:#8b8ba8;--tx3:#4a4a62;
  --r-sm:10px;--r-md:16px;--r-lg:22px;--r-xl:28px;--r-2xl:36px;
  --shadow-card:0 8px 32px rgba(0,0,0,0.45),0 1px 0 rgba(255,255,255,0.04) inset;
  --shadow-hover:0 24px 64px rgba(0,0,0,0.6),0 1px 0 rgba(255,255,255,0.06) inset;
  --shadow-or:0 20px 60px rgba(249,115,22,0.18);
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{
  font-family:'Plus Jakarta Sans',sans-serif;
  background:var(--ink);color:var(--tx1);
  overflow-x:hidden;
  background-image:
    radial-gradient(ellipse 80vw 60vh at 20% 0%,rgba(249,115,22,0.04),transparent),
    radial-gradient(ellipse 60vw 80vh at 80% 100%,rgba(234,88,12,0.03),transparent);
}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:#000}
::-webkit-scrollbar-thumb{background:#1a1a2e;border-radius:3px}
::-webkit-scrollbar-thumb:hover{background:var(--or)}

/* ════════════════════════════════════════
   HERO (UNCHANGED)
════════════════════════════════════════ */
.text-gradient{background:linear-gradient(135deg,#fb923c,#f97316);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* ════════════════════════════════════════
   LAYOUT
════════════════════════════════════════ */
.wrap{max-width:1180px;margin:0 auto;padding:0 24px;position:relative;z-index:2}
.sec{padding:110px 0;position:relative;overflow:hidden}
.sec-a{background:var(--ink)}
.sec-b{background:var(--ink2)}

/* ════════════════════════════════════════
   FADE-UP
════════════════════════════════════════ */
.fu{opacity:0;transform:translateY(40px);transition:opacity .75s cubic-bezier(.22,1,.36,1),transform .75s cubic-bezier(.22,1,.36,1)}
.fu.vis{opacity:1;transform:translateY(0)}

/* ════════════════════════════════════════
   SECTION LABELS
════════════════════════════════════════ */
.eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 14px;
  background:var(--o-gl);border:1px solid var(--o-ls);border-radius:100px;
  font-size:9.5px;font-weight:800;color:var(--or);
  letter-spacing:.18em;text-transform:uppercase;margin-bottom:16px;
}
.eyebrow i{font-size:9px}
.display{font-size:clamp(2rem,4.5vw,3.2rem);font-weight:900;line-height:1.06;letter-spacing:-.02em;margin-bottom:14px}
.accent{background:linear-gradient(135deg,#f97316 20%,#fbbf24 80%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.lead{font-size:15px;color:var(--tx2);line-height:1.8;max-width:520px}
.hl{height:1px;background:linear-gradient(90deg,transparent,var(--w-ls),transparent)}

/* ════════════════════════════════════════
   TICKER
════════════════════════════════════════ */
.ticker-shell{
  background:rgba(5,5,15,0.7);backdrop-filter:blur(20px);
  border-top:1px solid var(--o-ls);border-bottom:1px solid var(--o-ls);
  padding:12px 0;overflow:hidden;position:relative;
}
.ticker-shell::before,.ticker-shell::after{content:'';position:absolute;top:0;width:120px;height:100%;z-index:2;pointer-events:none}
.ticker-shell::before{left:0;background:linear-gradient(to right,var(--ink),transparent)}
.ticker-shell::after{right:0;background:linear-gradient(to left,var(--ink),transparent)}
.ticker-pill{
  position:absolute;left:0;top:0;height:100%;
  display:flex;align-items:center;padding:0 20px;
  background:linear-gradient(135deg,#f97316,#ea580c);
  z-index:3;font-size:9px;font-weight:900;letter-spacing:.2em;text-transform:uppercase;white-space:nowrap;
}
.ticker-pill i{margin-right:7px}
.ticker-track{display:flex;gap:0;width:max-content;animation:ticker 34s linear infinite}
.ticker-track:hover{animation-play-state:paused}
@keyframes ticker{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.t-item{display:flex;align-items:center;gap:10px;padding:0 30px;white-space:nowrap;border-right:1px solid var(--w-ls);text-decoration:none}
.t-item img{width:24px;height:24px;object-fit:cover;border-radius:6px;border:1px solid var(--w-ls)}
.t-item span{font-size:12.5px;font-weight:500;color:var(--tx2)}
.t-dot{width:3px;height:3px;border-radius:50%;background:var(--or);flex-shrink:0}

/* ════════════════════════════════════════
   STRUKTUR — BENTO GRID
════════════════════════════════════════ */
.bento{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-top:56px}
.sk-card{
  position:relative;background:var(--glass2);border:1px solid var(--w-ls);
  border-radius:var(--r-xl);padding:32px 20px 24px;
  text-align:center;cursor:default;overflow:hidden;
  transition:transform .45s cubic-bezier(.22,1,.36,1),border-color .45s,box-shadow .45s;
  box-shadow:var(--shadow-card);
}
.sk-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,var(--o-gl2) 0%,transparent 60%);opacity:0;transition:.5s}
.sk-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--or),var(--gold));opacity:0;transition:.4s}
.sk-card:hover{transform:translateY(-10px) scale(1.01);border-color:var(--o-ls);box-shadow:var(--shadow-hover),var(--shadow-or)}
.sk-card:hover::before{opacity:1}
.sk-card:hover::after{opacity:1}
.sk-card:hover .sk-av,.sk-card:hover .sk-init{border-color:rgba(249,115,22,0.5);transform:scale(1.07)}
.sk-av{width:72px;height:72px;border-radius:16px;object-fit:cover;margin:0 auto 16px;display:block;border:2px solid var(--w-ls);transition:.4s}
.sk-init{width:72px;height:72px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:2px solid var(--w-ls);font-size:22px;font-weight:900;transition:.4s}
.sk-role{font-size:9px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--or);margin-bottom:6px}
.sk-name{font-size:14px;font-weight:700;color:var(--tx1);line-height:1.3}
.sk-badge{display:inline-flex;align-items:center;gap:5px;margin-top:12px;padding:3px 10px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);border-radius:100px;font-size:9px;color:#4ade80}
.sk-badge .pulse{width:5px;height:5px;border-radius:50%;background:#22c55e;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;box-shadow:0 0 0 0 rgba(34,197,94,.4)}60%{opacity:.7;box-shadow:0 0 0 5px rgba(34,197,94,0)}}

/* ════════════════════════════════════════
   ABOUT — SPLIT CINEMATIC
════════════════════════════════════════ */
.about-split{display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:start}
@media(max-width:860px){.about-split{grid-template-columns:1fr;gap:40px}}

.map-card{border-radius:var(--r-xl);overflow:hidden;border:1px solid var(--o-ls);box-shadow:var(--shadow-card)}
.map-topbar{display:flex;align-items:center;justify-content:space-between;padding:13px 18px;background:rgba(5,5,15,0.8);backdrop-filter:blur(16px);border-bottom:1px solid var(--w-ls)}
.live-chip{display:flex;align-items:center;gap:7px}
.live-dot{width:6px;height:6px;border-radius:50%;background:#22c55e;animation:pulse 1.8s infinite}
.map-label{font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--tx2)}
.map-coord-pill{font-size:9.5px;font-family:monospace;color:var(--or);background:var(--o-gl);border:1px solid var(--o-ls);padding:3px 9px;border-radius:7px}
#map{height:310px;width:100%}
.leaflet-container{background:#06080a}
.leaflet-control-zoom a{background:var(--ink4)!important;color:var(--tx1)!important;border-color:var(--w-ls)!important;font-size:14px!important}
.leaflet-control-zoom a:hover{background:var(--or)!important;color:#fff!important;border-color:var(--or)!important}
.leaflet-control-attribution{background:rgba(0,0,0,0.65)!important;color:var(--tx3)!important;font-size:9px!important}
.leaflet-control-attribution a{color:var(--tx3)!important}
.map-btmbar{display:flex;align-items:center;justify-content:space-between;padding:10px 18px;background:rgba(5,5,15,0.7);border-top:1px solid var(--w-ls)}
.mono-sm{font-size:10px;font-family:monospace;color:var(--tx3)}
.elev-tag{font-size:10px;font-weight:700;color:var(--gold)}

.compass-strip{
  display:flex;align-items:center;gap:16px;
  background:var(--glass2);border:1px solid var(--w-ls);
  border-radius:var(--r-lg);padding:14px 18px;margin-top:14px;
  box-shadow:var(--shadow-card);
}
.cmp{position:relative;width:60px;height:60px;flex-shrink:0}
.cmp-ring{position:absolute;inset:0;border-radius:50%;border:1.5px solid var(--o-ls);animation:spin 30s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.cmp-body{position:absolute;inset:8px;border-radius:50%;background:radial-gradient(circle at 38% 32%,#1a1a2e,#050508);border:1px solid var(--w-ls2);overflow:hidden;display:flex;align-items:center;justify-content:center}
.nd-n{position:absolute;bottom:50%;left:50%;margin-left:-1.5px;width:3px;height:16px;background:#ef4444;clip-path:polygon(50% 0%,0% 100%,100% 100%);transform-origin:bottom center;animation:sway 5.5s ease-in-out infinite}
.nd-s{position:absolute;top:50%;left:50%;margin-left:-1.5px;width:3px;height:12px;background:#475569;clip-path:polygon(50% 100%,0% 0%,100% 0%);transform-origin:top center;animation:sway 5.5s ease-in-out infinite}
@keyframes sway{0%,100%{transform:rotate(-5deg)}45%{transform:rotate(4deg)}72%{transform:rotate(-2deg)}}
.crd{position:absolute;font-size:7px;font-weight:900}
.crd.n{top:1px;left:50%;transform:translateX(-50%);color:var(--gold)}
.crd.s{bottom:1px;left:50%;transform:translateX(-50%);color:var(--tx3)}
.crd.e{right:2px;top:50%;transform:translateY(-50%);color:var(--tx2)}
.crd.w{left:2px;top:50%;transform:translateY(-50%);color:var(--tx2)}
.cmp-dot{position:absolute;width:6px;height:6px;border-radius:50%;background:var(--or);top:50%;left:50%;transform:translate(-50%,-50%);z-index:3}
.cmp-info{flex:1}
.cmp-title{font-size:9px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:var(--tx3);margin-bottom:4px}
.cmp-coords{font-size:12px;font-family:monospace;color:var(--tx1);font-weight:600;margin-bottom:3px}
.cmp-place{font-size:11px;color:var(--or);font-weight:600}

.about-sub{font-size:12px;font-weight:700;color:var(--or);letter-spacing:.1em;text-transform:uppercase;margin-bottom:16px}
.body-text{font-size:14px;color:var(--tx2);line-height:1.9;margin-bottom:14px}
.body-text strong{color:var(--tx1);font-weight:700}

.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin:22px 0}
.stat-tile{
  background:var(--glass);border:1px solid var(--w-ls);border-radius:var(--r-md);
  padding:18px 10px;text-align:center;cursor:default;
  position:relative;overflow:hidden;
  transition:border-color .3s,background .3s;
  box-shadow:var(--shadow-card);
}
.stat-tile::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--or),var(--gold));opacity:0;transition:.3s}
.stat-tile:hover{border-color:var(--o-ls);background:var(--glass2)}
.stat-tile:hover::after{opacity:1}
.stat-n{font-size:20px;font-weight:900;background:linear-gradient(135deg,#f97316,#fbbf24);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.stat-l{font-size:9px;color:var(--tx3);margin-top:3px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}

.philo{background:var(--glass);border:1px solid var(--w-ls);border-radius:var(--r-lg);padding:20px;margin:20px 0;box-shadow:var(--shadow-card)}
.philo-head{font-size:9px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--tx3);margin-bottom:14px;display:flex;align-items:center;gap:8px}
.philo-head::after{content:'';flex:1;height:1px;background:var(--w-ls)}
.phi-row{display:flex;align-items:center;gap:12px;padding:9px 0;border-bottom:1px solid var(--w-ls)}
.phi-row:last-child{border-bottom:none;padding-bottom:0}
.phi-icon{width:30px;height:30px;border-radius:9px;background:var(--o-gl);border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:13px}
.phi-text{font-size:13px;color:var(--tx2);font-weight:500}
.phi-n{margin-left:auto;font-size:9px;font-weight:900;color:var(--or);opacity:.35}

.tagrow{display:flex;flex-wrap:wrap;gap:8px}
.tag{display:flex;align-items:center;gap:6px;padding:7px 13px;background:var(--glass);border:1px solid var(--w-ls);border-radius:10px;font-size:11.5px;color:var(--tx2);font-weight:500;cursor:default;transition:.3s}
.tag:hover{border-color:var(--o-ls);color:var(--tx1);background:var(--glass2)}

/* ════════════════════════════════════════
   TUJUAN — CARD BENTO
════════════════════════════════════════ */
.tujuan-bento{display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:18px;margin-top:52px}
.tj{
  background:var(--glass2);border:1px solid var(--w-ls);border-radius:var(--r-xl);
  padding:36px 28px;position:relative;overflow:hidden;cursor:default;
  box-shadow:var(--shadow-card);
  transition:transform .45s cubic-bezier(.22,1,.36,1),border-color .45s,box-shadow .45s;
}
.tj:hover{transform:translateY(-9px);border-color:var(--o-ls);box-shadow:var(--shadow-hover)}
.tj::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,var(--or),var(--gold));opacity:0;transition:.4s}
.tj:hover::after{opacity:1}
.tj:hover .tj-ico{background:var(--o-gl2);transform:scale(1.1)}
.tj-ico{width:52px;height:52px;border-radius:14px;background:var(--o-gl);border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;margin-bottom:22px;transition:.4s}
.tj-ico i{font-size:20px;color:var(--or)}
.tj-ghost{position:absolute;top:20px;right:20px;font-size:58px;font-weight:900;color:rgba(255,255,255,0.025);line-height:1;pointer-events:none;font-family:'Cormorant Garamond',serif}
.tj-h{font-size:18px;font-weight:800;color:var(--tx1);margin-bottom:9px;letter-spacing:-.01em}
.tj-p{font-size:13px;color:var(--tx2);line-height:1.75}

/* ════════════════════════════════════════
   KEGIATAN — CINEMATIC CARDS
════════════════════════════════════════ */
.keg-flex{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:48px;flex-wrap:wrap}
.see-all{display:flex;align-items:center;gap:7px;color:var(--or);font-size:12px;font-weight:700;text-decoration:none;transition:.3s;white-space:nowrap}
.see-all:hover{gap:12px;color:var(--gold)}
.keg-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:22px}
.keg-card{
  background:var(--glass2);border:1px solid var(--w-ls);border-radius:var(--r-xl);
  overflow:hidden;display:flex;flex-direction:column;
  box-shadow:var(--shadow-card);
  transition:transform .45s cubic-bezier(.22,1,.36,1),border-color .45s,box-shadow .45s;
}
.keg-card:hover{transform:translateY(-10px);border-color:var(--o-ls);box-shadow:var(--shadow-hover)}
.keg-thumb{height:215px;position:relative;overflow:hidden}
.keg-thumb img{width:100%;height:100%;object-fit:cover;transition:transform .7s ease;filter:brightness(.92)}
.keg-card:hover .keg-thumb img{transform:scale(1.07);filter:brightness(1)}
.keg-ph{height:100%;background:var(--ink4);display:flex;align-items:center;justify-content:center}
.keg-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(5,5,15,.9) 0%,transparent 55%)}
.keg-meta{position:absolute;bottom:0;left:0;right:0;padding:16px;display:flex;align-items:flex-end;justify-content:space-between}
.keg-date{display:flex;align-items:center;gap:6px;font-size:10.5px;color:rgba(255,255,255,.75);font-weight:500}
.keg-status{padding:4px 11px;border-radius:100px;font-size:9.5px;font-weight:800;letter-spacing:.07em;backdrop-filter:blur(12px)}
.s-up{background:rgba(249,115,22,.18);color:#fb923c;border:1px solid rgba(249,115,22,.28)}
.s-on{background:rgba(34,197,94,.18);color:#4ade80;border:1px solid rgba(34,197,94,.28)}
.s-dn{background:rgba(148,163,184,.12);color:#94a3b8;border:1px solid rgba(148,163,184,.18)}
.keg-body{padding:22px;flex:1;display:flex;flex-direction:column}
.keg-h{font-size:17px;font-weight:800;color:var(--tx1);margin-bottom:8px;line-height:1.4;letter-spacing:-.01em}
.keg-p{font-size:12.5px;color:var(--tx2);line-height:1.7;margin-bottom:auto}
.keg-btn{display:flex;align-items:center;justify-content:center;gap:7px;margin-top:18px;padding:11px;background:var(--glass);border:1px solid var(--w-ls);border-radius:11px;font-size:12.5px;font-weight:700;color:var(--tx2);text-decoration:none;transition:.3s}
.keg-btn:hover{background:var(--or);border-color:var(--or);color:#fff}
.empty-state{grid-column:1/-1;text-align:center;padding:64px 24px;background:var(--glass);border:1px dashed var(--w-ls);border-radius:var(--r-xl)}
.empty-state i{font-size:32px;color:var(--tx3);margin-bottom:12px;display:block}
.empty-state p{font-size:14px;font-weight:700;color:var(--tx1);margin-bottom:5px}
.empty-state span{font-size:12px;color:var(--tx3)}

/* ════════════════════════════════════════
   GALERI CTA — CINEMATIC BANNER
════════════════════════════════════════ */
.cta-banner{
  position:relative;background:var(--glass2);border:1px solid var(--w-ls);
  border-radius:var(--r-2xl);padding:80px 48px;text-align:center;overflow:hidden;
  box-shadow:var(--shadow-card);
}
.cta-banner::before{content:'';position:absolute;top:-100px;left:50%;transform:translateX(-50%);width:600px;height:350px;background:radial-gradient(ellipse,rgba(249,115,22,0.1),transparent 70%);pointer-events:none}
.cta-banner::after{content:'';position:absolute;inset:0;border-radius:var(--r-2xl);background:linear-gradient(135deg,rgba(249,115,22,0.04) 0%,transparent 50%,rgba(249,115,22,0.02) 100%);pointer-events:none}
.cta-ico{width:68px;height:68px;border-radius:18px;background:var(--o-gl);border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;margin:0 auto 26px;position:relative;z-index:1}
.cta-ico i{font-size:26px;color:var(--or)}
.cta-title{font-size:clamp(1.8rem,3.5vw,2.8rem);font-weight:900;letter-spacing:-.02em;margin-bottom:12px;position:relative;z-index:1}
.cta-desc{font-size:15px;color:var(--tx2);max-width:400px;margin:0 auto 36px;line-height:1.7;position:relative;z-index:1}
.btn-row{display:flex;align-items:center;justify-content:center;flex-wrap:wrap;gap:10px;position:relative;z-index:1}
.btn-fire{display:inline-flex;align-items:center;gap:9px;padding:14px 34px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:12px;font-size:14px;font-weight:800;color:#fff;text-decoration:none;transition:.3s}
.btn-fire:hover{transform:translateY(-3px);box-shadow:0 20px 50px rgba(249,115,22,0.35)}
.btn-ghost{display:inline-flex;align-items:center;gap:9px;padding:14px 32px;background:transparent;border:1px solid var(--w-ls2);border-radius:12px;font-size:14px;font-weight:700;color:var(--tx2);text-decoration:none;transition:.3s}
.btn-ghost:hover{border-color:var(--o-ls);color:var(--or)}
@media(max-width:480px){.cta-banner{padding:52px 24px}.btn-ghost{display:none}}

/* ════════════════════════════════════════
   ARTIKEL — CARD GRID
════════════════════════════════════════ */
.art-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:20px;margin-top:52px}
.art-card{
  background:var(--glass2);border:1px solid var(--w-ls);border-radius:var(--r-xl);
  overflow:hidden;text-decoration:none;
  box-shadow:var(--shadow-card);
  transition:transform .45s cubic-bezier(.22,1,.36,1),border-color .45s,box-shadow .45s;
  display:flex;flex-direction:column;
}
.art-card:hover{transform:translateY(-8px);border-color:var(--o-ls);box-shadow:var(--shadow-hover)}
.art-thumb{height:195px;overflow:hidden;position:relative}
.art-thumb img{width:100%;height:100%;object-fit:cover;transition:transform .65s;filter:brightness(.9)}
.art-card:hover .art-thumb img{transform:scale(1.06);filter:brightness(1)}
.art-ph{height:100%;background:var(--ink4);display:flex;align-items:center;justify-content:center}
.art-body{padding:22px;flex:1}
.art-pill{display:inline-block;padding:3px 10px;background:var(--o-gl);border-radius:100px;font-size:9.5px;font-weight:800;color:var(--or);letter-spacing:.1em;text-transform:uppercase;margin-bottom:10px}
.art-h{font-size:15.5px;font-weight:800;color:var(--tx1);margin-bottom:10px;line-height:1.45;letter-spacing:-.01em}
.art-foot{display:flex;align-items:center;gap:8px;font-size:10.5px;color:var(--tx3)}

/* ════════════════════════════════════════
   FOOTER — PREMIUM DARK
════════════════════════════════════════ */
.ft-border-top{
  height:1px;
  background:linear-gradient(90deg,transparent 0%,rgba(249,115,22,0.12) 15%,rgba(249,115,22,0.55) 50%,rgba(249,115,22,0.12) 85%,transparent 100%);
  position:relative;
}
.ft-border-top::after{
  content:'';position:absolute;top:-5px;left:50%;transform:translateX(-50%);
  width:220px;height:10px;
  background:radial-gradient(ellipse,rgba(249,115,22,0.28),transparent 70%);
}
footer{background:var(--ink2);position:relative;overflow:hidden}
footer::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background-image:linear-gradient(rgba(249,115,22,0.018) 1px,transparent 1px),linear-gradient(90deg,rgba(249,115,22,0.018) 1px,transparent 1px);
  background-size:64px 64px;
}
.ft-glow-a{position:absolute;top:-60px;left:-80px;width:380px;height:280px;background:radial-gradient(ellipse,rgba(249,115,22,0.06),transparent 70%);pointer-events:none}
.ft-glow-b{position:absolute;bottom:-40px;right:-60px;width:320px;height:240px;background:radial-gradient(ellipse,rgba(234,88,12,0.045),transparent 70%);pointer-events:none}
.ft-main{display:grid;grid-template-columns:2fr 1fr 1fr 1.4fr;gap:56px;padding:68px 0 52px;position:relative;z-index:1}
@media(max-width:1000px){.ft-main{grid-template-columns:1fr 1fr;gap:36px;padding:52px 0 40px}}
@media(max-width:560px){.ft-main{grid-template-columns:1fr;gap:30px;padding:44px 0 32px}}

.ft-logo{display:flex;align-items:center;gap:13px;margin-bottom:18px}
.ft-icon{width:46px;height:46px;border-radius:13px;flex-shrink:0;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;border:1px solid rgba(249,115,22,0.3)}
.ft-icon i{color:#fff;font-size:18px}
.ft-brand-name{font-size:20px;font-weight:900;color:var(--tx1);letter-spacing:-.02em}
.ft-brand-sub{font-size:8.5px;color:var(--tx3);letter-spacing:.12em;text-transform:uppercase;margin-top:2px}
.ft-desc{font-size:12.5px;color:var(--tx3);line-height:1.9;margin-bottom:24px;max-width:255px}

.soc-row{display:flex;gap:9px;flex-wrap:wrap}
.soc{width:36px;height:36px;border-radius:10px;background:var(--glass2);border:1px solid var(--w-ls);display:flex;align-items:center;justify-content:center;color:var(--tx2);font-size:13px;text-decoration:none;transition:transform .3s,background .3s,border-color .3s,color .3s}
.soc:hover{transform:translateY(-3px)}
.soc.ig:hover{background:linear-gradient(135deg,#833ab4,#fd1d1d,#fcb045);border-color:transparent;color:#fff}
.soc.fb:hover{background:#1877f2;border-color:transparent;color:#fff}
.soc.yt:hover{background:#ff0000;border-color:transparent;color:#fff}
.soc.tt:hover{background:#111;border-color:#333;color:#fff}
.soc.tw:hover{background:#1da1f2;border-color:transparent;color:#fff}

.ft-col-h{font-size:9.5px;font-weight:800;letter-spacing:.2em;text-transform:uppercase;color:var(--tx1);margin-bottom:20px;display:flex;align-items:center;gap:9px}
.ft-col-h::after{content:'';flex:1;height:1px;background:linear-gradient(90deg,var(--o-ls),transparent)}
.ft-links{list-style:none;display:flex;flex-direction:column;gap:10px}
.ft-links a{text-decoration:none;color:var(--tx3);font-size:12.5px;font-weight:500;display:flex;align-items:center;gap:8px;transition:.28s}
.ft-links a .ldot{width:3px;height:3px;border-radius:50%;background:var(--or);opacity:0;flex-shrink:0;transition:.28s}
.ft-links a:hover{color:var(--tx1);padding-left:5px}
.ft-links a:hover .ldot{opacity:1}

.ft-citem{display:flex;align-items:flex-start;gap:11px;margin-bottom:13px}
.ft-cico{width:30px;height:30px;border-radius:8px;flex-shrink:0;background:var(--o-gl);border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;margin-top:1px}
.ft-cico i{color:var(--or);font-size:11px}
.ft-ctxt{font-size:11.5px;color:var(--tx3);line-height:1.75}

.ft-div{position:relative;height:1px;background:linear-gradient(90deg,transparent,var(--w-ls) 30%,var(--w-ls) 70%,transparent);z-index:1}
.ft-div-ctr{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);display:flex;align-items:center;gap:10px;background:var(--ink2);padding:0 16px}
.ft-div-l{width:52px;height:1px;background:linear-gradient(90deg,transparent,rgba(249,115,22,0.4))}
.ft-div-r{width:52px;height:1px;background:linear-gradient(90deg,rgba(249,115,22,0.4),transparent)}
.ft-div-ico{width:24px;height:24px;border-radius:7px;background:var(--o-gl);border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center}
.ft-div-ico i{color:var(--or);font-size:9.5px}

.ft-bottom{padding:18px 0 28px;display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;position:relative;z-index:1}
.ft-copy{font-size:11px;color:var(--tx3)}
.ft-copy span{color:var(--or);font-weight:700}
.ft-heart-badge{display:flex;align-items:center;gap:6px;padding:4px 12px;background:var(--glass2);border:1px solid var(--w-ls);border-radius:100px;font-size:10.5px;color:var(--tx3)}
.heart{color:#ef4444;animation:hbeat .85s ease infinite alternate;display:inline-block}
@keyframes hbeat{from{transform:scale(1)}to{transform:scale(1.28)}}
.ft-policy{display:flex}
.ft-policy a{font-size:11px;color:var(--tx3);text-decoration:none;padding:0 13px;border-right:1px solid var(--w-ls);transition:.25s}
.ft-policy a:first-child{padding-left:0}
.ft-policy a:last-child{border-right:none}
.ft-policy a:hover{color:var(--or)}

/* ════════════════════════════════════════
   MOBILE MENU
════════════════════════════════════════ */
.mob-menu{display:none;position:absolute;top:calc(100% + 10px);left:0;right:0;background:rgba(5,5,15,0.97);backdrop-filter:blur(24px);border:1px solid var(--w-ls);border-radius:18px;padding:14px;z-index:100;flex-direction:column;gap:4px}
.mob-menu.open{display:flex}
.mob-menu a{padding:10px 14px;border-radius:10px;font-size:14px;font-weight:600;color:var(--tx2);text-decoration:none;transition:.24s}
.mob-menu a:hover{background:var(--glass2);color:var(--or)}

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media(max-width:640px){
  .sec{padding:72px 0}
  .bento,.tujuan-bento{grid-template-columns:1fr 1fr}
  .cta-banner{padding:52px 22px}
  .stats-row{gap:8px}
}
@media(max-width:400px){
  .bento{grid-template-columns:1fr}
  .stats-row{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body class="antialiased">


<nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[95%] max-w-6xl z-50">
  <div class="rounded-2xl px-6 py-4 flex justify-between items-center bg-slate-900/30 backdrop-blur-lg border border-white/20 shadow-lg" style="position:relative">
    <div class="flex items-center gap-3 cursor-pointer group">
      <div class="relative group">
        <img src="<?php echo e(asset('image/himalaya1.jpeg')); ?>" alt="Logo"
             class="w-10 h-10 object-contain rounded-lg shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-all duration-300">
        <span class="absolute -bottom-1 -right-1 w-2.5 h-2.5 bg-green-400 rounded-full shadow-md shadow-green-400/60"></span>
      </div>
      <div class="flex flex-col">
        <span class="text-lg font-extrabold tracking-tight text-white leading-none">HIMAYALA</span>
        <span class="text-[9px] font-medium text-slate-400 tracking-widest uppercase">Perhimpunan Pegiat Alam Dan Penempuh Rimba</span>
        <span class="text-[8px] text-slate-400 tracking-wider uppercase">Yayasan Fatahillah</span>
      </div>
    </div>
    <div class="hidden md:flex items-center gap-1">
      <a href="<?php echo e(route('public.home')); ?>"       class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-300 hover:text-orange-400 hover:bg-slate-800/50 transition-all">Beranda</a>
      <a href="<?php echo e(route('public.articles')); ?>"   class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-300 hover:text-orange-400 hover:bg-slate-800/50 transition-all">Artikel</a>
      <a href="<?php echo e(route('public.gallery')); ?>"    class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-300 hover:text-orange-400 hover:bg-slate-800/50 transition-all">Galeri</a>
      <a href="<?php echo e(route('public.activities')); ?>" class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-300 hover:text-orange-400 hover:bg-slate-800/50 transition-all">Kegiatan</a>
      <a href="<?php echo e(route('public.members')); ?>"    class="px-5 py-2.5 rounded-full text-sm font-medium text-slate-300 hover:text-orange-400 hover:bg-slate-800/50 transition-all">Anggota</a>
    </div>
    <div class="flex items-center gap-4">
      <a href="<?php echo e(route('login')); ?>" class="hidden md:flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-500 text-white text-sm font-semibold rounded-full hover:shadow-lg hover:shadow-orange-500/30 transition-all transform hover:-translate-y-0.5">
        <i class="fas fa-user-circle"></i> Masuk
      </a>
      <button id="menuBtn" class="md:hidden p-2 text-slate-300 hover:bg-slate-800/50 rounded-lg">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>
    <div class="mob-menu md:hidden" id="mobileMenu">
      <a href="<?php echo e(route('public.home')); ?>">Beranda</a>
      <a href="<?php echo e(route('public.articles')); ?>">Artikel</a>
      <a href="<?php echo e(route('public.gallery')); ?>">Galeri</a>
      <a href="<?php echo e(route('public.activities')); ?>">Kegiatan</a>
      <a href="<?php echo e(route('public.members')); ?>">Anggota</a>
      <a href="<?php echo e(route('login')); ?>" style="background:rgba(249,115,22,0.14);color:#f97316;margin-top:4px">Masuk</a>
    </div>
  </div>
</nav>


<div class="bg-cover bg-center bg-fixed min-h-screen" style="background-image:url('<?php echo e(asset('image/petacompas.jpg')); ?>')">
<div class="bg-black/80">
<section class="relative pt-40 pb-24 lg:pt-56 lg:pb-40 overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="max-w-4xl mx-auto text-center">
      <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-500/10 text-orange-300 text-xs font-bold uppercase tracking-wider mb-6 border border-orange-500/20 backdrop-blur-sm">
        <span class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></span> Official Website
      </div>
      <h1 class="text-4xl md:text-6xl lg:text-5xl font-extrabold text-white leading-[1.1] mb-6 tracking-tight">
        HIMAYALA <br>
        <span class="text-gradient">Perhimpunan Pegiat Alam Dan Penempuh Rimba Yayasan Fatahillah</span>
      </h1>
      <p class="text-lg md:text-xl text-slate-300 mb-10 max-w-2xl mx-auto leading-relaxed font-light">
        JUJUR | DISIPLIN | TANGGUNG JAWAB
      </p>
    </div>
  </div>
</section>
</div>
</div>


<div class="ticker-shell">
  <div class="ticker-pill"><i class="fas fa-newspaper"></i>Artikel</div>
  <div style="padding-left:100px;overflow:hidden;width:100%">
    <div class="ticker-track" id="ticker">
      <?php $artikels=\App\Models\Artikel::where('status','published')->latest()->take(7)->get(); ?>
      <?php $__currentLoopData = $artikels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('public.article.show',$a->id)); ?>" class="t-item">
          <?php if($a->gambar): ?><img src="<?php echo e(asset('storage/'.$a->gambar)); ?>" alt=""><?php endif; ?>
          <span class="t-dot"></span><span><?php echo e($a->judul); ?></span>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $artikels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('public.article.show',$a->id)); ?>" class="t-item">
          <?php if($a->gambar): ?><img src="<?php echo e(asset('storage/'.$a->gambar)); ?>" alt=""><?php endif; ?>
          <span class="t-dot"></span><span><?php echo e($a->judul); ?></span>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>


<section class="sec sec-a">
  <div class="wrap">
    <div class="fu" style="text-align:center;max-width:620px;margin:0 auto">
      <div class="eyebrow"><i class="fas fa-sitemap"></i> Struktur Organisasi</div>
      <h2 class="display">Tim <span class="accent">Kepemimpinan</span></h2>
      <p class="lead" style="margin:0 auto">Pemimpin yang menginspirasi dan membimbing HIMAYALA menuju masa depan lebih baik.</p>
    </div>
    <div class="bento">
      <?php $colors=['#f97316','#ea580c','#fb923c','#fbbf24','#f59e0b','#ef4444','#22c55e','#6366f1','#a855f7','#06b6d4']; ?>
      <?php $__currentLoopData = $struktur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $c=$colors[$i%count($colors)]; ?>
        <div class="sk-card fu" style="transition-delay:<?php echo e($i*0.055); ?>s">
          <?php if($item->foto): ?>
            <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="sk-av">
          <?php else: ?>
            <?php $ini=collect(explode(' ',$item->nama))->take(2)->map(fn($w)=>strtoupper($w[0]))->join(''); ?>
            <div class="sk-init" style="background:<?php echo e($c); ?>16;border-color:<?php echo e($c); ?>38;color:<?php echo e($c); ?>"><?php echo e($ini); ?></div>
          <?php endif; ?>
          <div class="sk-role"><?php echo e($item->jabatan); ?></div>
          <div class="sk-name"><?php echo e($item->nama); ?></div>
          <div class="sk-badge"><span class="pulse"></span> Aktif</div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>

<div class="hl"></div>


<section class="sec sec-b" id="about">
  <div class="wrap">
    <div class="about-split">
      <div class="fu" style="display:flex;flex-direction:column;gap:16px">
        <div class="map-card">
          <div class="map-topbar">
            <div class="live-chip">
              <div class="live-dot"></div>
              <span class="map-label">Lokasi Basecamp</span>
            </div>
            <span class="map-coord-pill">SMK Fatahillah · Cileungsi</span>
          </div>
          <div id="map"></div>
          <div class="map-btmbar">
            <span class="mono-sm">-6.424000, 107.039861</span>
            <span class="elev-tag">↑ 62 mdpl</span>
          </div>
        </div>
        <div class="compass-strip fu" style="transition-delay:.13s">
          <div class="cmp">
            <div class="cmp-ring"></div>
            <div class="cmp-body">
              <span class="crd n">N</span><span class="crd s">S</span>
              <span class="crd e">E</span><span class="crd w">W</span>
              <div class="nd-n"></div><div class="nd-s"></div>
              <div class="cmp-dot"></div>
            </div>
          </div>
          <div class="cmp-info">
            <div class="cmp-title">Koordinat Basecamp</div>
            <div class="cmp-coords">-6.424000 · 107.039861</div>
            <div class="cmp-place">Cileungsi, Kab. Bogor · Jawa Barat</div>
          </div>
        </div>
      </div>

      <div class="fu" style="transition-delay:.17s">
        <div class="eyebrow"><i class="fas fa-info-circle"></i> Tentang Kami</div>
        <h2 class="display">HIMAYALA<br><span class="accent">Alam &amp; Rimba</span></h2>
        <p class="about-sub">Perhimpunan Pegiat Alam · Yayasan Fatahillah</p>
        <p class="body-text">HIMAYALA berdiri pada <strong>11 Januari 2025</strong> di lingkungan SMK Fatahillah Cileungsi — lahir dari jiwa para pejuang yang mencintai alam dan rimba raya.</p>
        <p class="body-text">Dengan semangat kebersamaan, kami hadir membentuk generasi muda yang <strong>tangguh, disiplin, dan berjiwa pemimpin</strong> — siap menjelajah setiap puncak dan mengabdi kepada alam.</p>
        <div class="stats-row">
          <div class="stat-tile"><div class="stat-n"><?php echo e($stats['total_anggota']); ?></div><div class="stat-l">Anggota</div></div>
          <div class="stat-tile"><div class="stat-n">2025</div><div class="stat-l">Berdiri</div></div>
          <div class="stat-tile"><div class="stat-n">Bogor</div><div class="stat-l">Lokasi</div></div>
        </div>
        <div class="philo">
          <div class="philo-head">Filosofi Kami</div>
          <div class="phi-row"><div class="phi-icon">🌿</div><span class="phi-text">Dari alam kami belajar</span><span class="phi-n">01</span></div>
          <div class="phi-row"><div class="phi-icon">🏔️</div><span class="phi-text">Kepada alam kami mengabdi</span><span class="phi-n">02</span></div>
          <div class="phi-row"><div class="phi-icon">🤝</div><span class="phi-text">Bersama kita lebih kuat</span><span class="phi-n">03</span></div>
        </div>
        <div class="tagrow">
          <span class="tag">🎓 Akademik</span>
          <span class="tag">🫂 Sosial</span>
          <span class="tag">🏛️ Budaya</span>
          <span class="tag">⛰️ Pendakian</span>
          <span class="tag">🌏 Lingkungan</span>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="hl"></div>


<section class="sec sec-a">
  <div class="wrap">
    <div class="fu" style="text-align:center;max-width:580px;margin:0 auto">
      <div class="eyebrow"><i class="fas fa-bullseye"></i> Visi &amp; Misi</div>
      <h2 class="display">Tujuan <span class="accent">Organisasi</span></h2>
      <p class="lead" style="margin:0 auto">Pilar-pilar yang menopang semangat dan arah langkah HIMAYALA.</p>
    </div>
    <div class="tujuan-bento">
      <div class="tj fu" style="transition-delay:.05s"><div class="tj-ghost">01</div><div class="tj-ico"><i class="fas fa-book-open"></i></div><h3 class="tj-h">Pendidikan</h3><p class="tj-p">Meningkatkan pendidikan dan keterampilan anggota SISPALA melalui kegiatan terstruktur dan berkelanjutan.</p></div>
      <div class="tj fu" style="transition-delay:.1s"><div class="tj-ghost">02</div><div class="tj-ico"><i class="fas fa-hands-helping"></i></div><h3 class="tj-h">Solidaritas</h3><p class="tj-p">Membangun solidaritas dan kekeluargaan yang kuat antar anggota SISPALA di segala kondisi.</p></div>
      <div class="tj fu" style="transition-delay:.15s"><div class="tj-ghost">03</div><div class="tj-ico"><i class="fas fa-hand-holding-heart"></i></div><h3 class="tj-h">Sosial</h3><p class="tj-p">Berkontribusi aktif dalam kegiatan sosial dan kemanusiaan untuk masyarakat sekitar dan alam.</p></div>
      <div class="tj fu" style="transition-delay:.2s"><div class="tj-ghost">04</div><div class="tj-ico"><i class="fas fa-shield-alt"></i></div><h3 class="tj-h">Ketangguhan</h3><p class="tj-p">Membentuk mental dan fisik yang tangguh melalui latihan dan ekspedisi ke alam terbuka.</p></div>
    </div>
  </div>
</section>

<div class="hl"></div>


<section class="sec sec-b">
  <div class="wrap">
    <div class="keg-flex fu">
      <div>
        <div class="eyebrow"><i class="fas fa-calendar-check"></i> Aktivitas</div>
        <h2 class="display" style="margin-bottom:6px">Kegiatan <span class="accent">Terbaru</span></h2>
        <p class="lead">Ikuti jejak langkah kami dalam berkarya dan berkontribusi.</p>
      </div>
      <a href="<?php echo e(route('public.activities')); ?>" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="keg-grid">
      <?php $__empty_1 = true; $__currentLoopData = \App\Models\Kegiatan::latest()->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="keg-card fu" style="transition-delay:<?php echo e($i*0.08); ?>s">
          <div class="keg-thumb">
            <?php if($kegiatan->foto): ?><img src="<?php echo e(asset('storage/'.$kegiatan->foto)); ?>" alt="<?php echo e($kegiatan->judul); ?>">
            <?php else: ?><div class="keg-ph"><i class="fas fa-mountain" style="font-size:38px;color:var(--tx3)"></i></div><?php endif; ?>
            <div class="keg-overlay"></div>
            <div class="keg-meta">
              <div class="keg-date"><i class="far fa-calendar-alt"></i> <?php echo e(\Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')); ?></div>
              <span class="keg-status <?php echo e($kegiatan->status=='Upcoming'?'s-up':($kegiatan->status=='Ongoing'?'s-on':'s-dn')); ?>"><?php echo e($kegiatan->status); ?></span>
            </div>
          </div>
          <div class="keg-body">
            <h3 class="keg-h"><?php echo e($kegiatan->judul); ?></h3>
            <p class="keg-p"><?php echo e(Str::limit($kegiatan->deskripsi,90)); ?></p>
            <a href="<?php echo e(route('public.activity.show',$kegiatan->id)); ?>" class="keg-btn">Detail Kegiatan <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
          <i class="fas fa-calendar-check"></i>
          <p>Belum ada kegiatan</p>
          <span>Pantau terus update kegiatan kami.</span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<div class="hl"></div>


<section class="sec sec-a" style="padding:80px 0">
  <div class="wrap">
    <div class="cta-banner fu">
      <div class="cta-ico"><i class="fas fa-images"></i></div>
      <h2 class="cta-title">Galeri <span class="accent">HIMAYALA</span></h2>
      <p class="cta-desc">Abadikan momen berharga bersama alam — lihat dokumentasi lengkap kegiatan kami.</p>
      <div class="btn-row">
        <a href="<?php echo e(route('public.gallery')); ?>" class="btn-fire"><i class="fas fa-folder-open"></i> Lihat Galeri</a>
        <a href="#about" class="btn-ghost"><i class="fas fa-info-circle"></i> Tentang Kami</a>
      </div>
    </div>
  </div>
</section>

<div class="hl"></div>


<section class="sec sec-b">
  <div class="wrap">
    <div class="fu" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px">
      <div>
        <div class="eyebrow"><i class="fas fa-newspaper"></i> Publikasi</div>
        <h2 class="display">Artikel <span class="accent">Terkini</span></h2>
      </div>
      <a href="<?php echo e(route('public.articles')); ?>" class="see-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
    </div>
    <div class="art-grid">
      <?php $__empty_1 = true; $__currentLoopData = \App\Models\Artikel::where('status','published')->latest()->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $artikel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('public.article.show',$artikel->id)); ?>" class="art-card fu" style="transition-delay:<?php echo e($i*0.08); ?>s">
          <div class="art-thumb">
            <?php if($artikel->gambar): ?><img src="<?php echo e(asset('storage/'.$artikel->gambar)); ?>" alt="<?php echo e($artikel->judul); ?>">
            <?php else: ?><div class="art-ph"><i class="fas fa-newspaper" style="font-size:32px;color:var(--tx3)"></i></div><?php endif; ?>
          </div>
          <div class="art-body">
            <span class="art-pill">Artikel</span>
            <h3 class="art-h"><?php echo e($artikel->judul); ?></h3>
            <div class="art-foot"><i class="far fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($artikel->created_at)->format('d M Y')); ?></div>
          </div>
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column:1/-1;text-align:center;padding:48px;background:var(--glass);border:1px dashed var(--w-ls);border-radius:var(--r-xl)">
          <p style="color:var(--tx3);font-size:13px">Belum ada artikel dipublikasikan.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>


<div class="ft-border-top"></div>
<footer>
  <div class="ft-glow-a"></div>
  <div class="ft-glow-b"></div>
  <div class="wrap">
    <div class="ft-main">
      <div class="fu">
        <div class="ft-logo">
          <div class="ft-icon"><i class="fas fa-mountain"></i></div>
          <div>
            <div class="ft-brand-name">HIMAYALA</div>
            <div class="ft-brand-sub">Pegiat Alam · Yayasan Fatahillah</div>
          </div>
        </div>
        <p class="ft-desc">Organisasi penempuh rimba yang berdedikasi membentuk jiwa kepemimpinan, ketangguhan mental, dan kepedulian mendalam terhadap alam dan sesama.</p>
        <div class="soc-row">
          <a href="https://instagram.com/himalayafatahillah_" target="_blank" class="soc ig"><i class="fab fa-instagram"></i></a>
          <a href="https://facebook.com" target="_blank" class="soc fb"><i class="fab fa-facebook-f"></i></a>
          <a href="https://youtube.com" target="_blank" class="soc yt"><i class="fab fa-youtube"></i></a>
          <a href="https://tiktok.com" target="_blank" class="soc tt"><i class="fab fa-tiktok"></i></a>
          <a href="https://twitter.com" target="_blank" class="soc tw"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

      <div class="fu" style="transition-delay:.07s">
        <div class="ft-col-h">Menu</div>
        <ul class="ft-links">
          <li><a href="<?php echo e(route('public.home')); ?>"><span class="ldot"></span>Beranda</a></li>
          <li><a href="<?php echo e(route('public.articles')); ?>"><span class="ldot"></span>Artikel</a></li>
          <li><a href="<?php echo e(route('public.gallery')); ?>"><span class="ldot"></span>Galeri</a></li>
          <li><a href="<?php echo e(route('public.activities')); ?>"><span class="ldot"></span>Kegiatan</a></li>
          <li><a href="<?php echo e(route('public.members')); ?>"><span class="ldot"></span>Anggota</a></li>
        </ul>
      </div>

      <div class="fu" style="transition-delay:.12s">
        <div class="ft-col-h">Informasi</div>
        <ul class="ft-links">
          <li><a href="#about"><span class="ldot"></span>Tentang Kami</a></li>
          <li><a href="#"><span class="ldot"></span>Visi &amp; Misi</a></li>
          <li><a href="#"><span class="ldot"></span>Struktur Organisasi</a></li>
          <li><a href="#"><span class="ldot"></span>Sejarah</a></li>
          <li><a href="<?php echo e(route('login')); ?>"><span class="ldot"></span>Login Admin</a></li>
        </ul>
      </div>

      <div class="fu" style="transition-delay:.17s">
        <div class="ft-col-h">Kontak</div>
        <div class="ft-citem"><div class="ft-cico"><i class="fas fa-map-marker-alt"></i></div><span class="ft-ctxt">Kp. Tengah Ds Cipeucang Rt 006/003 Cileungsi, Kab. Bogor, Jawa Barat</span></div>
        <div class="ft-citem"><div class="ft-cico"><i class="fas fa-phone"></i></div><span class="ft-ctxt">+62 882-8973-8661</span></div>
        <div class="ft-citem"><div class="ft-cico"><i class="fas fa-envelope"></i></div><span class="ft-ctxt">himalaya@himalaya.com</span></div>
        <div class="ft-citem"><div class="ft-cico"><i class="fab fa-instagram"></i></div><span class="ft-ctxt">@himalayafatahillah_</span></div>
      </div>
    </div>

    <div class="ft-div fu" style="transition-delay:.2s">
      <div class="ft-div-ctr">
        <div class="ft-div-l"></div>
        <div class="ft-div-ico"><i class="fas fa-mountain"></i></div>
        <div class="ft-div-r"></div>
      </div>
    </div>

    <div class="ft-bottom fu" style="transition-delay:.23s">
      <p class="ft-copy">&copy; <?php echo e(date('Y')); ?> <span>HIMAYALA</span>. All rights reserved.</p>
      <div class="ft-heart-badge">Dibuat dengan <i class="fas fa-heart heart"></i> untuk alam</div>
      <div class="ft-policy">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Sitemap</a>
      </div>
    </div>
  </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script>
const menuBtn=document.getElementById('menuBtn');
const mobileMenu=document.getElementById('mobileMenu');
menuBtn.addEventListener('click',()=>mobileMenu.classList.toggle('open'));
document.addEventListener('click',e=>{if(!mobileMenu.contains(e.target)&&!menuBtn.contains(e.target))mobileMenu.classList.remove('open')});

const lat=-6.424000,lng=107.039861;
const map=L.map('map',{center:[lat,lng],zoom:16,zoomControl:true,scrollWheelZoom:false});
L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',{
  attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> &copy; <a href="https://carto.com/">CARTO</a>',
  subdomains:'abcd',maxZoom:19
}).addTo(map);

const pinIcon=L.divIcon({
  className:'',
  html:`<div style="display:flex;flex-direction:column;align-items:center">
    <div style="width:16px;height:16px;border-radius:50% 50% 50% 0;background:linear-gradient(135deg,#f97316,#ea580c);transform:rotate(-45deg);border:2px solid rgba(255,255,255,.25);box-shadow:0 0 0 5px rgba(249,115,22,.2)"></div>
    <div style="margin-top:6px;background:rgba(249,115,22,.14);border:1px solid rgba(249,115,22,.35);color:#fbbf24;font-size:9px;font-weight:800;padding:3px 8px;border-radius:6px;white-space:nowrap;font-family:system-ui;letter-spacing:.05em;backdrop-filter:blur(6px)">SMK Fatahillah</div>
  </div>`,
  iconSize:[100,54],iconAnchor:[50,20]
});
L.marker([lat,lng],{icon:pinIcon}).addTo(map)
  .bindPopup(`<div style="font-family:system-ui;padding:4px 2px">
    <div style="font-weight:800;font-size:12px;color:#f97316;margin-bottom:3px">HIMAYALA — Basecamp</div>
    <div style="font-size:11px;color:#94a3b8;margin-bottom:2px">SMK Fatahillah Cileungsi</div>
    <div style="font-size:10px;font-family:monospace;color:#64748b">-6.424000 · 107.039861</div>
  </div>`,{maxWidth:200}).openPopup();

const pulse=L.divIcon({
  className:'',
  html:`<div style="width:34px;height:34px;border-radius:50%;background:rgba(249,115,22,.07);border:1px solid rgba(249,115,22,.18);animation:pp 2.2s ease-out infinite"></div>
  <style>@keyframes pp{0%{transform:scale(1);opacity:.9}100%{transform:scale(2.6);opacity:0}}</style>`,
  iconSize:[34,34],iconAnchor:[17,17]
});
L.marker([lat,lng],{icon:pulse,interactive:false,zIndexOffset:-100}).addTo(map);
setTimeout(()=>map.invalidateSize(),400);

const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('vis');obs.unobserve(e.target)}});
},{threshold:.07,rootMargin:'0px 0px -28px 0px'});
document.querySelectorAll('.fu').forEach(el=>obs.observe(el));
</script>
</body>
</html><?php /**PATH C:\xampppp\htdocs\himalaya\resources\views/public/home.blade.php ENDPATH**/ ?>