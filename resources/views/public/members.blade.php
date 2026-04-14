{{-- resources/views/public/members.blade.php --}}
@extends('public.layouts')
@section('title', 'Anggota — HIMAYALA')

@push('styles')
<style>
/* ── STATS ROW ── */
.stats-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--o-ls);margin-bottom:64px}
.stat-box{
  background:var(--ink3);
  padding:28px 24px;
  display:flex;align-items:center;gap:20px;
}
.stat-ico{
  width:48px;height:48px;flex-shrink:0;
  border:1px solid var(--o-ls);
  display:flex;align-items:center;justify-content:center;
}
.stat-ico i{color:var(--o);font-size:16px}
.stat-num{font-family:'Cormorant Garamond',serif;font-size:40px;font-weight:300;color:var(--o);display:block;line-height:1}
.stat-lbl{font-size:8px;letter-spacing:.26em;text-transform:uppercase;color:var(--tx2);display:block;margin-top:5px}

/* ── MEMBER SECTION HEADER ── */
.mem-sec-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:12px}
.mem-sec-title{font-family:'Cormorant Garamond',serif;font-size:clamp(22px,3vw,34px);font-weight:300;color:#fff;display:flex;align-items:center;gap:14px}
.mem-sec-title::before{content:'';width:20px;height:1px;background:var(--o);flex-shrink:0;display:block}
.mem-sec-count{display:flex;align-items:center;gap:7px;font-size:9px;letter-spacing:.22em;text-transform:uppercase;color:var(--tx2)}
.mem-sec-count span{width:6px;height:6px;border-radius:50%;background:var(--o);display:block;animation:pulse 2s ease infinite}
@keyframes pulse{0%,100%{opacity:.4}50%{opacity:1}}

/* ── MEMBER CARD ── */
.mem-g{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--o-ls)}
.mem-c{
  background:var(--ink3);
  padding:36px 20px 28px;
  display:flex;flex-direction:column;align-items:center;text-align:center;
  position:relative;overflow:hidden;
  transition:background .4s;
}
.mem-c::before{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:linear-gradient(90deg,transparent,var(--o),transparent);opacity:0;transition:opacity .4s}
.mem-c:hover{background:var(--ink4)}
.mem-c:hover::before{opacity:1}

