@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation">
        <ul class="pagination justify-content-center mt-2">
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="page-item disabled">
                        <button class="page-link">{{ $element }}</button>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active disabled">
                                <button class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                            </li>
                        @else
                            <li class="page-item">
                                <button class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

        </ul>
    </nav>
@endif
