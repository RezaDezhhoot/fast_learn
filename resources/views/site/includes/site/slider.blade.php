<div>
<section class="hero-area position-relative hero-area-3">
    <div class="hero-slider-item hero-bg-5" style="background-image: url({{asset($sliderImage)}});background-size: cover;background-position: center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content">
                        <div class="section-heading pb-4">
                            {!! $slider !!}
                            @if($sliderLink)
                                <p class="pt-2">
                                    <a href="{{ $sliderLink }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center">مشاهده<i class="la la-arrow-left icon ml-1"></i></a>
                                </p>
                            @endif
                        </div>
                        <!-- end section-heading -->
                        <form wire:submit.prevent="search" method="get" class="w-75 pt-2 mx-auto">
                            <div class="form-group mb-0">
                                <input wire:model.defer="q" class="form-control form--control pl-3" type="text" name="search" placeholder="جستجوی دوره ها با کلمات کلیدی" />
                                <span wire:click="search" class="la la-search search-icon"></span>
                            </div>
                        </form>
                    </div>
                    <!-- end hero-content -->
                </div>
                <!-- end col-lg-7 -->

                <!-- end col-lg-5 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end hero-slider-item -->
</section>

</div>
