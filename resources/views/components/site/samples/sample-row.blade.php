<div class="card card-item card-item-list-layout mb-2 w-100 ">
    <!-- end card-image -->
    <div class="card-body d-flex align-items-center p-2 m-1">
        @if($show_course_name)
            <p class="card-text px-2">دوره آموزشی  : <a>{{ $sample->course->title ?? 'عمومی' }}</a></p>
            <p class="card-title"><a href="{{ route('sample',[$sample->slug]) }}"  data-toggle="tooltip" data-placement="top" data-title="مشاهده">{{ $sample->title }}</a></h5>
        @else
            <p class="card-text"><a href="{{ route('sample',[$sample->slug]) }}"  data-toggle="tooltip" data-placement="top" data-title="مشاهده">{{ $sample->title }}</a></h5>
        @endif
       
        <!-- end rating-wrap -->
        <div class="d-flex justify-content-between align-items-center">
            <div class="card-action-wrap pl-3">
                <a wire:click="download()" class="icon-element icon-element-sm shadow-sm cursor-pointer ml-1 text-success" data-toggle="tooltip" data-placement="top" data-title="دانلود">
                    <i class="la la-download"></i>
                </a>
                <small wire:loading="download()">در حال بارگیری ...</small>
            </div>
        </div>
    </div>
</div>