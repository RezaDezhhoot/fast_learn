<div>
    @section('title', $course->title)
    <x-organ.form-control :deleteAble="false"  mode="{{$mode}}" title="محتوای دوره"/>
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $course->title }}</h3>
        </div>
        <div class="card-body">
            <livewire:admin.courses.content :transcript="true" :course="$course" />
        </div>
    </div>
</div>