.mem-av{
  width:72px;height:72px;
  border:1px solid var(--o-ls);
  overflow:hidden;margin-bottom:16px;
  position:relative;flex-shrink:0;
  transition:border-color .4s;
}
.mem-c:hover .mem-av{border-color:var(--o)}
.mem-av img{width:100%;height:100%;object-fit:cover;filter:grayscale(25%);transition:filter .4s,transform .5s}
.mem-c:hover .mem-av img{filter:grayscale(0%);transform:scale(1.05)}
.mem-av-init{width:100%;height:100%;background:var(--o-gl);display:flex;align-items:center;justify-content:center}
.mem-av-init span{font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:300;color:var(--o)}
.mem-av-dot{position:absolute;bottom:3px;right:3px;width:9px;height:9px;border-radius:50%;border:2px solid var(--ink3)}
.mem-av-dot.aktif{background:#4ade80}
.mem-av-dot.alumni{background:#60a5fa}

.mem-nm{font-family:'Cormorant Garamond',serif;font-size:18px;font-weight:300;color:var(--tx1);margin-bottom:5px;line-height:1.2;transition:color .3s}
.mem-c:hover .mem-nm{color:#fff}
.mem-pos{font-size:8px;letter-spacing:.26em;text-transform:uppercase;color:var(--o);margin-bottom:4px}
.mem-nim{font-size:10px;color:var(--tx2);margin-bottom:14px;letter-spacing:.08em}

.mem-soc{display:flex;justify-content:center;gap:6px}
.mem-soc-btn{width:28px;height:28px;border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;color:var(--tx2);font-size:9px;transition:border-color .3s,color .3s,background .3s}
.mem-soc-btn:hover{border-color:var(--o);color:var(--o);background:var(--o-gl2)}

/* Alumni variant */
.mem-c.alumni-card::before{background:linear-gradient(90deg,transparent,#60a5fa,transparent)}
.alumni-card .mem-pos{color:#60a5fa}

@media(max-width:1080px){.mem-g{grid-template-columns:repeat(2,1fr)}.stats-row{grid-template-columns:1fr 1fr}}
@media(max-width:640px){.mem-g{grid-template-columns:1fr 1fr}.stats-row{grid-template-columns:1fr}}
</style>
@endpush

@section('content')

<section class="sec" style="background:var(--ink);">
  <div class="wrap">

    {{-- Stats --}}
    <div class="stats-row rv">
      <div class="stat-box">
        <div class="stat-ico"><i class="fas fa-users"></i></div>
        <div><span class="stat-num">{{ $anggotas->total() }}</span><span class="stat-lbl">Total Anggota</span></div>
      </div>
      <div class="stat-box">
        <div class="stat-ico"><i class="fas fa-check-circle"></i></div>
        <div><span class="stat-num" style="color:#4ade80;">{{ $anggotas->where('status','aktif')->count() }}</span><span class="stat-lbl">Aktif</span></div>
      </div>
      <div class="stat-box">
        <div class="stat-ico"><i class="fas fa-graduation-cap"></i></div>
        <div><span class="stat-num" style="color:#60a5fa;">{{ $anggotas->where('status','alumni')->count() }}</span><span class="stat-lbl">Alumni</span></div>
      </div>
    </div>

    {{-- Active Members --}}
    <div class="mem-sec-hd rv">
      <h2 class="mem-sec-title">Pengurus Aktif</h2>
      <div class="mem-sec-count"><span></span>{{ $anggotas->where('status','aktif')->count() }} Anggota</div>
    </div>

    <div class="mem-g rv" style="margin-bottom:64px;">
      @forelse($anggotas->where('status','aktif') as $m)
      <div class="mem-c">
        <div class="mem-av">
          @if($m->foto)
            <img src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}">
          @else
            <div class="mem-av-init"><span>{{ substr($m->nama,0,1) }}</span></div>
          @endif
          <div class="mem-av-dot aktif"></div>
        </div>
        <div class="mem-nm">{{ $m->nama }}</div>
        <div class="mem-pos">{{ ucfirst($m->jabatan) }}</div>
        <div class="mem-nim">{{ $m->nim }}</div>
        <div class="mem-soc">
          <a href="#" class="mem-soc-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="mem-soc-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="mailto:#" class="mem-soc-btn"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada anggota aktif.</p>
      </div>
      @endforelse
    </div>

    {{-- Alumni --}}
    @if($anggotas->where('status','alumni')->count() > 0)
    <div class="mem-sec-hd rv">
      <h2 class="mem-sec-title" style="color:rgba(237,232,222,.7);">Alumni HIMAYALA</h2>
      <div class="mem-sec-count" style="color:#60a5fa;"><span style="background:#60a5fa;"></span>{{ $anggotas->where('status','alumni')->count() }} Alumni</div>
    </div>

    <div class="mem-g rv">
      @forelse($anggotas->where('status','alumni') as $m)
      <div class="mem-c alumni-card">
        <div class="mem-av" style="border-color:rgba(96,165,250,.2);">
          @if($m->foto)
            <img src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}">
          @else
            <div class="mem-av-init" style="background:rgba(96,165,250,.08);"><span style="color:#60a5fa;">{{ substr($m->nama,0,1) }}</span></div>
          @endif
          <div class="mem-av-dot alumni"></div>
        </div>
        <div class="mem-nm">{{ $m->nama }}</div>
        <div class="mem-pos" style="color:#60a5fa;">Alumni</div>
        <div class="mem-nim">{{ $m->nim }}</div>
        <div class="mem-soc">
          <a href="#" class="mem-soc-btn"><i class="fab fa-instagram"></i></a>
          <a href="#" class="mem-soc-btn"><i class="fab fa-linkedin-in"></i></a>
          <a href="mailto:#" class="mem-soc-btn"><i class="fas fa-envelope"></i></a>
        </div>
      </div>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada data alumni.</p>
      </div>
      @endforelse
    </div>
    @endif

  </div>
</section>
@endsection