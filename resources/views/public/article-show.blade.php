{{-- ═══════════════════════════════════════════════════════
    resources/views/public/article-show.blade.php
═══════════════════════════════════════════════════════ --}}
@extends('public.layouts')
@section('title', $artikel->judul . ' — HIMAYALA')

@push('styles')
<style>
.art-wrap{max-width:800px;margin:0 auto;padding:0 60px}
.art-img{height:380px;overflow:hidden;position:relative;margin-bottom:48px}
.art-img img{width:100%;height:100%;object-fit:cover;filter:brightness(.82)}
.art-img::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,transparent 50%,rgba(9,9,11,.8) 100%)}
.art-meta{display:flex;flex-wrap:wrap;align-items:center;gap:16px;margin-bottom:20px}
.art-tag{font-size:7.5px;font-weight:500;letter-spacing:.32em;text-transform:uppercase;color:var(--o);border:1px solid var(--o-ls);padding:5px 12px}
.art-date{font-size:11px;color:var(--tx2);display:flex;align-items:center;gap:6px}
.art-h1{font-family:'Cormorant Garamond',serif;font-size:clamp(30px,4vw,48px);font-weight:300;color:#fff;line-height:1.12;margin-bottom:28px}
.art-body{font-size:14px;color:rgba(237,232,222,.72);line-height:1.9;margin-bottom:48px}
.art-body p+p{margin-top:18px}
.art-share{padding:24px;background:var(--ink3);border:1px solid var(--o-ls);margin-bottom:16px}
.art-share-title{font-size:8px;font-weight:500;letter-spacing:.32em;text-transform:uppercase;color:var(--tx2);margin-bottom:14px}
.shr-btns{display:flex;flex-wrap:wrap;gap:8px}
.shr-btn{display:inline-flex;align-items:center;gap:7px;padding:9px 16px;font-size:10px;font-weight:500;letter-spacing:.1em;border:1px solid var(--o-ls);color:var(--tx2);transition:all .3s;border-radius:2px}
.shr-btn:hover{color:var(--o);border-color:var(--o-ln);background:var(--o-gl2)}

/* Related */
.rel-title{font-family:'Cormorant Garamond',serif;font-size:clamp(24px,3vw,36px);font-weight:300;color:#fff;margin-bottom:32px;display:flex;align-items:center;gap:14px}
.rel-title::before{content:'';width:24px;height:1px;background:var(--o);flex-shrink:0}

@media(max-width:640px){.art-wrap{padding:0 20px}.art-img{height:240px}}
</style>
@endpush

@section('content')
<section class="sec" style="background:var(--ink);">
  <div class="art-wrap rv">
    <a href="{{ route('public.articles') }}" class="back-btn">
      <i class="fas fa-arrow-left" style="font-size:9px;"></i> Kembali ke Artikel
    </a>

    @if($artikel->gambar)
    <div class="art-img">
      <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}">
    </div>
    @endif

    <div class="art-meta">
      <span class="art-tag">Artikel</span>
      <span class="art-date"><i class="far fa-calendar" style="color:var(--o);font-size:10px;"></i>{{ $artikel->created_at->format('d F Y') }}</span>
    </div>

    <h1 class="art-h1">{{ $artikel->judul }}</h1>

    <div class="art-body">
  {!! 
    $artikel->konten 
    ?? $artikel->content 
    ?? $artikel->deskripsi 
    ?? $artikel->isi 
    ?? '<i>Konten belum tersedia</i>' 
  !!}
</div>

    <div class="art-share">
      <div class="art-share-title">Bagikan Artikel</div>
      <div class="shr-btns">
        <a href="#" class="shr-btn"><i class="fab fa-facebook-f"></i>Facebook</a>
        <a href="#" class="shr-btn"><i class="fab fa-instagram"></i>Instagram</a>
        <a href="#" class="shr-btn"><i class="fab fa-twitter"></i>Twitter</a>
        <a href="#" class="shr-btn"><i class="fab fa-whatsapp"></i>WhatsApp</a>
        <a href="#" class="shr-btn"><i class="fas fa-link"></i>Salin Tautan</a>
      </div>
    </div>
  </div>

  {{-- Related --}}
  @if(isset($relatedArticles) && $relatedArticles->count() > 0)
  <div class="wrap" style="margin-top:64px">
    <h2 class="rel-title rv">Artikel Terkait</h2>
    <div class="card-grid-3 rv">
      @foreach($relatedArticles->take(3) as $r)
      <a href="{{ route('public.article.show', $r->id) }}" class="ccard">
        <div class="ccard-img" style="height:180px;">
          @if($r->gambar)
            <img src="{{ asset('storage/'.$r->gambar) }}" alt="{{ $r->judul }}">
          @else
            <div style="width:100%;height:100%;background:var(--ink3);display:flex;align-items:center;justify-content:center;"><i class="fas fa-newspaper" style="color:var(--o-ls);font-size:28px;"></i></div>
          @endif
          <div class="ccard-ov"></div>
        </div>
        <div class="ccard-body">
          <div class="ccard-title" style="font-size:17px;">{{ $r->judul }}</div>
          <p style="font-size:10px;color:var(--tx2);margin-top:auto;">{{ $r->created_at->format('d M Y') }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  @endif
</section>
@endsection