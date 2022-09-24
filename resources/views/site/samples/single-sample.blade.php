<div>
    <x-site.breadcrumbs :data="$page_address" :title="$sample->title" />
    <section class="blog-area pt-100px pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card card-item">
                        <div class="card-body">
                            {!! $sample->description !!}
                            <div class="section-block"></div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
                                <h3 class="fs-18 font-weight-semi-bold">دانلود</h3>
                                <div wire:click="download()" class="icon-element icon-element-sm shadow-sm cursor-pointer text-success"><i class="la la-download"></i></div>
                            </div>
                        </div>
                            <!-- end card-body -->
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">فیلد جستجو</h3>
                                <div class="divider"><span></span></div>
                                <form wire:submit.prevent="search">
                                    <div class="form-group mb-0">
                                        <input wire:model.defer="q" class="form-control form--control pl-3" type="search"
                                            name="q" placeholder="جستجوی مقاله" />
                                        <span wire:click="search" class="la la-search search-icon"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card -->
    
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">نمونه سوالات مرتبط</h3>
                                <div class="divider"><span></span></div>
                                @foreach($related_samples as $item)
                                    <div class="">
                                        @livewire('components.site.samples.sample-row', ['sample' => $item])
                                    </div>
                                @endforeach
                                <div class="view-all-course-btn-box">
                                    <a href="{{ route('samples') }}" class="btn theme-btn w-100">مشاهده همه  نمونه سوالات <i
                                            class="la la-arrow-left icon ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
