@props(['data'])
<section class="blog-area pt-5 bg-gray overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="category-content-wrap">
                    <div class="section-heading ">
                        <h5 class="ribbon ribbon-lg mb-2">دسته بندی ها</h5>
                        <h2 class="section__title">{{$data['title']}}</h2>
                        <span class="section-divider"></span>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="category-btn-box text-left">
                    @if(!empty($data['moreLink']))
                        <a href="{{$data['moreLink']}}" class="btn theme-btn">همه دسته بندی ها <i class="la la-arrow-left icon ml-1"></i></a>
                    @endif
                </div><!-- end category-btn-box-->
            </div><!-- end col-lg-3 -->
        </div>
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
            @foreach($data['content'] as $item)
                <x-site.categories.category-box :item="$item" />
            @endforeach
        </div>
    </div>
</section>
