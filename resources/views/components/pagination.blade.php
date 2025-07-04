@php
  $currentPage = $paginator->currentPage();
  $numPage = $paginator->lastPage();
  // $baseUrl = $baseUrl ?: $paginator->url(1); // $baseUrl ? $baseUrl : $paginator->url(1)
  // Giữ các tham số query khác
  $queryString = request()->except('page');
  $baseUrl .= $queryString ? '?' . http_build_query($queryString) . '&' : '?';
@endphp

@if ($numPage > 1)
  <nav aria-label="" class="mt-4">
    <ul class="pagination justify-content-center">
      {{-- Nút trang trước --}}
      @if ($currentPage > 1)
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      @endif

      @php
        // Từ trang 4(n) sẽ duyệt item số trang từ n-1, ngược lại duyệt từ 2
        $i = $currentPage >= 4 ? $currentPage - 1 : 2;
        $pageItem = 1;
      @endphp

      @if ($i > 2)
        <li class="page-item">
          <a class="page-link" href="{{ $baseUrl }}page=1">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="javascript:void(0)">...</a>
        </li>
      @else
        <li class="page-item{{ $currentPage == 1 ? ' active' : '' }}">
          <a class="page-link" href="{{ $baseUrl }}page=1">1</a>
        </li>
      @endif

      @for (; $i <= $numPage; $i++)
        {{-- Còn 2 item số trang nữa là hết thì khỏi xuất ... --}}
        @if ($currentPage == $numPage - 2)
            @php $pageItem = 0; @endphp
        @endif

        {{-- Giới hạn item số trang khi vòng lặp > 3 --}}
        @if ($pageItem++ == 4)
          <li class="page-item">
            <a class="page-link" href="javascript:void(0)">...</a>
          </li>
          <li class="page-item{{ $currentPage == $numPage ? ' active' : '' }}">
            <a class="page-link" href="{{ $baseUrl }}page={{ $numPage }}">{{ $numPage }}</a>
          </li>
          @break
        @endif

        <li class="page-item{{ $currentPage == $i ? ' active' : '' }}">
          <a class="page-link" href="{{ $baseUrl }}page={{ $i }}">{{ $i }}</a>
        </li>
      @endfor

      {{-- Nút trang sau --}}
      @if ($currentPage < $numPage)
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      @endif
    </ul>
  </nav>
@endif