<div>
    <x-site.breadcrumbs :data="$page_address" title="اشتراک ها" />
    <section class="course-area">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">ما <span class="text-black">{{ $items->count() }}</span> اشتراک برای شما پیدا
                        کردیم</p>
                    <div class="d-flex flex-wrap align-items-center">
                    </div>
                </div>
                <!-- end filter-bar-inner -->
            </div>
            <!-- end filter-bar -->
            <div class="row">
                <div class="col-lg-3" wire:ignore>
                    <div class="sidebar mb-5">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">فیلد جستجو</h3>
                                <div class="divider"><span></span></div>
                                <form wire:submit.prevent="search">
                                    <div class="form-group mb-0">
                                        <input wire:model.defer="q" class="form-control form--control pl-3"
                                               type="text" name="q" placeholder="جستجوی اشتراک" />
                                        <span wire:click="search" class="la la-search search-icon"></span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    @if(sizeof($items) > 0)
                        <div class="row">
                            @foreach($items as $item)
                                <div class="col-lg-4 responsive-column-half">
                                    <x-site.subscriptions.subscription-box :item="$item" />
                                </div>
                            @endforeach
                        </div>
                        <!-- end row -->

                    @else
                        <div class="text-center mb-3">
                            <img class="mx-auto no-date d-block mt-5" src="{{ asset('site/svg/No-data-cuate.svg') }}"
                                 alt="">
                            <h5 class="mt-3">ما هیچ اشتراکی  برای شما پیدا نکردیم!</h5>
                        </div>
                    @endif
                    {{$items->links('site.includes.paginate')}}
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
