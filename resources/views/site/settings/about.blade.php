<div>
    <x-site.breadcrumbs :data="$page_address" title="درباره ما" />
    <section class=" overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-content pb-5">
                       {!! $about !!}
                    </div>
                    <!-- end about-content -->
                </div>
                <!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="row pb-5">
                        @foreach($sliders as $key => $value)
                            <div class="col-lg-6 responsive-column-half py-2">
                                <div class="img-box">
                                    <img src="{{ asset($value) }}" data-src="{{ asset($value) }}" alt="درباره ما" class="img-fluid lazy rounded-rounded" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
