<div>
    <section class="hero-area bg-gray hero-area-4">
        <div class="hero-slider-item after-none" style="background-image: url({{asset($sliderImage)}});background-size: cover;background-position: center;background-repeat: no-repeat">
            <div class="container">
                <div class="hero-content text-center">
                    <div class="section-heading">
                        {!! $slider !!}
                    </div>
                    <!-- end section-heading -->
                    <form mwire:submit.prevent="search" method="get"  class="w-50 pt-4 mx-auto">
                        <div class="form-group mb-0">
                            <input  wire:model.defer="q" class="form-control form--control pl-3 shadow-sm border-0" type="text" name="search" placeholder="جستوجو">
                            <span  wire:click="search"class="la la-search search-icon"></span>
                        </div>
                    </form>
                </div>
                <!-- end hero-content -->
            </div>
            <!-- end container -->
        </div>
        <!-- end hero-slider-item -->
    </section>
</div>
