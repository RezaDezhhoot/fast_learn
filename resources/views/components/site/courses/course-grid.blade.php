@props(['data'])
<section class="course-area">
    <div class="card-content-wrapper bg-gray py-5">
        <div class="container">
        <div class="section-heading text-right">
            <h5 class="ribbon ribbon-lg mb-2">دوره ها</h5>
            <h2 class="section__title">{{$data['title']}}</h2>
            <span class="section-divider"></span>
        </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                        @foreach($data['content'] as $item)
                            <div class="col-lg-{{$data['widthCase']}} col-md-6 col-12">
                                <x-site.courses.course-box :item="$item" />
                            </div>
                        @endforeach
                    </div><!-- end row -->
                </div><!-- end tab-pane -->
            </div><!-- end tab-content -->
            @if(!empty($data['moreLink']))
                <div class="more-btn-box mt-4 text-center">
                    <a href="{{$data['moreLink']}}" class="btn theme-btn">همه دوره ها را مرور کنید <i class="la la-arrow-left icon ml-1"></i></a>
                </div><!-- end more-btn-box -->
            @endif
        </div><!-- end container -->
    </div>
</section>
