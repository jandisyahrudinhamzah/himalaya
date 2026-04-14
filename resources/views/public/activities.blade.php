{{-- resources/views/public/activities.blade.php --}}
@extends('public.layouts')
@section('title', 'Kegiatan — HIMAYALA')

@push('styles')
<style>
/* ── FILTER TABS ── */
.filter-row{display:flex;gap:1px;background:var(--o-ls);margin-bottom:48px;flex-wrap:wrap}
.filter-btn{
  flex:1;min-width:120px;
  padding:14px 20px;
  font-size:9px;font-weight:500;letter-spacing:.24em;text-transform:uppercase;
  color:var(--tx2);background:var(--ink2);
  text-align:center;
  transition:background .3s,color .3s;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.filter-btn:hover{background:var(--ink3);color:var(--tx1)}
.filter-btn.active{background:var(--o);color:var(--ink)}
.filter-btn i{font-size:10px}

/* Activity card location info */
.act-info{display:flex;flex-direction:column;gap:8px;margin-bottom:18px}
.act-info-row{display:flex;align-items:center;gap:10px;font-size:11px;color:var(--tx2)}
.act-info-row i{color:var(--o-dim);font-size:10px;width:14px;text-align:center;flex-shrink:0}
</style>
@endpush

@section('content')

<section class="sec" style="background:var(--ink);">
  <div class="wrap">

    {{-- Filter --}}
    <div class="filter-row rv">
      <a href="{{ route('public.activities') }}" class="filter-btn {{ !request()->status ? 'active' : '' }}">
        <i class="fas fa-th-large"></i>Semua
      </a>
      <a href="{{ route('public.activities', ['status'=>'Upcoming']) }}" class="filter-btn {{ request()->status=='Upcoming' ? 'active' : '' }}">
        <i class="fas fa-clock"></i>Upcoming
      </a>
      <a href="{{ route('public.activities', ['status'=>'Ongoing']) }}" class="filter-btn {{ request()->status=='Ongoing' ? 'active' : '' }}">
        <i class="fas fa-fire"></i>Ongoing
      </a>
      <a href="{{ route('public.activities', ['status'=>'Selesai']) }}" class="filter-btn {{ request()->status=='Selesai' ? 'active' : '' }}">
        <i class="fas fa-check-circle"></i>Selesai
      </a>
    </div>

    {{-- Grid --}}
    <div class="card-grid-3 rv">
      @forelse($kegiatans as $k)
      <div class="ccard">
        <div class="ccard-img">
          @if($k->foto)
            <img src="{{ asset('storage/'.$k->foto) }}" alt="{{ $k->judul }}">
          @else
            <div style="width:100%;height:100%;background:var(--ink3);display:flex;align-items:center;justify-content:center;">
              <i class="fas fa-mountain" style="color:var(--o-ls);font-size:32px;"></i>
            </div>
          @endif
          <div class="ccard-ov"></div>
          <div class="ccard-badge {{ $k->status=='Upcoming'?'s-upcoming':($k->status=='Ongoing'?'s-ongoing':'s-selesai') }}">{{ $k->status }}</div>
          <div class="ccard-date">
            <div class="ccard-day">{{ \Carbon\Carbon::parse($k->tanggal)->format('d') }}</div>
            <div class="ccard-mon">{{ \Carbon\Carbon::parse($k->tanggal)->format('M Y') }}</div>
          </div>
        </div>
        <div class="ccard-body">
          <div class="ccard-title">{{ $k->judul }}</div>
          <div class="act-info">
            <div class="act-info-row"><i class="fas fa-map-marker-alt"></i>{{ $k->lokasi ?? 'Lokasi TBA' }}</div>
            @if($k->peserta)<div class="act-info-row"><i class="fas fa-users"></i>{{ $k->peserta }} Peserta</div>@endif
          </div>
          <a href="{{ route('public.activity.show', $k->id) }}" class="ccard-link">
            Detail Kegiatan <i class="fas fa-arrow-right" style="font-size:8px;"></i>
          </a>
        </div>
      </div>
      @empty
      <div class="empty-st">
        <span class="empty-st-icon">∅</span>
        <p style="font-size:13px;color:var(--tx2);">Belum ada kegiatan tersedia.</p>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($kegiatans->hasPages())
    <div class="pager rv">
      @if($kegiatans->onFirstPage())
        <span class="pg-dis"><i class="fas fa-chevron-left" style="font-size:9px;"></i></span>
      @else
        <a href="{{ $kegiatans->previousPageUrl() }}"><i class="fas fa-chevron-left" style="font-size:9px;"></i></a>
      @endif
      @for($i=1;$i<=$kegiatans->lastPage();$i++)
        @if($i==$kegiatans->currentPage())<span class="pg-active">{{ $i }}</span>
        @elseif($i==1||$i==$kegiatans->lastPage()||($i>=$kegiatans->currentPage()-1&&$i<=$kegiatans->currentPage()+1))<a href="{{ $kegiatans->url($i) }}">{{ $i }}</a>
        @elseif($i==$kegiatans->currentPage()-2||$i==$kegiatans->currentPage()+2)<span class="pager-dots">···</span>
        @endif
      @endfor
      @if($kegiatans->hasMorePages())
        <a href="{{ $kegiatans->nextPageUrl() }}"><i class="fas fa-chevron-right" style="font-size:9px;"></i></a>
      @else
        <span class="pg-dis"><i class="fas fa-chevron-right" style="font-size:9px;"></i></span>
      @endif
    </div>
    @endif

  </div>
</section>
@endsection