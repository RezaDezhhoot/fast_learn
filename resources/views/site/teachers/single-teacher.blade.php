<div>
    <x-site.teachers.breadcrumbs :data="$page_address" :teacher="$teacher" />
    <section class="teacher-details-area pt-50px">
        <div class="container">
            <div class="py-5 px-2">
                <div class="card card-item">
                    <h2 class="px-4">درباره من</h2>
                    <div class="card-body">
                        {!! $teacher->body !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="course-area">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between pb-3">
                <h3 class="fs-24 font-weight-semi-bold">دوره های من</h3>
                <span class="ribbon ribbon-lg">24</span>
            </div>
            <div class="divider"><span></span></div>
            <div class="row pt-30px">
                @foreach($teacher->courses as $item)
                    <div class="col-lg-4 responsive-column-half">
                        <x-site.courses.course-box :item="$item" />
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end container -->
    </section>
</div>
