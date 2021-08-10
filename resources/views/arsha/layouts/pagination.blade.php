@if ($paginator->hasPages())
    <nav class="pricing">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" style="width: 50%;padding: 0;" aria-disabled="true">
                    <span class="page-link buy-btn">{{__('Newer')}}</span>
                </li>
            @else
                <li class="page-item" style="width: 50%;padding: 0">
                    <a class="page-link buy-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">{{__('Newer')}}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item" style="width: 50%;padding: 0">
                    <a class="page-link buy-btn pull-right" href="{{ $paginator->nextPageUrl() }}" rel="next">{{__('Older')}}</a>
                </li>
            @else
                <li class="page-item disabled" style="width: 50%;padding: 0" aria-disabled="true">
                    <span class="page-link buy-btn pull-right">{{__('Older')}}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
