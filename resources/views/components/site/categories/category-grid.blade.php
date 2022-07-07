@props(['data'])
<section class="category-area pt-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="category-content-wrap">
                    <div class="section-heading">
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
        </div><!-- end row -->
        <div class="category-wrapper mt-30px">
            <div class="row">
                @foreach($data['content'] as $item)
                <div class="col-lg-{{$data['widthCase']}} col-md-6 col-12">
                    <x-site.categories.category-box :item="$item" />
                </div>
                @endforeach

            </div><!-- end row -->
        </div><!-- end category-wrapper -->
    </div><!-- end container -->
</section>
