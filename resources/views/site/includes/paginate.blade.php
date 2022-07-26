@if ($paginator->hasPages())
    <div class="text-center py-3">
        <nav aria-label="مثال ناوبری صفحه" class="pagination-box">
            <ul class="pagination justify-content-center">
                @if (!$paginator->onFirstPage())
                    <li style="cursor: pointer" class="next page-item" wire:click="previousPage">
                        <a class="page-link">
                            <i class="la la-angle-double-right"></i>
                            قبلی
                        </a>
                    </li>
                @endif
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="page-item"><a  class="page-link">{{$element}}</a></li>
                    @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li style="cursor: pointer" wire:click="gotoPage({{ $page }})" class="page-item active"><a class="page-link">{{$page}}</a></li>
                                @else
                                    <li style="cursor: pointer" wire:click="gotoPage({{ $page }})" class="page-item "><a  class="page-link">{{$page}}</a></li>
                                @endif
                            @endforeach
                        @endif
                @endforeach

                    @if ($paginator->hasMorePages())
                        <li style="cursor: pointer" class="next page-item" wire:click="nextPage">
                            <a class="page-link">
                                بعدی
                                <i class="la la-angle-double-left"></i>
                            </a>
                        </li>
                    @endif

            </ul>
        </nav>
    </div>

@endif

