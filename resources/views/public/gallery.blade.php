{{-- resources/views/public/gallery.blade.php --}}
@extends('public.layouts')
@section('title', 'Galeri — HIMAYALA')

@push('styles')
<style>
/* ── FOLDER GRID ── */
.folder-g{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--o-ls)}
.folder-c{
  background:var(--ink2);
  padding:40px 24px;
  display:flex;flex-direction:column;align-items:center;text-align:center;
  position:relative;overflow:hidden;
  transition:background .4s;
  cursor:pointer;
}
.folder-c::before{
  content:'';position:absolute;bottom:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,transparent,var(--o),transparent);
  opacity:0;transition:opacity .4s;
}
.folder-c:hover{background:var(--ink3)}
.folder-c:hover::before{opacity:1}
.folder-ico{
  width:56px;height:56px;
  border:1px solid var(--o-ls);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:16px;
  transition:border-color .4s,box-shadow .4s;
}
.folder-c:hover .folder-ico{border-color:var(--o);box-shadow:0 0 16px var(--o-gl)}
.folder-ico i{font-size:20px;color:var(--o);transition:color .4s}
.folder-nm{font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:300;color:var(--tx1);margin-bottom:6px;transition:color .3s}
.folder-c:hover .folder-nm{color:#fff}
.folder-ct{font-size:9px;letter-spacing:.28em;text-transform:uppercase;color:var(--tx2)}

/* ── PHOTO GRID ── */
.photo-g{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--o-ls)}
.photo-c{
  position:relative;aspect-ratio:1;overflow:hidden;cursor:pointer;
}
.photo-c img{width:100%;height:100%;object-fit:cover;filter:grayscale(20%) brightness(.82);transition:filter .5s,transform .6s cubic-bezier(.22,1,.36,1)}
.photo-c:hover img{filter:grayscale(0%) brightness(.96);transform:scale(1.06)}
.photo-ov{
  position:absolute;inset:0;
  background:rgba(9,9,11,0);
  display:flex;align-items:center;justify-content:center;
  transition:background .4s;
}
.photo-c:hover .photo-ov{background:rgba(9,9,11,.35)}
.photo-ov i{font-size:22px;color:#fff;opacity:0;transform:scale(.8);transition:opacity .3s,transform .3s}
.photo-c:hover .photo-ov i{opacity:1;transform:scale(1)}
.photo-kat{
  position:absolute;bottom:10px;left:10px;z-index:2;
  font-size:7px;font-weight:500;letter-spacing:.28em;text-transform:uppercase;
  color:var(--o);background:rgba(9,9,11,.86);
  border:1px solid var(--o-ls);padding:4px 9px;
  backdrop-filter:blur(6px);
}
.photo-date{
  position:absolute;top:10px;right:10px;z-index:2;
  font-size:8px;color:var(--tx2);background:rgba(9,9,11,.82);
  border:1px solid var(--o-ls);padding:4px 9px;
  backdrop-filter:blur(6px);
}

/* Back link row */
.back-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:40px;flex-wrap:wrap;gap:14px}
.kat-title{font-family:'Cormorant Garamond',serif;font-size:clamp(24px,3vw,38px);font-weight:300;color:#fff;display:flex;align-items:center;gap:14px}
.kat-title::before{content:'';width:24px;height:1px;background:var(--o);flex-shrink:0}

@media(max-width:1080px){.folder-g{grid-template-columns:repeat(2,1fr)}.photo-g{grid-template-columns:repeat(3,1fr)}}
@media(max-width:640px){.folder-g{grid-template-columns:1fr 1fr}.photo-g{grid-template-columns:1fr 1fr}}
</style>
@endpush

@section('content')

<section class="sec" style="background:var(--ink);">
  <div class="wrap">

    @if(!isset($galeris))
    {{-- FOLDER VIEW --}}
    <div class="folder-g rv">
      @forelse($kategoris as $kat)
      <a href="{{ route('public.gallery.kategori', $kat->kategori) }}" class="folder-c">
        <div class="folder-ico">
          <i class="fas fa-folder-open"></i>
        </div>
        <div class="folder-nm">{{ ucfirst($kat->kategori) }}</div>
        <div class="folder-ct">{{ $kat->total }} Foto</div>
      </a>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada galeri tersedia.</p>
      </div>
      @endforelse
    </div>

    @else
    {{-- PHOTO VIEW --}}
    <div class="back-row rv">
      <h2 class="kat-title">{{ ucfirst($galeris->first()->kategori ?? 'Galeri') }}</h2>
      <a href="{{ route('public.gallery') }}" class="back-btn" style="margin-bottom:0;">
        <i class="fas fa-arrow-left" style="font-size:9px;"></i> Semua Angkatan
      </a>
    </div>

    <div class="photo-g rv">
      @forelse($galeris as $g)
      <div class="photo-c">
        <img src="{{ asset('storage/'.$g->foto) }}" alt="{{ $g->kategori }}">
        <div class="photo-ov"><i class="fas fa-expand-alt"></i></div>
        <div class="photo-kat">{{ ucfirst($g->kategori) }}</div>
        <div class="photo-date">{{ \Carbon\Carbon::parse($g->created_at)->format('d M Y') }}</div>
      </div>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada foto dalam kategori ini.</p>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($galeris->hasPages())
    <div class="pager rv">
      @if($galeris->onFirstPage())
        <span class="pg-dis"><i class="fas fa-chevron-left" style="font-size:9px;"></i></span>
      @else
        <a href="{{ $galeris->previousPageUrl() }}"><i class="fas fa-chevron-left" style="font-size:9px;"></i></a>
      @endif
      @for($i=1;$i<=$galeris->lastPage();$i++)
        @if($i==$galeris->currentPage())<span class="pg-active">{{ $i }}</span>
        @elseif($i==1||$i==$galeris->lastPage()||($i>=$galeris->currentPage()-1&&$i<=$galeris->currentPage()+1))<a href="{{ $galeris->url($i) }}">{{ $i }}</a>
        @elseif($i==$galeris->currentPage()-2||$i==$galeris->currentPage()+2)<span class="pager-dots">···</span>
        @endif
      @endfor
      @if($galeris->hasMorePages())
        <a href="{{ $galeris->nextPageUrl() }}"><i class="fas fa-chevron-right" style="font-size:9px;"></i></a>
      @else
        <span class="pg-dis"><i class="fas fa-chevron-right" style="font-size:9px;"></i></span>
      @endif
    </div>
    @endif
    @endif

  </div>
</section>
@endsection