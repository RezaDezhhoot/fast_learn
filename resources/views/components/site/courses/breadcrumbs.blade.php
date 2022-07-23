@props(['data','course'])
<section class="breadcrumb-area pt-50px pb-50px bg-white pattern-bg">
    <div class="container">
        <div class="col-lg-8 mr-auto">
            <div class="breadcrumb-content">
                <ul class="generic-list-item generic-list-item-arrow d-flex flex-wrap align-items-center">
                    @foreach($data as $item)
                        <li><a  {{ !empty($item['link']) ? "href=".$item['link']." " : " " }} class="font-12 vazir">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
                <div class="section-heading">
                    <h2 class="section__title"> {{ $course->title }}</h2>
                    <p class="section__desc pt-2 lh-30">{{ $course->sub_title }}</p>
                </div>
                <!-- end section-heading -->
                <div class="d-flex flex-wrap align-items-center pt-3 pb-2">
                    <h6 class="ribbon ribbon-lg mr-2 bg-3 text-white">{{ $course->category->title }}</h6>
                </div>

                <div class="d-flex flex-wrap align-items-center">
                    <p class="pr-3 d-flex align-items-center">
                        <svg class="svg-icon-color-gray mr-1" width="16px" viewBox="0 0 24 24">
                            <path
                                d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"
                            ></path>
                        </svg>
                        آخرین به روز رسانی 2{{ $course->updated_date }}
                    </p>
                </div>
                <!-- end d-flex -->
                <div class="bread-btn-box pt-3">
                    <button class="btn theme-btn theme-btn-sm theme-btn-transparent lh-28 mr-2 mb-2" data-toggle="modal" data-target="#shareModal"><i class="la la-share mr-1"></i>اشتراک گذاری</button>
                </div>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end col-lg-8 -->
    </div>
    <!-- end container -->
</section>
