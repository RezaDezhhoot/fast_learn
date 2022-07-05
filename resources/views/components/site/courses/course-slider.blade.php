@props(['data'])
<section class="course-area py-5">
    <div class="course-wrapper">
        <div class="container">
            <div class="section-heading text-right">
                <h5 class="ribbon ribbon-lg mb-2">دوره ها</h5>
                <h2 class="section__title">{{$data['title']}}</h2>
                <span class="section-divider"></span>
            </div>
            <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                @foreach($data['content'] as $item)
                    <x-site.courses.course-box :item="$item" />
                @endforeach

            </div><!-- end tab-content -->
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section>
