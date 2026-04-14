{{-- resources/views/public/activity-show.blade.php --}}
@extends('public.layouts')
@section('title', $kegiatan->judul . ' — HIMAYALA')

@push('styles')
<style>
.act-wrap{max-width:860px;margin:0 auto;padding:0 60px}

/* Hero image */
.act-hero-img{height:400px;overflow:hidden;position:relative;margin-bottom:48px}
.act-hero-img img{width:100%;height:100%;object-fit:cover;filter:brightness(.8)}
.act-hero-img::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,transparent 45%,rgba(9,9,11,.85) 100%)}
.act-hero-status{position:absolute;top:20px;right:20px;z-index:2;font-size:7.5px;font-weight:500;letter-spacing:.32em;text-transform:uppercase;padding:7px 14px;border:1px solid;backdrop-filter:blur(8px)}

/* Meta row */
.act-meta{display:grid;grid-template-columns:repeat(2,1fr);gap:12px;margin-bottom:36px}
.act-meta-item{display:flex;align-items:center;gap:14px;padding:16px 18px;background:var(--ink3);border:1px solid var(--o-ls)}
.act-meta-ico{width:36px;height:36px;border:1px solid var(--o-ls);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.act-meta-ico i{color:var(--o);font-size:13px}
.act-meta-lbl{font-size:8px;letter-spacing:.24em;text-transform:uppercase;color:var(--tx2);display:block;margin-bottom:3px}
.act-meta-val{font-size:13px;color:var(--tx1);font-weight:300}

/* Description */
.act-desc-sec{margin-bottom:40px}
.act-sec-title{
  font-family:'Cormorant Garamond',serif;
  font-size:24px;font-weight:300;color:#fff;
  margin-bottom:16px;
  display:flex;align-items:center;gap:12px;
}
.act-sec-title::before{content:'';width:18px;height:1px;background:var(--o);flex-shrink:0}
.act-desc-body{font-size:13.5px;color:rgba(237,232,222,.65);line-height:1.9}
.act-desc-body p+p{margin-top:16px}

/* CTA Banner */
.act-cta{
  background:var(--ink3);
  border:1px solid var(--o-ls);
  padding:36px 40px;
  display:flex;align-items:center;justify-content:space-between;
  gap:24px;flex-wrap:wrap;
  margin-bottom:16px;
  position:relative;overflow:hidden;
}
.act-cta::before{
  content:'';position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--o),transparent);
}
.act-cta-text h3{font-family:'Cormorant Garamond',serif;font-size:24px;font-weight:300;color:#fff;margin-bottom:6px}
.act-cta-text p{font-size:12px;color:var(--tx2)}
.act-cta-btns{display:flex;gap:10px;flex-wrap:wrap;flex-shrink:0}
.act-wa{
  display:inline-flex;align-items:center;gap:8px;
  padding:12px 24px;
  font-size:9.5px;font-weight:500;letter-spacing:.18em;text-transform:uppercase;
  color:var(--ink);background:var(--o);
  border:1px solid var(--o);border-radius:2px;
  transition:background .3s,box-shadow .3s;
}
.act-wa:hover{background:var(--o-hi);box-shadow:0 6px 20px rgba(217,91,22,.28)}

@media(max-width:640px){
  .act-wrap{padding:0 20px}
  .act-hero-img{height:240px}
  .act-meta{grid-template-columns:1fr}
  .act-cta{flex-direction:column}
}
</style>
@endpush

@section('content')
<section class="sec" style="background:var(--ink);">
  <div class="act-wrap rv">
    <a href="{{ route('public.activities') }}" class="back-btn">
      <i class="fas fa-arrow-left" style="font-size:9px;"></i> Kembali ke Kegiatan
    </a>

    @if($kegiatan->foto)
    <div class="act-hero-img">
      <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="{{ $kegiatan->judul }}">
      <div class="act-hero-status {{ $kegiatan->status=='Upcoming'?'s-upcoming':($kegiatan->status=='Ongoing'?'s-ongoing':'s-selesai') }}">{{ $kegiatan->status }}</div>
    </div>
    @endif

    <div class="lbl" style="margin-bottom:12px;">— Detail Kegiatan —</div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(28px,4vw,48px);font-weight:300;color:#fff;line-height:1.1;margin-bottom:32px;">{{ $kegiatan->judul }}</h1>

    <div class="act-meta">
      <div class="act-meta-item">
        <div class="act-meta-ico"><i class="fas fa-calendar-alt"></i></div>
        <div><span class="act-meta-lbl">Tanggal</span><span class="act-meta-val">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}</span></div>
      </div>
      <div class="act-meta-item">
        <div class="act-meta-ico"><i class="fas fa-map-marker-alt"></i></div>
        <div><span class="act-meta-lbl">Lokasi</span><span class="act-meta-val">{{ $kegiatan->lokasi ?? 'TBA' }}</span></div>
      </div>
      @if($kegiatan->peserta)
      <div class="act-meta-item">
        <div class="act-meta-ico"><i class="fas fa-users"></i></div>
        <div><span class="act-meta-lbl">Peserta</span><span class="act-meta-val">{{ $kegiatan->peserta }}</span></div>
      </div>
      @endif
      @if($kegiatan->kuota)
      <div class="act-meta-item">
        <div class="act-meta-ico"><i class="fas fa-user-plus"></i></div>
        <div><span class="act-meta-lbl">Kuota</span><span class="act-meta-val">{{ $kegiatan->kuota }} Orang</span></div>
      </div>
      @endif
    </div>

    <div class="act-desc-sec">
      <h2 class="act-sec-title">Deskripsi Kegiatan</h2>
      <div class="act-desc-body">
        <p>{{ $kegiatan->deskripsi }}</p>
      </div>
    </div>

    <div class="act-cta">
      <div class="act-cta-text">
        <h3>Tertarik Mengikuti?</h3>
        <p>Hubungi kami untuk informasi pendaftaran dan detail lebih lanjut</p>
      </div>
      <div class="act-cta-btns">
        <a href="https://wa.me/6288289738661" class="act-wa">
          <i class="fab fa-whatsapp"></i>Hubungi via WhatsApp
        </a>
        <a href="{{ route('public.members') }}" class="btn-ghost">Lihat Anggota</a>
      </div>
    </div>
  </div>

  {{-- Related --}}
  @if(isset($relatedActivities) && $relatedActivities->count() > 0)
  <div class="wrap" style="margin-top:64px">
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(22px,3vw,36px);font-weight:300;color:#fff;margin-bottom:32px;display:flex;align-items:center;gap:14px;" class="rv">
      <span style="width:20px;height:1px;background:var(--o);flex-shrink:0;display:block;"></span>
      Kegiatan Terkait
    </h2>
    <div class="card-grid-3 rv">
      @foreach($relatedActivities->take(3) as $r)
      <a href="{{ route('public.activity.show', $r->id) }}" class="ccard">
        <div class="ccard-img" style="height:180px;">
          @if($r->foto)<img src="{{ asset('storage/'.$r->foto) }}" alt="{{ $r->judul }}">
          @else<div style="width:100%;height:100%;background:var(--ink3);display:flex;align-items:center;justify-content:center;"><i class="fas fa-mountain" style="color:var(--o-ls);font-size:28px;"></i></div>@endif
          <div class="ccard-ov"></div>
          <div class="ccard-badge {{ $r->status=='Upcoming'?'s-upcoming':($r->status=='Ongoing'?'s-ongoing':'s-selesai') }}">{{ $r->status }}</div>
        </div>
        <div class="ccard-body">
          <div class="ccard-title" style="font-size:17px;">{{ $r->judul }}</div>
          <p style="font-size:10px;color:var(--tx2);margin-top:auto;">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  @endif
</section>
@endsection