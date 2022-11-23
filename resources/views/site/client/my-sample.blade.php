<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">
                نمونه سوالات من
            </h3>
           <a href="{{route('samples')}}">
                <span class="text-info">مشاهده سایر نمونه سوالات</span>
           </a>
        </div>
        <div class="dashboard-cards mb-5">
            @forelse($samples as $sample)
                @livewire('components.site.samples.sample-row', ['sample' => $sample,'show_course_name'=>true])
            @empty
                <div class="custom-box-shadow d-flex align-items-center justify-content-center alert alert-info">
                    <p>
                        هیج نمونه سوالی یافت نشد
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
