@props(['data'])
<section class="cat-area section-padding img-bg" style="background-image: url({{asset($data['bannerImage'])}}) ">
    <div class="overlay"></div>
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="cta-content-wrap text-center position-relative">
            <div class="section-heading">
                {!! $data['bannerContent'] !!}
            </div>
            <!-- end section-heading -->
            <div class="cat-btn-box mt-35px">
                @if(!empty($data['bannerLink']))
                    <a href="{{ $data['bannerLink'] }}" class="btn theme-btn theme-btn-white">ادامه <i class="la la-arrow-left icon ml-1"></i></a>
                @endif
            </div>
            <!-- end cat-btn-box -->
        </div>
        <!-- end cta-content-wrap -->
    </div>
    <!-- end container -->
</section>
