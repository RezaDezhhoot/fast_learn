<div>
    <x-site.breadcrumbs :data="$page_address" title="دوره های اموزشی" />

    <section class="course-area">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">ما <span class="text-black">{{ $courses->count() }}</span> دوره برای شما پیدا کردیم
                    </p>
                    <div class="d-flex flex-wrap align-items-center">
                        <a class="btn theme-btn theme-btn-sm theme-btn-white lh-28 collapse-btn" data-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                            فیلترها <i class="la la-angle-down ml-1 collapse-btn-hide"></i>
                            <i class="la la-angle-up ml-1 collapse-btn-show"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse pt-4" id="collapseFilter" wire:ignore.self>
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">فیلتر بر اساس نوع دوره اموزشی</h3>
                                @foreach($data['types'] as $key => $item)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="property" class="custom-control-input" wire:model="property"
                                               value="{{$key}}" id="{{$key}}_property"  required="" />
                                        <label class="custom-control-label custom--control-label text-black"
                                               for="{{$key}}_property"> {{$item}} </label>
                                    </div>
                                @endforeach
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="property" class="custom-control-input" wire:model="property"
                                           value="" id="all_property"  required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                           for="all_property"> همه </label>
                                </div>
                            </div>
                            <!-- end widget-panel -->
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">فیلتر بر اساس هزینه</h3>
                                @foreach($types as $key => $item)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="type" class="custom-control-input" wire:model="type"
                                               value="{{$key}}" id="type{{$key}}"  required="" />
                                            <label class="custom-control-label custom--control-label text-black" for="type{{$key}}">
                                                {{$item}} </label>
                                    </div>
                                @endforeach
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="type" class="custom-control-input" wire:model="type"
                                           value="" id="all_types"  required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                           for="all_types"> همه </label>
                                </div>
                            </div>
                            <!-- end widget-panel -->
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">مرتب سازی بر اساس</h3>
                                <div class="select-container select--container px-2 m-0">
                                    <select class="select-container-select mb-2 form-control" wire:model="orderBy">
                                        <option value="">مرتب سازی</option>
                                        @foreach($orders as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">مرتب سازی بر اساس استان</h3>
                                <div class="select-container select--container px-2 m-0">
                                    <select class="select-container-select mb-2 form-control" wire:model="province">
                                        <option value="">مرتب سازی</option>
                                        @foreach($data['province'] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">فیلتر بر اساس مدرس</h3>
                                <div class="select-container select--container px-2 m-0">
                                    <select class="select-container-select mb-2 form-control" wire:model="teacher">
                                        <option value="">مدرس</option>
                                        @foreach($data['teachers'] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="widget-panel">
                                <h3 class="fs-18 font-weight-semi-bold pb-3">مرتب سازی بر اساس شهر</h3>
                                <div class="select-container select--container px-2 m-0">
                                    <select class="select-container-select mb-2 form-control" wire:model="city">
                                        <option value="">مرتب سازی</option>
                                        @foreach($data['city'] as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end filter-bar-inner -->
            </div>
            <!-- end filter-bar -->
            <div class="row">
                <div class="col-lg-3" wire:ignore>
                    <div class="sidebar mb-5">
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
                                    @if(!empty($item['children_recursive']))
                                    @foreach($item['children_recursive'] as $key => $value)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="category" wire:model="category" value="{{ $value['slug'] }}"
                                            class="custom-control-input" id="{{ $value['slug'] }}" required="" />
                                        <label class="custom-control-label custom--control-label text-black"
                                            for="{{ $value['slug'] }}"> <span
                                                class="text-gray">{{$value['title']}}</span>
                                        </label>
                                        @if(!empty($value['children_recursive']))
                                            @foreach($value['children_recursive'] as $key2 => $value2)
                                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                                    <input type="radio" name="category" wire:model="category" value="{{ $value2['slug'] }}"
                                                           class="custom-control-input" id="{{ $value2['slug'] }}" required="" />
                                                    <label class="custom-control-label custom--control-label text-black"
                                                           for="{{ $value2['slug'] }}"> <span
                                                            class="text-gray">{{$value2['title']}}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
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
                    @if(sizeof($courses) > 0)
                    <div class="row">
                        @foreach($courses as $item)
                        <div class="col-lg-4 responsive-column-half">
                            <x-site.courses.course-box show_details="{{false}}" :item="$item" />
                        </div>
                        @endforeach
                    </div>
                    <!-- end row -->
                    @else
                    <div class="text-center mb-3">
                        <img class="mx-auto no-date d-block mt-5" src="{{ asset('site/svg/no-data.svg') }}" alt="">
                        <h5 class="mt-3">ما هیچ دوره ای برای شما پیدا نکردیم!</h5>
                    </div>
                    @endif
                    {{$courses->links('site.includes.paginate')}}
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
