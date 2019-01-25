@if ($paginator->hasPages())
    <div class="flex justify-between text-xs">
        <a class="@if (!$paginator->onFirstPage()) bg-black @else bg-grey @endif
                text-white no-underline py-2 px-3 rounded" href="{{ $paginator->previousPageUrl()}}" rel="previous"
           aria-label="@lang('pagination.previous')">@lang('pagination.previous')</a>

        <a class="@if ($paginator->hasMorePages()) bg-black @else bg-grey @endif
                text-white no-underline py-2 px-3 rounded" href="{{ $paginator->nextPageUrl() }}" rel="next"
           aria-label="@lang('pagination.next')">@lang('pagination.next')</a>
    </div>
@endif