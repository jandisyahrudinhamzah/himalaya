{{-- resources/views/public/articles.blade.php --}}
@extends('public.layouts')
@section('title', 'Artikel — HIMAYALA')

@push('styles')
<style>
/* ── SEARCH BAR ── */
.srch{
  display:flex;gap:12px;flex-wrap:wrap;
  padding:24px;
  background:var(--ink3);
  border:1px solid var(--o-ls);
  margin-bottom:48px;
}
.srch-field{
  flex:1;min-width:200px;
  display:flex;align-items:center;gap:12px;
  background:var(--ink2);
  border:1px solid var(--o-ls);
  padding:0 16px;height:44px;
  transition:border-color .3s;
}
.srch-field:focus-within{border-color:var(--o-ln)}
.srch-field i{color:var(--tx2);font-size:12px;flex-shrink:0}
.srch-field input{
  background:none;border:none;outline:none;
  font-size:12px;font-weight:300;
  color:var(--tx1);width:100%;
  font-family:'DM Sans',sans-serif;
}
.srch-field input::placeholder{color:var(--tx2)}
.srch-btn{
  font-size:9px;font-weight:500;letter-spacing:.24em;text-transform:uppercase;
  color:var(--o);border:1px solid var(--o-ls);
  padding:0 24px;height:44px;cursor:pointer;background:none;
  display:flex;align-items:center;gap:8px;
  transition:border-color .3s,background .3s;font-family:'DM Sans',sans-serif;
}
.srch-btn:hover{border-color:var(--o);background:var(--o-gl2)}

/* Article card image no-date variant */
.ccard-img-art{height:210px}
.ccard-date-pub{
  position:absolute;top:12px;right:12px;z-index:2;
  font-size:8px;letter-spacing:.18em;
  color:var(--tx2);background:rgba(9,9,11,.84);
  border:1px solid var(--o-ls);padding:5px 10px;
  backdrop-filter:blur(8px);
}
</style>
@endpush

@section('content')


<section class="sec" style="background:var(--ink);">
  <div class="wrap">

    {{-- Search --}}
    <div class="srch rv">
      <div class="srch-field">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Cari artikel...">
      </div>
      <button class="srch-btn"><i class="fas fa-sliders-h"></i>Filter</button>
    </div>

    {{-- Grid --}}
    <div class="card-grid-3 rv">
      @forelse($artikels as $a)
      <div class="ccard">
        <div class="ccard-img ccard-img-art">
          @if($a->gambar)
            <img src="{{ asset('storage/'.$a->gambar) }}" alt="{{ $a->judul }}">
          @else
            <div style="width:100%;height:100%;background:var(--ink3);display:flex;align-items:center;justify-content:center;">
              <i class="fas fa-newspaper" style="color:var(--o-ls);font-size:32px;"></i>
            </div>
          @endif
          <div class="ccard-ov"></div>
          <div class="ccard-badge">Artikel</div>
          <div class="ccard-date-pub">{{ $a->created_at->format('d M Y') }}</div>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">{{ $a->judul }}</div>
          <p class="ccard-desc">{{ Str::limit(strip_tags($a->deskripsi), 100) }}</p>
          <a href="{{ route('public.article.show', $a->id) }}" class="ccard-link">
            Baca Selengkapnya <i class="fas fa-arrow-right" style="font-size:8px;"></i>
          </a>
        </div>
      </div>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada artikel tersedia.</p>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($artikels->hasPages())
    <div class="pager rv">
      @if($artikels->onFirstPage())
        <span class="pg-dis"><i class="fas fa-chevron-left" style="font-size:9px;"></i></span>
      @else
        <a href="{{ $artikels->previousPageUrl() }}"><i class="fas fa-chevron-left" style="font-size:9px;"></i></a>
      @endif

      @for($i=1;$i<=$artikels->lastPage();$i++)
        @if($i==$artikels->currentPage())
          <span class="pg-active">{{ $i }}</span>
        @elseif($i==1||$i==$artikels->lastPage()||($i>=$artikels->currentPage()-1&&$i<=$artikels->currentPage()+1))
          <a href="{{ $artikels->url($i) }}">{{ $i }}</a>
        @elseif($i==$artikels->currentPage()-2||$i==$artikels->currentPage()+2)
          <span class="pager-dots">···</span>
        @endif
      @endfor

      @if($artikels->hasMorePages())
        <a href="{{ $artikels->nextPageUrl() }}"><i class="fas fa-chevron-right" style="font-size:9px;"></i></a>
      @else
        <span class="pg-dis"><i class="fas fa-chevron-right" style="font-size:9px;"></i></span>
      @endif
    </div>
    @endif

  </div>
</section>
@endsection