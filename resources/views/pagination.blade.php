@if ($customers->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end mb-1">
            @if ($customers->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $customers->previousPageUrl() }}">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $customers->lastPage(); $i++)
                <li class="page-item {{ $customers->currentPage() == $i ? ' active' : '' }}">
                    <a href="{{ $customers->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endfor

            @if ($customers->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $customers->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
