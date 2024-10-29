@if ($paginator->hasPages())
<div class="pagination">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
    <span class="page disabled">«</span>
  @else
    <span class="page"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></span>
  @endif

  {{-- Pagination Elements --}}
  @if($paginator->currentPage() > 2)
      <span class="page hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></span>
  @endif
  @if($paginator->currentPage() > 3)
      <span class="hidden-xs">...</span>
  @endif
  @foreach(range(1, $paginator->lastPage()) as $i)
      @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
          @if ($i == $paginator->currentPage())
              <span class="page current">{{ $i }}</span>
          @else
              <span class="page"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></span>
          @endif
      @endif
  @endforeach
  @if($paginator->currentPage() < $paginator->lastPage() - 2)
      <span class="hidden-xs">...</span>
  @endif
  @if($paginator->currentPage() < $paginator->lastPage() - 1)
      <span class="page hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></span>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
    <span class="page"><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></span>
  @else
    <span class="page disabled">»</span>
  @endif
</div>
@endif



        
