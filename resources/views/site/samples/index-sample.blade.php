<div>
    <x-site.breadcrumbs :data="$page_address" title="نمونه سوالات" />
    <section class="course-area">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">ما <span class="text-black">{{ $samples->count() }}</span> نمونه سوال برای شما پیدا
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
                                            type="text" name="q" placeholder="جستجوی نمونه سوال" />
                                        <span wire:click="search" class="la la-search search-icon"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">دسته بندی ها</h3>
                                <div class="divider"><span></span></div>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="category" class="custom-control-input"
                                        wire:model="category" value="" id="all_categories" required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="all_categories"> همه دسته بندی ها </label>
                                </div>
                                @foreach($categories as $item)
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="category" wire:model="category"
                                        value="{{ $item['slug'] }}" class="custom-control-input"
                                        id="{{ $item['slug'] }}" required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                        for="{{ $item['slug'] }}"> {{ $item['title'] }} </label>
                                    @if(!empty($item['sub_categories']))
                                    @foreach($item['sub_categories'] as $key => $value)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="category" wire:model="category" value="{{ $value }}"
                                            class="custom-control-input" id="{{ $value }}" required="" />
                                        <label class="custom-control-label custom--control-label text-black"
                                            for="{{ $value }}"> <span
                                                class="text-gray">{{$item['sub_categories_title'][$key]}}</span>
                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    @if(sizeof($samples))
                    <div class="row">
                        @foreach($samples as $item)
                        <div class="col-12">
                            @livewire('components.site.samples.sample-row', ['sample' => $item,'show_course_name'=>true])
                        </div>
                        @endforeach
                    </div>
                    <!-- end row -->

                    @else
                    <div class="text-center mb-3">
                        <img class="mx-auto no-date d-block mt-5" src="{{ asset('site/svg/No-data-cuate.svg') }}"
                            alt="">
                        <h5 class="mt-3">ما هیچ نمونه سوالی ای برای شما پیدا نکردیم!</h5>
                    </div>
                    @endif
                    {{$samples->links('site.includes.paginate')}}
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
